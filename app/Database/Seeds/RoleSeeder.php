<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
	public function run()
	{
		$initDatas = [
			[
				"role_nama" => "super admin",
			],
			[
				"role_nama" => "petugas pendaftaran",
			],
			[
				"role_nama" => "bendahara penerimaan pembantu",
			],
			[
				"role_nama" => "pegawai berhak",
			],
			[
				"role_nama" => "petugas loket",
			],
		];
		$this->db->table('role')->insertBatch($initDatas);
	}
}
