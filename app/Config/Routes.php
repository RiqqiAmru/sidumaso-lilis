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
$routes->get('Dashboard', 'Dashboard::index');



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
$routes->get('admin/manageuser/edit/(:num)', 'Admin\Manageuser::edit/$1');
$routes->post('admin/manageuser/update/(:num)', 'Admin\Manageuser::update/$1');
// Route untuk store user
$routes->get('masyarakat/pengaduan', 'Admin\Manageuser::index');
$routes->get('/tanggapan/(:num)', 'Pengaduan::getByPengaduanId/$1');
$routes->get('pengaduan/proses/(:num)/(:alpha)?', 'Pengaduan::proses/$1/$2');
$routes->get('/pengaduan/edit/(:num)', 'Pengaduan::edit/$1');
$routes->post('/pengaduan/update/(:num)', 'Pengaduan::update/$1');
$routes->get('/pengaduan/laporan', 'Pengaduan::laporan');


$routes->get('/pengumuman', 'Pengumuman::index');
$routes->get('/pengumuman/create', 'Pengumuman::create');
$routes->post('/pengumuman/store', 'Pengumuman::store');
$routes->get('/pengumuman/edit/(:num)', 'Pengumuman::edit/$1');
$routes->post('/pengumuman/update/(:num)', 'Pengumuman::update/$1');
$routes->get('/pengumuman/detail/(:num)', 'Pengumuman::detail/$1');

$routes->get('/profile', 'AkunController::index');// Halaman Akun
$routes->get('/akun/edit', 'AkunController::edit'); // Route untuk halaman edit akun
$routes->post('/akun/update', 'AkunController::update'); // Route untuk proses update akun
// Menangani proses update akun

