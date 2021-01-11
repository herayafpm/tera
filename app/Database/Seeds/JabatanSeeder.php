<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JabatanSeeder extends Seeder
{
  public function run()
  {
    $initDatas = [
      [
        "jabatan_nama" => "KEPALA DINPERINDAG KAB. BANYUMAS",
      ],
      [
        "jabatan_nama" => "Sekretaris Dinas",
      ],
      [
        "jabatan_nama" => "Kepala Bidang Metrologi",
      ],
      [
        "jabatan_nama" => "Bendahara Penerimaan Pembantu",
      ],
      [
        "jabatan_nama" => "Pegawai Yang Berhak",
      ],
      [
        "jabatan_nama" => "Petugas Pendaftaran",
      ],
      [
        "jabatan_nama" => "Petugas Loket",
      ],
    ];
    $this->db->table('jabatan')->insertBatch($initDatas);
  }
}
