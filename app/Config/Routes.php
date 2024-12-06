<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/**
 * @
 */
$routes->get('/', 'Home::index');
// $routes->get('/', 'Pengaduan::index');
// $routes->get('/', 'Pengaduan::addUser');

//saran

$routes->get('/saran/create', 'SaranController::create'); // Menampilkan form (landing.php)
$routes->post('/saran/store', 'SaranController::store'); // Menyimpan saran

$routes->get('/admin/manageuser', 'Admin\Manageuser::index');
$routes->get('/admin/manageuser/addUser', 'Admin\Manageuser::addUser'); // Menampilkan form (landing.php)
// Menampilkan form (landing.php)

$routes->get('/admin/user/tambah', 'Admin\Manageuser::addUser');  // Route untuk form tambah user
$routes->post('/admin/user/store', 'Admin\Manageuser::storeUser');
$routes->get('admin/user/index', 'Admin\Manageuser::index');
$routes->post('admin/user/delete/(:num)', 'Admin\Manageuser::deleteUser/$1');
$routes->post('admin/user/verifikasi/(:num)', 'Admin\Manageuser::verifikasi/$1');
// Route untuk store user
$routes->get('masyarakat/pengaduan', 'Admin\Manageuser::index');
$routes->get('/tanggapan/(:num)', 'Pengaduan::getByPengaduanId/$1');
$routes->get('pengaduan/proses/(:num)/(:alpha)?', 'Pengaduan::proses/$1/$2');
