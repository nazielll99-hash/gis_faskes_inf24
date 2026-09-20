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