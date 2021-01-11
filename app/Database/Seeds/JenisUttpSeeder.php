<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisUttpSeeder extends Seeder
{
  public function run()
  {
    $initDatas = [
      [
        "jenis_uttp_nama" => "Meter Kayu",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Ban Ukur",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Depth Tape",
        "jenis_uttp_tipe_id" => 1,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Ullage Temperatur Interface (UTI)",
        "jenis_uttp_tipe_id" => 1,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Capacitance Level Gauge",
        "jenis_uttp_tipe_id" => 2,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Radar Level Gauge",
        "jenis_uttp_tipe_id" => 2,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Ultrasonic Level Gauge",
        "jenis_uttp_tipe_id" => 2,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Float Level Gauge",
        "jenis_uttp_tipe_id" => 2,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Servo Level Gauge",
        "jenis_uttp_tipe_id" => 2,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Electromagnetic Level Gauge",
        "jenis_uttp_tipe_id" => 2,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Meter Taksi",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Meter Parkir",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Takaran Kering",
        "jenis_uttp_tipe_id" => 3,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Takaran Basah",
        "jenis_uttp_tipe_id" => 3,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Tangki Ukur Mobil Bahan Bakar Minyak",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Tangki Ukur Tetap Silinder Tegak Bahan Bakar Minyak",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Tangki Ukur Tongkang",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Tangki Ukur Kapal",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Ban Berjalan",
        "jenis_uttp_tipe_id" => 4,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Weighting in Motion (Timbangan Kendaraan Bergerak)",
        "jenis_uttp_tipe_id" => 4,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Railweight Bridge (Timbangan Kereta Api Bergerak)",
        "jenis_uttp_tipe_id" => 4,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Pengecek dan Penyortir",
        "jenis_uttp_tipe_id" => 4,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Elektronik Kelas I",
        "jenis_uttp_tipe_id" => 5,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Elektronik Kelas II",
        "jenis_uttp_tipe_id" => 5,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Elektronik Kelas III",
        "jenis_uttp_tipe_id" => 5,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Elektronik Kelas IV",
        "jenis_uttp_tipe_id" => 5,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Pegas",
        "jenis_uttp_tipe_id" => 5,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Cepat",
        "jenis_uttp_tipe_id" => 5,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Cepat Meja",
        "jenis_uttp_tipe_id" => 6,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Neraca",
        "jenis_uttp_tipe_id" => 7,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Dacin",
        "jenis_uttp_tipe_id" => 7,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Milisimal",
        "jenis_uttp_tipe_id" => 7,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Sentisimal",
        "jenis_uttp_tipe_id" => 7,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Desimal",
        "jenis_uttp_tipe_id" => 7,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Bobot Ingsut",
        "jenis_uttp_tipe_id" => 7,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Timbangan Meja Beranger",
        "jenis_uttp_tipe_id" => 7,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Meter Kadar Air",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Pompa Ukur Bahan Bakar Minyak",
        "jenis_uttp_tempat_pakai" => 1,
      ],
      [
        "jenis_uttp_nama" => "Pompa Ukur Elpiji (Liquified Petroleum Gas)",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Pompa Ukur Bahan Bakar Gas",
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Positive Displacement Meter",
        "jenis_uttp_tipe_id" => 8,
        "jenis_uttp_tempat_pakai" => 1,
      ],
      [
        "jenis_uttp_nama" => "Turbine Flow Meter",
        "jenis_uttp_tipe_id" => 8,
        "jenis_uttp_tempat_pakai" => 1,
      ],
      [
        "jenis_uttp_nama" => "Mass Flow Meter (Meter Arus Pengukur Massa)",
        "jenis_uttp_tipe_id" => 8,
        "jenis_uttp_tempat_pakai" => 1,
      ],
      [
        "jenis_uttp_nama" => "Meter Gas Rotary Piston",
        "jenis_uttp_tipe_id" => 9,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Meter Gas Turbin",
        "jenis_uttp_tipe_id" => 9,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Meter Gas Orifice",
        "jenis_uttp_tipe_id" => 9,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "Ultrasonic Gas Flow Meter",
        "jenis_uttp_tipe_id" => 9,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "dengan Diameter Nominal (DN) sampai 50 mm",
        "jenis_uttp_tipe_id" => 10,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "dengan Diameter Nominal (DN) > 50 - 254 mm",
        "jenis_uttp_tipe_id" => 10,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "kelas 2 atau (A)",
        "jenis_uttp_tipe_id" => 11,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "kelas 1 atau (B)",
        "jenis_uttp_tipe_id" => 11,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "kelas 0,5 atau (C)",
        "jenis_uttp_tipe_id" => 11,
        "jenis_uttp_tempat_pakai" => 0,
      ],
      [
        "jenis_uttp_nama" => "kelas 0,2 atau (D)",
        "jenis_uttp_tipe_id" => 11,
        "jenis_uttp_tempat_pakai" => 0,
      ],
    ];
    foreach ($initDatas as $data) {
      $this->db->table('jenis_uttp')->insert($data);
    }
  }
}
