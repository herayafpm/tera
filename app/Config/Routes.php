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
$routes->get('/', "Home::index");
$routes->group('auth', ['namespace' => '\App\Controllers\Auth'], function ($routes) {
	$routes->get('login', 'Login::index');
	$routes->post('login', 'Login::index');
	$routes->get('lupa_password', 'LupaPassword::index');
	$routes->post('lupa_password', 'LupaPassword::index');
	$routes->get('logout', 'Logout::index');
});
$routes->group('api', ['filter' => 'auth_admin', 'namespace' => '\App\Controllers\Api'], function ($routes) {
	$routes->resource('user', ['only' => ['show'], 'controller' => 'UserApi']);
	$routes->group('retribusi', function ($routes) {
		$routes->get('(:num)/(:num)/(:num)', 'RetribusiApi::retribusi/$1/$2/$3');
	});
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
			$routes->group('riwayat/(:num)', function ($routes) {
				$routes->get('', 'Riwayat::index/$1/$2');
				$routes->post('datatable', 'Riwayat::datatable/$1/$2');
				$routes->get('batal/(:num)/(:num)', 'Riwayat::batal/$1/$2/$3/$4');
				$routes->get('proses/(:num)/(:num)', 'Riwayat::proses/$1/$2/$3/$4');
				$routes->get('print_form/(:num)', 'Riwayat::print_form/$1/$2/$3');
			});
		});
		// $routes->group('pendaftaran/2', ['filter' => 'auth_admin:2', 'namespace' => '\App\Controllers\Admin\Tera\Pendaftaran'], function ($routes) {
		// 	$routes->group('riwayat/(:num)', function ($routes) {
		// 		$routes->get('', 'RiwayatTempatPakai::index/$1/$2');
		// 		$routes->post('datatable', 'RiwayatTempatPakai::datatable/$1/$2');
		// 		$routes->get('batal/(:num)/(:num)', 'RiwayatTempatPakai::batal/$1/$2/$3/$4');
		// 		$routes->get('proses/(:num)/(:num)', 'RiwayatTempatPakai::proses/$1/$2/$3/$4');
		// 		$routes->get('print_form/(:num)', 'RiwayatTempatPakai::print_form/$1/$2/$3');
		// 	});
		// });
		$routes->group('pengajuan', ['filter' => 'auth_admin:2', 'namespace' => '\App\Controllers\Admin\Tera\Pengajuan'], function ($routes) {
			$routes->get('', 'Pengajuan::index/$1');
			$routes->post('', 'Pengajuan::index/$1');
			$routes->group('riwayat/(:num)', function ($routes) {
				$routes->get('', 'Riwayat::index/$1');
				$routes->post('datatable', 'Riwayat::datatable/$1');
				$routes->get('batal/(:num)/(:num)', 'Riwayat::batal/$1/$2/$3');
				$routes->get('proses/(:num)/(:num)', 'Riwayat::proses/$1/$2/$3');
				$routes->get('print_surat_tugas/(:num)', 'Riwayat::print_surat_tugas/$1/$2');
			});
		});
		$routes->group('pembayaran/(:num)', ['filter' => 'auth_admin:3', 'namespace' => '\App\Controllers\Admin\Tera\Pembayaran'], function ($routes) {
			$routes->group('skrd/(:num)', function ($routes) {
				$routes->get('(:num)', 'Skrd::index/$1/$2/$3');
				$routes->post('(:num)', 'Skrd::index/$1/$2/$3');
				$routes->get('(:num)/print', 'Skrd::print/$1/$2/$3');
				$routes->get('(:num)/batal_penetapan', 'Skrd::batal_penetapan/$1/$2/$3');
			});
			$routes->group('keringanan/(:num)', function ($routes) {
				$routes->get('(:num)', 'Keringanan::index/$1/$2/$3');
				$routes->get('(:num)/batal/(:num)', 'Keringanan::batal/$1/$2/$3/$4');
				$routes->get('(:num)/verif/(:num)', 'Keringanan::verif/$1/$2/$3/$4');
				$routes->get('(:num)/tolak/(:num)', 'Keringanan::tolak/$1/$2/$3/$4');
				$routes->post('datatable/(:num)', 'Keringanan::datatable/$1/$2/$3/$4');
				$routes->group('(:num)/tambah', function ($routes) {
					$routes->get('', 'PengajuanKeringanan::index/$1/$2/$3');
					$routes->post('', 'PengajuanKeringanan::index/$1/$2/$3');
				});
			});
			$routes->group('skrdkb/(:num)', function ($routes) {
				$routes->get('(:num)', 'SkrdKb::index/$1/$2/$3');
				$routes->post('(:num)', 'SkrdKb::index/$1/$2/$3');
				$routes->get('(:num)/print', 'SkrdKb::print/$1/$2/$3');
				$routes->get('(:num)/batal/(:num)', 'SkrdKb::batal/$1/$2/$3/$4');
				$routes->get('(:num)/verif/(:num)', 'SkrdKb::verif/$1/$2/$3/$4');
				$routes->get('(:num)/tolak/(:num)', 'SkrdKb::tolak/$1/$2/$3/$4');
				$routes->post('datatable/(:num)', 'SkrdKb::datatable/$1/$2/$3/$4');
				$routes->group('(:num)/tambah', function ($routes) {
					$routes->get('', 'PengajuanSkrdKb::index/$1/$2/$3');
					$routes->post('', 'PengajuanSkrdKb::index/$1/$2/$3');
				});
			});
			$routes->group('skrdlb/(:num)', function ($routes) {
				$routes->get('(:num)', 'SkrdLb::index/$1/$2/$3');
				$routes->post('(:num)', 'SkrdLb::index/$1/$2/$3');
				$routes->get('(:num)/print', 'SkrdLb::print/$1/$2/$3');
				$routes->get('(:num)/batal/(:num)', 'SkrdLb::batal/$1/$2/$3/$4');
				$routes->get('(:num)/verif/(:num)', 'SkrdLb::verif/$1/$2/$3/$4');
				$routes->get('(:num)/tolak/(:num)', 'SkrdLb::tolak/$1/$2/$3/$4');
				$routes->post('datatable/(:num)', 'SkrdLb::datatable/$1/$2/$3/$4');
				$routes->group('(:num)/tambah', function ($routes) {
					$routes->get('', 'PengajuanSkrdLb::index/$1/$2/$3');
					$routes->post('', 'PengajuanSkrdLb::index/$1/$2/$3');
				});
			});
			$routes->group('ssrd/(:num)', function ($routes) {
				$routes->get('(:num)', 'Ssrd::index/$1/$2/$3');
				$routes->post('datatable/(:num)', 'Ssrd::datatable/$1/$2/$3');
				$routes->get('(:num)/verif/(:num)', 'Ssrd::verif/$1/$2/$3/$4');
				$routes->get('(:num)/batal/(:num)', 'Ssrd::batal/$1/$2/$3/$4');
				$routes->get('(:num)/tolak/(:num)', 'Ssrd::tolak/$1/$2/$3/$4');
				$routes->get('(:num)/print_ssrd/(:num)', 'Ssrd::print_ssrd/$1/$2/$3/$4');
				$routes->group('(:num)/tambah', function ($routes) {
					$routes->get('', 'PelunasanSsrd::index/$1/$2/$3');
					$routes->post('', 'PelunasanSsrd::index/$1/$2/$3');
				});
			});
			// $routes->group('skrdkb/(:num)', function ($routes) {
			// 	$routes->get('(:num)', 'SkrdKb::index/$1/$2/$3');
			// 	$routes->post('datatable/(:num)', 'SkrdKb::datatable/$1/$2/$3');
			// 	$routes->get('(:num)/verif/(:num)', 'SkrdKb::verif/$1/$2/$3/$4');
			// 	$routes->get('(:num)/batal/(:num)', 'SkrdKb::batal/$1/$2/$3/$4');
			// 	$routes->get('(:num)/tolak/(:num)', 'SkrdKb::tolak/$1/$2/$3/$4');
			// 	$routes->group('(:num)/tambah', function ($routes) {
			// 		$routes->get('', 'PengajuanSkrdKb::index/$1/$2/$3');
			// 		$routes->post('', 'PengajuanSkrdKb::index/$1/$2/$3');
			// 	});
			// });
			$routes->group('riwayat/(:num)', function ($routes) {
				$routes->get('', 'Riwayat::index/$1/$2');
				$routes->post('datatable', 'Riwayat::datatable/$1/$2');
			});
		});
		$routes->group('pengujian/1', ['filter' => 'auth_admin:4,5', 'namespace' => '\App\Controllers\Admin\Tera\Pengujian'], function ($routes) {
			$routes->group('riwayat/(:num)', function ($routes) {
				$routes->get('', 'Riwayat::index/$1');
				$routes->post('datatable', 'Riwayat::datatable/$1');
			});
		});
		$routes->group('pengujian/2', ['filter' => 'auth_admin:4,5', 'namespace' => '\App\Controllers\Admin\Tera\Pengujian'], function ($routes) {
			$routes->group('riwayat/(:num)', function ($routes) {
				$routes->get('', 'RiwayatTempatPakai::index/$1');
				$routes->post('datatable', 'RiwayatTempatPakai::datatable/$1');
			});
		});
		$routes->group('pengujian/(:num)', ['filter' => 'auth_admin:4,5', 'namespace' => '\App\Controllers\Admin\Tera\Pengujian'], function ($routes) {
			$routes->group('riwayat/(:num)/uji', function ($routes) {
				$routes->get('(:num)', 'Pengujian::index/$1/$2/$3');
				$routes->group('(:num)/(:num)', function ($routes) {
					$routes->get('print_berita_acara', 'Pengujian::print_berita_acara/$1/$2/$3/$4');
					$routes->get('print_hasil_pengujian', 'Pengujian::print_hasil_pengujian/$1/$2/$3/$4');
					$routes->get('', 'RiwayatPengujian::index/$1/$2/$3/$4');
					$routes->post('datatable', 'RiwayatPengujian::datatable/$1/$2/$3/$4');
					$routes->get('verif/(:num)', 'RiwayatPengujian::verif/$1/$2/$3/$4/$5');
					$routes->get('batal/(:num)', 'RiwayatPengujian::batal/$1/$2/$3/$4/$5');
					$routes->get('tolak/(:num)', 'RiwayatPengujian::tolak/$1/$2/$3/$4/$5');
					$routes->get('verif_all', 'RiwayatPengujian::verif_all/$1/$2/$3/$4');
					$routes->get('batal_all', 'RiwayatPengujian::batal_all/$1/$2/$3/$4');
					$routes->get('tolak_all', 'RiwayatPengujian::tolak_all/$1/$2/$3/$4');
					$routes->group('(:num)', function ($routes) {
						$routes->get('', 'HasilPengujianAll::index/$1/$2/$3/$4/$5');
						$routes->post('', 'HasilPengujianAll::index/$1/$2/$3/$4/$5');
					});
					$routes->get('(:num)/print_keterangan_pengganti', 'RiwayatPengujian::print_keterangan_pengganti/$1/$2/$3/$4/$5');
					$routes->group('(:num)/(:num)', function ($routes) {
						$routes->get('', 'HasilPengujian::index/$1/$2/$3/$4/$5/$6');
						$routes->post('', 'HasilPengujian::index/$1/$2/$3/$4/$5/$6');
						$routes->get('print_hasil', 'HasilPengujian::print_hasil/$1/$2/$3/$4/$5/$6');
					});
				});
			});
		});
	});
});

$routes->group('user', ['filter' => 'auth_user', 'namespace' => '\App\Controllers\User'], function ($routes) {
	$routes->group('tera', ['filter' => 'auth_user', 'namespace' => '\App\Controllers\User\Tera'], function ($routes) {
		$routes->group('pendaftaran', ['filter' => 'auth_user', 'namespace' => '\App\Controllers\User\Tera\Pendaftaran'], function ($routes) {
			$routes->group('riwayat', function ($routes) {
				$routes->get('', 'Riwayat::index');
				$routes->post('datatable', 'Riwayat::datatable');
			});
		});
		$routes->group('pembayaran', ['filter' => 'auth_user', 'namespace' => '\App\Controllers\User\Tera\Pembayaran'], function ($routes) {
			$routes->group('riwayat', function ($routes) {
				$routes->get('', 'Riwayat::index');
				$routes->post('datatable', 'Riwayat::datatable');
			});
		});
		$routes->group('pengujian', ['filter' => 'auth_user', 'namespace' => '\App\Controllers\User\Tera\Pengujian'], function ($routes) {
			$routes->group('riwayat', function ($routes) {
				$routes->get('', 'Riwayat::index');
				$routes->post('datatable', 'Riwayat::datatable');
			});
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
