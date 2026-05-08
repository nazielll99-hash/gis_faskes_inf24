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
$routes->get('/Admin', 'Admin::index');
$routes->get('/admin/setting', 'Admin::Setting');
$routes->post('Admin/updateSetting', 'Admin::updateSetting');
$routes->get('/Wilayah', 'Wilayah::index');
$routes->get('/Wilayah/Input', 'Wilayah::Input');
$routes->post('Wilayah/InsertData', 'Wilayah::InsertData');
$routes->get('Wilayah', 'Wilayah::index'); // Untuk huruf kapital
$routes->get('Wilayah', 'Wilayah::index'); // Untuk huruf kecil
$routes->get('Wilayah/edit/(:num)', 'Wilayah::edit/$1'); 
$routes->post('Wilayah/updatedata/(:num)', 'Wilayah::UpdateData/$1');
$routes->get('Wilayah/delete/(:any)', 'Wilayah::Delete/$1');
$routes->get('/user', 'User::index');
$routes->get('/kategori', 'Kategori::index');
$routes->get('/faskes', 'Faskes::index');

