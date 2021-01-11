<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', function () {
	return redirect()->to(base_url('auth/login'));
});
$routes->group('auth', ['namespace' => '\App\Controllers\Auth'], function ($routes) {
	$routes->get('login', 'Login::index');
	$routes->post('login', 'Login::index');
	$routes->get('lupa_password', 'LupaPassword::index');
	$routes->post('lupa_password', 'LupaPassword::index');
	$routes->get('logout', 'Logout::index');
});
$routes->group('api', ['filter' => 'auth_admin', 'namespace' => '\App\Controllers\Api'], function ($routes) {
	$routes->resource('user', ['only' => ['show'], 'controller' => 'UserApi']);
});
$routes->group('admin', ['filter' => 'auth_admin', 'namespace' => '\App\Controllers\Admin'], function ($routes) {
	$routes->get('', 'Dashboard::index');
	$routes->get('dashboard', 'Dashboard::index');
	$routes->group('profile', function ($routes) {
		$routes->get('', 'Profile::index');
		$routes->post('', 'Profile::index');
	});
	$routes->group('log', function ($routes) {
		$routes->get('', 'Log::index');
		$routes->post('datatable', 'Log::datatable');
	});
	$routes->group('admin', function ($routes) {
		$routes->get('', 'Admin::index');
		$routes->post('datatable', 'Admin::datatable');
		$routes->group('tambah', function ($routes) {
			$routes->get('', 'Admin::tambah');
			$routes->post('', 'Admin::tambah');
		});
		$routes->group('ubah', function ($routes) {
			$routes->get('(:num)', 'Admin::ubah/$1');
			$routes->post('(:num)', 'Admin::ubah/$1');
		});
		$routes->get('hapus/(:num)', 'Admin::hapus/$1');
		$routes->group('log', function ($routes) {
			$routes->get('(:num)', 'Admin::log/$1');
			$routes->post('(:num)/datatable', 'Admin::log_datatable/$1');
		});
	});
	$routes->group('user', function ($routes) {
		$routes->get('', 'User::index');
		$routes->post('datatable', 'User::datatable');
		$routes->group('ubah', function ($routes) {
			$routes->get('(:num)', 'User::ubah/$1');
			$routes->post('(:num)', 'User::ubah/$1');
		});
		$routes->get('hapus/(:num)', 'User::hapus/$1');
		$routes->group('log', function ($routes) {
			$routes->get('(:num)', 'User::log/$1');
			$routes->post('(:num)/datatable', 'User::log_datatable/$1');
		});
	});
	$routes->group('aparatur', function ($routes) {
		$routes->get('', 'Aparatur::index');
		$routes->post('datatable', 'Aparatur::datatable');
		$routes->group('tambah', function ($routes) {
			$routes->get('', 'Aparatur::tambah');
			$routes->post('', 'Aparatur::tambah');
		});
		$routes->group('ubah', function ($routes) {
			$routes->get('(:num)', 'Aparatur::ubah/$1');
			$routes->post('(:num)', 'Aparatur::ubah/$1');
		});
		$routes->get('hapus/(:num)', 'Aparatur::hapus/$1');
	});
	$routes->group('master', ['filter' => 'auth_admin:1', 'namespace' => '\App\Controllers\Admin\Master'], function ($routes) {
		$routes->group('jabatan', function ($routes) {
			$routes->get('', 'Jabatan::index');
			$routes->post('datatable', 'Jabatan::datatable');
			$routes->group('tambah', function ($routes) {
				$routes->get('', 'Jabatan::tambah');
				$routes->post('', 'Jabatan::tambah');
			});
			$routes->group('ubah', function ($routes) {
				$routes->get('(:num)', 'Jabatan::ubah/$1');
				$routes->post('(:num)', 'Jabatan::ubah/$1');
			});
			$routes->get('hapus/(:num)', 'Jabatan::hapus/$1');
		});
		$routes->group('jenis_uttp_tipe', function ($routes) {
			$routes->get('', 'JenisUttpTipe::index');
			$routes->post('datatable', 'JenisUttpTipe::datatable');
			$routes->group('tambah', function ($routes) {
				$routes->get('', 'JenisUttpTipe::tambah');
				$routes->post('', 'JenisUttpTipe::tambah');
			});
			$routes->group('ubah', function ($routes) {
				$routes->get('(:num)', 'JenisUttpTipe::ubah/$1');
				$routes->post('(:num)', 'JenisUttpTipe::ubah/$1');
			});
			$routes->get('hapus/(:num)', 'JenisUttpTipe::hapus/$1');
		});
		$routes->group('jenis_uttp', function ($routes) {
			$routes->get('', 'JenisUttp::index');
			$routes->post('datatable', 'JenisUttp::datatable');
			$routes->group('tambah', function ($routes) {
				$routes->get('', 'JenisUttp::tambah');
				$routes->post('', 'JenisUttp::tambah');
			});
			$routes->group('ubah', function ($routes) {
				$routes->get('(:num)', 'JenisUttp::ubah/$1');
				$routes->post('(:num)', 'JenisUttp::ubah/$1');
			});
			$routes->get('hapus/(:num)', 'JenisUttp::hapus/$1');
		});
		$routes->group('jenis_retribusi_tipe', function ($routes) {
			$routes->get('', 'JenisRetribusiTipe::index');
			$routes->post('datatable', 'JenisRetribusiTipe::datatable');
			$routes->group('tambah', function ($routes) {
				$routes->get('', 'JenisRetribusiTipe::tambah');
				$routes->post('', 'JenisRetribusiTipe::tambah');
			});
			$routes->group('ubah', function ($routes) {
				$routes->get('(:num)', 'JenisRetribusiTipe::ubah/$1');
				$routes->post('(:num)', 'JenisRetribusiTipe::ubah/$1');
			});
			$routes->get('hapus/(:num)', 'JenisRetribusiTipe::hapus/$1');
		});
		$routes->group('jenis_retribusi', function ($routes) {
			$routes->get('', 'JenisRetribusi::index');
			$routes->post('datatable', 'JenisRetribusi::datatable');
			$routes->group('tambah', function ($routes) {
				$routes->get('', 'JenisRetribusi::tambah');
				$routes->post('', 'JenisRetribusi::tambah');
			});
			$routes->group('ubah', function ($routes) {
				$routes->get('(:num)', 'JenisRetribusi::ubah/$1');
				$routes->post('(:num)', 'JenisRetribusi::ubah/$1');
			});
			$routes->get('hapus/(:num)', 'JenisRetribusi::hapus/$1');
		});
		$routes->group('jenis_uttp_retribusi', function ($routes) {
			$routes->get('', 'JenisUttpRetribusi::index');
			$routes->post('datatable', 'JenisUttpRetribusi::datatable');
			$routes->group('ubah', function ($routes) {
				$routes->get('(:num)', 'JenisUttpRetribusi::ubah/$1');
				$routes->post('(:num)', 'JenisUttpRetribusi::ubah/$1');
			});
		});
	});
	$routes->group('tera', ['namespace' => '\App\Controllers\Admin\Tera'], function ($routes) {
		$routes->group('pendaftaran/(:num)', ['filter' => 'auth_admin:2', 'namespace' => '\App\Controllers\Admin\Tera\Pendaftaran'], function ($routes) {
			$routes->get('', 'Pendaftaran::index/$1');
			$routes->post('', 'Pendaftaran::index/$1');
		});
	});
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
