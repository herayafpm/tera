<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisRetribusiTipeSeeder extends Seeder
{
  public function run()
  {
    $initDatas = [
      [
        "jenis_retribusi_tipe_nama" => "Ukuran Panjang",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Permukaan Cairan (Level Gauge)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Takaran (Basah / Kering)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Tangki Ukur Bentuk Silinder Tegak",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Tangki Ukur Bentuk Bola dan Speriodal",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Tangki Ukur Bentuk Silinder Datar",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Gas Meter Induk",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Gas Meter Kerja",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Gas",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Air Induk",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Air Kerja",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Cairan Minum Selain Air Induk",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Cairan Minum Selain Air Kerja",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Kompensasi Suhu (ATC)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Prover",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Arus Massa",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Pengisi (Filling Machine)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Listrik (Meter kWh) Kelas 0,2 atau kurang",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Listrik (Meter kWh) Kelas 0,5 atau kelas 1",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Listrik (Meter kWh) Kelas 2",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Pembatas Arus Listrik",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Anak Timbangan Ketelitian Biasa (kelas M2 dan M3)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Anak Timbangan Ketelitian Khusus (kelas F2 dan M1)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Anak Timbangan Ketelitian Khusus (kelas E2 dan F1)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Dacin",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Sentisimal",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Bobot Ingsut",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Pegas",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Cepat",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Elektronik (Kelas III dan IV)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Elektronik (Kelas II)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Elektronik (Kelas I)",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Jembatan",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Timbangan Ban Berjalan",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Tekanan Dead Weight Testing Machine",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Tekanan",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Tekanan Manometer",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Alat Ukur Tekanan Pressure Recorder",
      ],
      [
        "jenis_retribusi_tipe_nama" => "Meter Kadar Air",
      ],
    ];
    foreach ($initDatas as $data) {
      $this->db->table('jenis_retribusi_tipe')->insert($data);
    }
  }
}
