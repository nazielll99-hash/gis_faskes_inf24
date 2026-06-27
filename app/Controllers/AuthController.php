<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Controller;

/**
 * AuthController
 *
 * Mengelola seluruh alur autentikasi:
 * login, logout, dan pengecekan sesi.
 */
class AuthController extends Controller
{
    protected AuthModel $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();

        // Load helper yang diperlukan
        helper(['url', 'form', 'session']);
    }

    // ─────────────────────────────────────────────────
    //  TAMPILKAN FORM LOGIN
    // ─────────────────────────────────────────────────

    /**
     * GET /login
     * Tampilkan halaman form login.
     * Jika sudah login → redirect ke dashboard.
     */
    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        // Sudah login? langsung ke dashboard
        if (session()->get('user_id')) {
            return redirect()->to($this->getDashboardRoute());
        }

        $data = [
            'title'      => 'Login — SIFASKES',
            'pageTitle'  => 'Masuk ke Sistem',
            'validation' => \Config\Services::validation(),
        ];

        return view('login', $data);
    }

    // ─────────────────────────────────────────────────
    //  PROSES LOGIN
    // ─────────────────────────────────────────────────

    /**
     * POST /login
     * Validasi input, verifikasi kredensial, set sesi.
     */
    public function login(): \CodeIgniter\HTTP\RedirectResponse
    {
        // 1. Validasi input (Diubah menggunakan label Email karena kolom username/NIK tidak ada di DB)
        $rules = [
            'username' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email tidak boleh kosong.',
                    'valid_email' => 'Format email tidak valid.',
                ],
            ],
            'password' => [
                'label'  => 'Kata Sandi',
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Kata sandi tidak boleh kosong.',
                    'min_length' => 'Kata sandi minimal 6 karakter.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $identifier = trim($this->request->getPost('username')); // Berisi email dari form input
        $password   = $this->request->getPost('password');
        $remember   = $this->request->getPost('remember') === '1';

        // 2. Cari user di database menggunakan email
        $user = $this->authModel->findByUsername($identifier);

        if (! $user || ! $this->authModel->verifyPassword($password, $user['password'])) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Email atau kata sandi tidak sesuai. Silakan periksa kembali.');
        }

        // Keterangan: Pengecekan status 'is_active' dihapus karena kolomnya belum tersedia di database

        // 3. Set data sesi (Disesuaikan dengan kolom riil di tbl_user)
        $sessionData = [
            'user_id'    => $user['id_user'],          // Sesuai DB: id_user
            'user_name'  => $user['nama_user'],        // Sesuai DB: nama_user
            'email'      => $user['email'],            // Sesuai DB: email
            'role'       => $user['role'] ?? 'admin',  // Fallback ke 'admin' karena kolom role belum ada di DB
            'avatar'     => $user['foto'] ?? 'default.png', // Sesuai DB: foto
            'is_logged'  => true,
        ];
        session()->set($sessionData);

        // 4. Ingat saya (cookie 30 hari)
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + (86400 * 30), '/', '', true, true);
        }

        // Keterangan: Pemanggilan recordLastLogin dihapus karena kolomnya belum tersedia di database

        // 5. Flash sukses & redirect ke dashboard sesuai role
        session()->setFlashdata('success', 'Selamat datang, ' . $user['nama_user'] . '!');

        return redirect()->to($this->getDashboardRoute($sessionData['role']));
    }

    // ─────────────────────────────────────────────────
    //  LOGOUT
    // ─────────────────────────────────────────────────

    /**
     * GET /logout
     * Hancurkan sesi dan redirect ke login.
     */
    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();

        // Hapus cookie remember
        setcookie('remember_token', '', time() - 3600, '/');

        return redirect()->to('/login')
                         ->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    // ─────────────────────────────────────────────────
    //  HELPER PRIVAT
    // ─────────────────────────────────────────────────

    /**
     * Tentukan URL dashboard berdasarkan role pengguna.
     *
     * @param  string|null $role
     * @return string
     */
    private function getDashboardRoute(?string $role = null): string
    {
        $role = $role ?? session()->get('role');

        $routes = [
            'admin'       => '/dashboard/admin',
            'dokter'      => '/dashboard/dokter',
            'perawat'     => '/dashboard/perawat',
            'apoteker'    => '/dashboard/apoteker',
            'resepsionis' => '/dashboard/resepsionis',
        ];

        return $routes[$role] ?? '/dashboard';
    }
}