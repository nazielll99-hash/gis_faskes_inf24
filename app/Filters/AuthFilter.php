<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $isApi = $request->getUri()->getSegment(1) === 'api';

        if (! session()->get('is_logged')) {
            if ($isApi) {
                return service('response')
                    ->setStatusCode(401)
                    ->setJSON([
                        'status'  => false,
                        'message' => 'Autentikasi diperlukan.',
                    ]);
            }

            return redirect()->to('/login');
        }

        $role = session()->get('role');
        $role = in_array($role, [1, '1', 'admin'], true) ? 'admin' : (string) $role;

        if ($isApi && $role !== 'admin') {
            return service('response')
                ->setStatusCode(403)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Akses hanya tersedia untuk admin.',
                ]);
        }

        if (! $isApi && ! empty($arguments) && ! in_array($role, $arguments, true)) {
            return redirect()->to('/')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
