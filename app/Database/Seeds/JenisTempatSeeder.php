<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisTempatSeeder extends Seeder
{
  public function run()
  {
    $initDatas = [
      [
        "jenis_tempat_nama" => "Kantor / Luar Kantor",
      ],
      [
        "jenis_tempat_nama" => "Tempat Pakai",
      ],
    ];
    $this->db->table('jenis_tempat')->insertBatch($initDatas);
  }
}
