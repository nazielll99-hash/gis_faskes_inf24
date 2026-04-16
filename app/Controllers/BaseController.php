<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Properti yang wajib dideklarasikan (PHP 8.2)
     */
    protected $session;
    protected $helpers = ['form', 'url'];

    /**
     * Inisialisasi controller
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // WAJIB: jangan dihapus
        parent::initController($request, $response, $logger);

        // Load session
        $this->session = service('session');
    }
}