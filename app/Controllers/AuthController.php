<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected AuthModel $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        helper(['url', 'form', 'session']);
    }

 /**
     * GET /login
     * Update bagian ini agar variabel $errors bisa dibaca oleh view
     */
    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (session()->get('user_id')) {
            return redirect()->to($this->getDashboardRoute());
        }

        $data = [
            'title'      => 'Login — SIFASKES',
            'pageTitle'  => 'Masuk ke Sistem',
            'errors'     => session()->getFlashdata('errors') ?? [], // Melempar error validasi ke view
        ];

        return view('login', $data);
    }

    /**
     * POST /login
     * Mengubah rule dari 'username' menjadi 'email' agar sinkron dengan HTML
     */
    public function login(): \CodeIgniter\HTTP\RedirectResponse
    {
        // 1. DIUBAH KEY-NYA: dari 'username' menjadi 'email' sesuai name="..." di view HTML
        $rules = [
            'email' => [ 
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

        // 2. DIUBAH: mengambil POST 'email' bukan 'username'
        $identifier = trim($this->request->getPost('email')); 
        $password   = $this->request->getPost('password');
        $remember   = $this->request->getPost('remember') === '1';

        $user = $this->authModel->findByUsername($identifier);

        if (! $user || ! $this->authModel->verifyPassword($password, $user['password'])) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Email atau kata sandi tidak sesuai. Silakan periksa kembali.');
        }

        $sessionData = [
            'user_id'    => $user['id_user'],
            'user_name'  => $user['nama_user'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'avatar'     => $user['foto'] ?? 'default.png',
            'is_logged'  => true,
        ];
        session()->set($sessionData);

        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + (86400 * 30), '/', '', true, true);
        }

        session()->setFlashdata('success', 'Selamat datang, ' . $user['nama_user'] . '!');

        return redirect()->to($this->getDashboardRoute($sessionData['role']));
    }

    /**
     * GET /logout
     */
    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();
        setcookie('remember_token', '', time() - 3600, '/');

        return redirect()->to('auth/login')
                         ->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    /**
     * Tentukan URL dashboard berdasarkan angka role (1 = admin, 2 = user).
     */
/**
     * Tentukan URL dashboard berdasarkan angka role (1 = admin, 2 = user).
     * Disesuaikan dengan URL pada gambar image_11b143.jpg
     */
    private function getDashboardRoute($role = null): string
    {
        // Mengonversi ke integer untuk memastikan kecocokan tipe data
        $role = (int) ($role ?? session()->get('role'));

        // Mengubah '/dashboard/admin' menjadi '/admin' sesuai dengan URL pada gambar browser Anda
        $routes = [
            1 => '/admin', // Diarahkan ke localhost/.../public/admin
            2 => '/user',  // Diarahkan ke localhost/.../public/user
        ];

        // Jika fallback tidak ditemukan di daftar, arahkan ke halaman utama /admin atau /
        return $routes[$role] ?? '/admin';
    }
}