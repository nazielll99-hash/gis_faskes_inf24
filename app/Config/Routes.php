<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('admin', 'Admin::index');
$routes->get('admin/setting', 'Admin::Setting');
$routes->post('admin/updateSetting', 'Admin::updateSetting');

$routes->get('wilayah', 'Wilayah::index');
$routes->get('wilayah/input', 'Wilayah::input');
$routes->post('wilayah/insertdata', 'Wilayah::insertdata');
$routes->get('wilayah/edit/(:num)', 'Wilayah::edit/$1'); 
$routes->post('wilayah/updatedata/(:num)', 'Wilayah::updatedata/$1');
$routes->get('wilayah/delete/(:any)', 'Wilayah::delete/$1');

$routes->get('user', 'User::index');
$routes->get('kategori', 'Kategori::index');

$routes->get('faskes', 'Faskes::index');
$routes->get('faskes/input', 'Faskes::input');
$routes->post('faskes/insertdata', 'Faskes::insertdata');
$routes->get('faskes/getKabupaten/(:any)', 'Faskes::getKabupaten/$1');
$routes->get('faskes/getKecamatan/(:any)', 'Faskes::getKecamatan/$1');
$routes->get('faskes/edit/(:num)', 'Faskes::edit/$1');
$routes->post('faskes/updatedata/(:num)', 'Faskes::updatedata/$1');
$routes->get('faskes/delete/(:num)', 'Faskes::delete/$1');
$routes->get('faskes/detail/(:num)', 'Faskes::detail/$1');

// Matikan auto-routing demi keamanan (opsional, tapi disarankan)
$routes->setAutoRoute(false);

// ─── AUTH ────────────────────────────────────────────────────────────────────
// ─── AUTH ────────────────────────────────────────────────────────────────────
$routes->get('/',            'AuthController::index');       // Tetap redirect/tampilkan login di awal
$routes->get('auth/login',   'AuthController::index');       // Tampilkan form di URL auth/login
// Rute untuk menampilkan halaman form login (GET)
$routes->get('login', 'AuthController::index');

// Rute untuk memproses data form login saat disubmit (POST)
$routes->post('login', 'AuthController::login');

// ─── DASHBOARD (dilindungi AuthFilter) ───────────────────────────────────────
// Perbaikan: Tambahkan `use ($routes)` di bagian closure function
$routes->group('dashboard', ['filter' => 'auth'], function () use ($routes) {

    // Default dashboard
    $routes->get('/', 'DashboardController::index');

    // Dashboard per role
    $routes->get('admin',       'DashboardController::admin',       ['filter' => 'auth:admin']);
    $routes->get('dokter',      'DashboardController::dokter',      ['filter' => 'auth:dokter']);
    $routes->get('perawat',     'DashboardController::perawat',     ['filter' => 'auth:perawat']);
    $routes->get('apoteker',    'DashboardController::apoteker',    ['filter' => 'auth:apoteker']);
    $routes->get('resepsionis', 'DashboardController::resepsionis', ['filter' => 'auth:resepsionis']);
});