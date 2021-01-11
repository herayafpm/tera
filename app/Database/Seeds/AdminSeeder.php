<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
	public function run()
	{
		$password = password_hash(env('passwordDefault'), PASSWORD_DEFAULT);
		$date = date('Y-m-d H:i:s');
		$initDatas = [
			[
				"admin_username" => "superadmin",
				"admin_nama" => "Super Admin",
				"role_id" => 1,
				'admin_password' => $password,
				'admin_created' => $date,
				'admin_updated' => $date,
			],
			[
				"admin_username" => "19681124 199603 1 006",
				"admin_nama" => "Petugas Pendaftaran",
				"role_id" => 2,
				'admin_password' => $password,
				'admin_created' => $date,
				'admin_updated' => $date,
			],
			[
				"admin_username" => "19681122 199603 1 006",
				"admin_nama" => "Bendahara Penerimaan Pembantu",
				"role_id" => 3,
				'admin_password' => $password,
				'admin_created' => $date,
				'admin_updated' => $date,
			],
			[
				"admin_username" => "19681123 199603 1 006",
				"admin_nama" => "Pegawai Yang Berhak",
				"role_id" => 4,
				'admin_password' => $password,
				'admin_created' => $date,
				'admin_updated' => $date,
			],
			[
				"admin_username" => "19681125 199603 1 006",
				"admin_nama" => "Petugas Loket",
				"role_id" => 5,
				'admin_password' => $password,
				'admin_created' => $date,
				'admin_updated' => $date,
			],
		];
		$this->db->table('admin')->insertBatch($initDatas);
	}
}
