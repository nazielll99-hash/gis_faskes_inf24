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
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/setting', 'Admin::Setting');
$routes->post('admin/updateSetting', 'Admin::updateSetting');
$routes->get('/Wilayah', 'Wilayah::index');