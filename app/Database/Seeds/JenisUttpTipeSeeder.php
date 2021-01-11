<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisUttpTipeSeeder extends Seeder
{
  public function run()
  {
    $initDatas = [
      [
        "jenis_uttp_tipe_nama" => "Non Automatic Level Gauge",
      ],
      [
        "jenis_uttp_tipe_nama" => "Automatic Level Gauge",
      ],
      [
        "jenis_uttp_tipe_nama" => "Takaran",
      ],
      [
        "jenis_uttp_tipe_nama" => "Timbangan Otomatis",
      ],
      [
        "jenis_uttp_tipe_nama" => "Timbangan Bukan Otomatis Yang Penunjuknya Otomatis",
      ],
      [
        "jenis_uttp_tipe_nama" => "Timbangan Bukan Otomatis Yang Penunjuknya Semi Otomatis",
      ],
      [
        "jenis_uttp_tipe_nama" => "Timbangan Bukan Otomatis Yang Penunjuknya Bukan Otomatis",
      ],
      [
        "jenis_uttp_tipe_nama" => "Meter Arus Bahan Bakar Minyak dan Produk Terkait",
      ],
      [
        "jenis_uttp_tipe_nama" => "Meter Gas",
      ],
      [
        "jenis_uttp_tipe_nama" => "Meter Air",
      ],
      [
        "jenis_uttp_tipe_nama" => "Alat Ukur Energi Listrik (Meter kWh)",
      ],
    ];
    $this->db->table('jenis_uttp_tipe')->insertBatch($initDatas);
  }
}
