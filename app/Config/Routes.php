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
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/setting', 'Admin::Setting');
$routes->post('admin/updateSetting', 'Admin::updateSetting');
$routes->get('/wilayah', 'Wilayah::index');
$routes->get('/Wilayah/Input', 'Wilayah::Input');
$routes->post('Wilayah/InsertData', 'Wilayah::InsertData');
$routes->get('Wilayah', 'Wilayah::index'); // Untuk huruf kapital
$routes->get('wilayah', 'Wilayah::index'); // Untuk huruf kecil
$routes->get('wilayah/edit/(:num)', 'Wilayah::edit/$1'); 
$routes->post('wilayah/updatedata/(:num)', 'Wilayah::UpdateData/$1');


