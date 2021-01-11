<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisTeraSeeder extends Seeder
{
	public function run()
	{
		$initDatas = [
			[
				"jenis_tera_nama" => "Tera",
			],
			[
				"jenis_tera_nama" => "Tera Ulang",
			],
		];
		$this->db->table('jenis_tera')->insertBatch($initDatas);
	}
}
