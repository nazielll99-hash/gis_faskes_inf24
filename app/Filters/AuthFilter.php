<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * AuthFilter
 *
 * Filter untuk melindungi route yang membutuhkan autentikasi.
 * Daftarkan di app/Config/Filters.php dan app/Config/Routes.php.
 *
 * Cara penggunaan di Routes.php:
 *   $routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
 *       $routes->get('/', 'DashboardController::index');
 *   });
 */
class AuthFilter implements FilterInterface
{
    /**
     * Jalankan sebelum request diproses.
     * Redirect ke login jika belum login.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('is_logged')) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
            return redirect()->to('/login');
        }

        // Cek role jika ada argumen filter, contoh: ['filter' => 'auth:admin,dokter']
        if (! empty($arguments)) {
            $userRole = session()->get('role');

            if (! in_array($userRole, $arguments)) {
                session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
                return redirect()->to('/dashboard');
            }
        }
    }

    /**
     * Jalankan setelah response (tidak digunakan).
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak perlu implementasi
    }
}
