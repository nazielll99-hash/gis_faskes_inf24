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

// Matikan auto-routing demi keamanan
$routes->setAutoRoute(false);

// ─── HALAMAN PUBLIK ───────────────────────────────────────────────────────────
$routes->get('/', 'Home::index');

// ─── AUTH ─────────────────────────────────────────────────────────────────────
$routes->get('auth/login',  'AuthController::index');
$routes->get('login',       'AuthController::index');
$routes->post('login',      'AuthController::login');
$routes->get('logout',      'AuthController::logout');

// Feedback (publik, tanpa login)
$routes->post('feedback/simpan', 'Feedback::simpan');

// ─── PANEL ADMIN (dilindungi AuthFilter) ─────────────────────────────────────
$routes->group('', ['filter' => 'auth'], function () use ($routes) {

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
    $routes->get('user/edit/(:num)', 'User::edit/$1');
    $routes->post('user/update/(:num)', 'User::update/$1');

    $routes->get('faskes', 'Faskes::index');
    $routes->get('faskes/input', 'Faskes::input');
    $routes->post('faskes/insertdata', 'Faskes::insertdata');
    $routes->get('faskes/getKabupaten/(:any)', 'Faskes::getKabupaten/$1');
    $routes->get('faskes/getKecamatan/(:any)', 'Faskes::getKecamatan/$1');
    $routes->get('faskes/edit/(:num)', 'Faskes::edit/$1');
    $routes->post('faskes/updatedata/(:num)', 'Faskes::updatedata/$1');
    $routes->get('faskes/delete/(:num)', 'Faskes::delete/$1');
    $routes->get('faskes/detail/(:num)', 'Faskes::detail/$1');
});

// ─── DASHBOARD LAMA (kalau masih dipakai, tetap dilindungi AuthFilter) ───────
$routes->group('dashboard', ['filter' => 'auth'], function () use ($routes) {

    $routes->get('/', 'DashboardController::index');

    $routes->get('admin',       'DashboardController::admin',       ['filter' => 'auth:admin']);
    $routes->get('dokter',      'DashboardController::dokter',      ['filter' => 'auth:dokter']);
    $routes->get('perawat',     'DashboardController::perawat',     ['filter' => 'auth:perawat']);
    $routes->get('apoteker',    'DashboardController::apoteker',    ['filter' => 'auth:apoteker']);
    $routes->get('resepsionis', 'DashboardController::resepsionis', ['filter' => 'auth:resepsionis']);
});

// ═══════════════════════════════════════════════════════════════════════════════
//  REST API ENDPOINTS
//  Semua endpoint mengembalikan JSON. Prefix: /api/
// ═══════════════════════════════════════════════════════════════════════════════

$routes->group('api', function () use ($routes) {

    // ── Index (daftar endpoint) ──────────────────────────────────────────────
    $routes->get('/', 'Api::index');

    // ── Faskes (GET: publik) ──────────────────────────────────────────────────
    $routes->get('faskes',          'Api::faskes');         // Semua faskes + filter
    $routes->get('faskes/map',      'Api::faskesMap');      // Data GeoJSON untuk peta
    $routes->get('faskes/(:num)',   'Api::faskesDetail/$1');// Detail 1 faskes

    // ── Wilayah ──────────────────────────────────────────────────────────────
    $routes->get('wilayah',         'Api::wilayah');
    $routes->get('wilayah/(:num)',  'Api::wilayahDetail/$1');

    // ── Kategori ─────────────────────────────────────────────────────────────
    $routes->get('kategori',        'Api::kategori');

    // ── Wilayah Administratif ────────────────────────────────────────────────
    $routes->get('provinsi',            'Api::provinsi');
    $routes->get('kabupaten/(:num)',    'Api::kabupaten/$1');
    $routes->get('kecamatan/(:num)',    'Api::kecamatan/$1');

    // ── Feedback (publik: bisa kirim) ────────────────────────────────────────
    $routes->get('feedback',        'Api::feedback');
    $routes->post('feedback',       'Api::feedbackCreate');

    // ── Statistik ────────────────────────────────────────────────────────────
    $routes->get('statistik',       'Api::statistik');

    // ── Setting ──────────────────────────────────────────────────────────────
    $routes->get('setting',         'Api::setting');
});

// ── Mutasi API (dilindungi autentikasi admin dan merespons JSON) ─────────────
$routes->group('api', ['filter' => 'apiAuth'], function () use ($routes) {
    $routes->post('faskes',             'Api::faskesCreate');
    $routes->put('faskes/(:num)',       'Api::faskesUpdate/$1');
    $routes->patch('faskes/(:num)',     'Api::faskesUpdate/$1');
    $routes->delete('faskes/(:num)',    'Api::faskesDelete/$1');

    $routes->post('wilayah',            'Api::wilayahCreate');
    $routes->put('wilayah/(:num)',      'Api::wilayahUpdate/$1');
    $routes->patch('wilayah/(:num)',    'Api::wilayahUpdate/$1');
    $routes->delete('wilayah/(:num)',   'Api::wilayahDelete/$1');
});