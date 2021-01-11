<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\JenisTeraModel;
use App\Models\JenisTempatModel;

class JenisRetribusiSeeder extends Seeder
{
  public function run()
  {
    // Ukuran Panjang
    $tarifs = [
      3000, 13000,  4000, 14000,
      15000, 25000, 20000, 25000,
      20000, 30000, 25000, 30000,
      30000, 40000, 30000, 35000,
      35000, 45000, 35000, 40000,
      40000, 50000, 40000, 45000,
      45000, 55000, 45000, 50000,
      50000, 60000, 50000, 55000,
      10000, 30000, 10000, 30000,
      15000, 35000, 15000, 35000,
    ];
    $namas = [
      '1 m',
      '> 1 - 2 m',
      '> 2 - 10 m',
      '> 10 - 20 m',
      '> 20 - 30 m',
      '> 30 - 40 m',
      '> 40 - 50 m',
      '> 50 m',
      'Jenis Alat Ukur Tinggi Orang',
      'Counter Meter',
    ];
    $this->data($namas, $tarifs, 1);
    // Alat Ukur Permukaan Cairan (Level GAUGE)
    $tarifs = [
      150000, 400000, 150000, 400000,
      200000, 500000, 200000, 500000,
    ];
    $namas = [
      'Cairan Mekanik',
      'Cairan Elektronik',
    ];
    $this->data($namas, $tarifs, 2);
    // Takaran
    $tarifs = [
      500, 11500, 500, 11500,
      1000, 10000, 1000, 12000,
      5000, 16000, 5000, 16000,
    ];
    $namas = [
      '2 L',
      '> 2 - 25 L',
      '> 25 L',
    ];
    $this->data($namas, $tarifs, 3);
    // Tangki Ukur Bentuk Silinder Tegak
    $tarifs = [
      0, 550000, 0, 575000,
      0, 650000, 0, 725000,
      0, 800000, 0, 925000,
      0, 950000, 0, 1025000,
      0, 1100000, 0, 1175000,
      0, 1850000, 0, 1850000,
      0, 3350000, 0, 3350000,
      0, 5350000, 0, 5350000,
    ];
    $namas = [
      '500 kL',
      '> 500 - 1.000 kL',
      '> 1.000 - 2.000 kL',
      '> 2.000 - 5.000 kL',
      '> 5.000 - 10.000 kL',
      '> 10.000 - 50.000 kL',
      '> 50.000 - 100.000 kL',
      '> 100.000 kL',
    ];
    $this->data($namas, $tarifs, 4);
    // Tangki Ukur Bentuk Bola dan Speroidal
    $tarifs = [
      0, 500000, 0, 500000,
      0, 750000, 0, 750000,
      0, 2000000, 0, 2000000,
      0, 2500000, 0, 3500000,
      0, 6500000, 0, 6500000,
    ];
    $namas = [
      '500 kL',
      '> 500 - 1.000 kL',
      '> 1.000 - 5.000 kL',
      '> 5.000 - 10.000 kL',
      '> 10.000 kL',
    ];
    $this->data($namas, $tarifs, 5);
    // Tangki Ukur Bentuk Silinder Datar
    $tarifs = [
      0, 675000, 0, 675000,
      0, 750000, 0, 750000,
      0, 850000, 0, 850000,
      0, 950000, 0, 950000,
    ];
    $namas = [
      '10 kL',
      '> 10 - 15 kL',
      '> 15 - 20 kL',
      '> 20 - 25 kL',
    ];
    $this->data($namas, $tarifs, 6);
    // Alat Ukur Gas Meter Induk
    $tarifs = [
      0, 250000, 0, 250000,
      0, 450000, 0, 450000,
      0, 600000, 0, 600000,
      0, 750000, 0, 750000,
      0, 1000000, 0, 1000000,
    ];
    $namas = [
      '100 m3/h',
      '> 100 - 500 m3/h',
      '> 500 - 1.000 m3/h',
      '> 1.000 - 2.000 m3/h',
      '> 2.000 m3/h',
    ];
    $this->data($namas, $tarifs, 7);
    // Alat Ukur Gas Meter Kerja
    $tarifs = [
      0, 150000, 0, 150000,
      0, 250000, 0, 250000,
      0, 350000, 0, 350000,
      0, 450000, 0, 450000,
      0, 750000, 0, 750000,
    ];
    $namas = [
      '50 m3/h',
      '> 50 - 500 m3/h',
      '> 500 - 1.000 m3/h',
      '> 1.000 - 2.000 m3/h',
      '> 2.000 m3/h',
    ];
    $this->data($namas, $tarifs, 8);
    // Alat Ukur Gas
    $tarifs = [
      0, 300000, 0, 300000,
      0, 75000, 0, 75000,
      0, 150000, 0, 150000,
    ];
    $namas = [
      'Meter gas orifice dan sejenisnya (merupakan satu sistem / unit alat ukur)',
      'Perlengkapan meter gas orifice (jika diuji tersendiri) setiap alat perlengkapan',
      'Pompa ukur Bahan Bakar Gas (BBG) dan Elpiji untuk setiap badan ukur',
    ];
    $this->data($namas, $tarifs, 9);
    // Meter Air Induk
    $tarifs = [
      100000, 120000, 150000, 175000,
      150000, 170000, 250000, 275000,
      200000, 220000, 300000, 325000,
    ];
    $namas = [
      '15 m3/h',
      '> 15 - 100 m3/h',
      '> 100 m3/h',
    ];
    $this->data($namas, $tarifs, 10);
    // Meter Air Kerja
    $tarifs = [
      2500, 4000, 5000, 7500,
      10000, 12000, 15000, 17500,
      25000, 27500, 50000, 55000,
    ];
    $namas = [
      '10 m3/h',
      '> 10 - 100 m3/h',
      '> 100 m3/h',
    ];
    $this->data($namas, $tarifs, 11);
    // Meter Cairan Minum Selain Air Induk
    $tarifs = [
      0, 125000, 0, 125000,
      0, 175000, 0, 175000,
      0, 225000, 0, 225000,
    ];
    $namas = [
      '15 m3/h',
      '> 15 - 100 m3/h',
      '> 100 m3/h',
    ];
    $this->data($namas, $tarifs, 12);
    // Meter Cairan Minum Selain Air Kerja
    $tarifs = [
      0, 27500, 0, 27500,
      0, 37500, 0, 37500,
      0, 75000, 0, 75000,
    ];
    $namas = [
      '10 m3/h',
      '> 10 - 100 m3/h',
      '> 100 m3/h',
    ];
    $this->data($namas, $tarifs, 13);
    // Alat Kompensasi Suhu (ATC)
    $tarifs = [
      0, 100000, 0, 100000,
    ];
    $namas = [
      'Alat Kompensasi Suhu (ATC)',
    ];
    $this->data($namas, $tarifs, 14);
    // Meter Prover
    $tarifs = [
      0, 300000, 0, 300000,
      0, 500000, 0, 500000,
      0, 750000, 0, 750000,
    ];
    $namas = [
      '2.000 L',
      '> 2.000 - 10.000 L',
      '> 10.000 L',
    ];
    $this->data($namas, $tarifs, 15);
    // Meter Arus Massa
    $tarifs = [
      0, 150000, 0, 150000,
      0, 350000, 0, 350000,
      0, 950000, 0, 950000,
      0, 1500000, 0, 1500000,
      0, 2250000, 0, 2250000,
    ];
    $namas = [
      '10 kg/min',
      '> 10 - 100 kg/min',
      '> 100 - 500 kg/min',
      '> 500 - 1000 kg/min',
      '> 1000 kg/min',
    ];
    $this->data($namas, $tarifs, 16);
    // Alat Ukur Pengisi (Filling Machine)
    $tarifs = [
      0, 90000, 0, 90000,
    ];
    $namas = [
      'Untuk setiap jenis media',
    ];
    $this->data($namas, $tarifs, 17);
    // Meter Listrik (Meter kWh) Kelas 0,2 atau kurang
    $tarifs = [
      60000, 70000, 60000, 70000,
      20000, 30000, 20000, 30000,
    ];
    $namas = [
      '3 phasa',
      '1 phasa',
    ];
    $this->data($namas, $tarifs, 18);
    // Meter Listrik (Meter kWh) Kelas 0,5 atau kelas 1
    $tarifs = [
      7500, 8500, 7500, 8500,
      2500, 3500, 2500, 3500,
    ];
    $namas = [
      '3 phasa',
      '1 phasa',
    ];
    $this->data($namas, $tarifs, 19);
    // Meter Listrik (Meter kWh) Kelas 2
    $tarifs = [
      4500, 5500, 4500, 5500,
      1500, 2500, 1500, 2500,
    ];
    $namas = [
      '3 phasa',
      '1 phasa',
    ];
    $this->data($namas, $tarifs, 20);
    // Pembatas Arus Listrik
    $tarifs = [
      2000, 3000, 2000, 3000,
    ];
    $namas = [
      'Pembatas Arus Listrik',
    ];
    $this->data($namas, $tarifs, 21);
    // Anak Timbangan Ketelitian Biasa (kelas M2 dan M3)
    $tarifs = [
      300, 300, 500, 1500,
      500, 500, 1000, 2000,
      1500, 1500, 2500, 3500,
    ];
    $namas = [
      '1 kg',
      '> 1 - 5 kg',
      '> 5 - 50 kg',
    ];
    $this->data($namas, $tarifs, 22);
    // Anak Timbangan Ketelitian Khusus (kelas F2 dan M1)
    $tarifs = [
      1000, 1000, 2000, 3000,
      1500, 1500, 2500, 3500,
      7500, 7500, 10000, 11000,
    ];
    $namas = [
      '1 kg',
      '> 1 - 5 kg',
      '> 5 - 50 kg',
    ];
    $this->data($namas, $tarifs, 23);
    // Anak Timbangan Ketelitian Khusus (kelas E2 dan F1)
    $tarifs = [
      25000, 35000, 30000, 40000,
      30000, 45000, 35000, 45000,
      25000, 55000, 50000, 60000,
    ];
    $namas = [
      '1 kg',
      '> 1 - 5 kg',
      '> 5 - 50 kg',
    ];
    $this->data($namas, $tarifs, 24);
    // Timbangan
    $tarifs = [
      10000, 11000, 20000, 40000,
      8000, 8000, 22500, 42500,
      1500, 21500, 12500, 25000,
    ];
    $namas = [
      'Neraca',
      'Desimal / Milisimal',
      'Meja Beranger',
    ];
    $this->data($namas, $tarifs, 25);
    // Timbangan Dacin
    $tarifs = [
      1000, 21500, 12500, 25000,
      2500, 22500, 15000, 35000,
    ];
    $namas = [
      '25 kg',
      '> 25 kg',
    ];
    $this->data($namas, $tarifs, 26);
    // Timbangan Sentisimal
    $tarifs = [
      7500, 27500, 20000, 40000,
      8000, 28000, 22500, 42500,
      15000, 40000, 40000, 75000,
    ];
    $namas = [
      '150 kg',
      '> 150 - 500 kg',
      '> 500 kg',
    ];
    $this->data($namas, $tarifs, 27);
    // Timbangan Bobot Ingsut
    $tarifs = [
      6500, 26500, 17500, 37500,
      7500, 27500, 20000, 40000,
      11500, 31500, 25000, 60000,
    ];
    $namas = [
      '25 kg',
      '> 25 - 150 kg',
      '> 150 kg',
    ];
    $this->data($namas, $tarifs, 28);
    // Timbangan Pegas
    $tarifs = [
      6500, 26500, 12000, 32500,
      10000, 30000, 22500, 32500,
    ];
    $namas = [
      '25 kg',
      '> 25 kg',
    ];
    $this->data($namas, $tarifs, 29);
    // Timbangan Cepat
    $tarifs = [
      20000, 40000, 40000, 60000,
      25000, 45000, 50000, 70000,
    ];
    $namas = [
      '500 kg',
      '> 500 kg',
    ];
    $this->data($namas, $tarifs, 30);
    // Timbangan Elektronik (Kelas III dan IV)
    $tarifs = [
      27500, 47500, 27500, 47500,
      30000, 50000, 30000, 50000,
      35000, 55000, 35000, 55000,
      50000, 70000, 50000, 70000,
      130000, 150000, 130000, 150000,
    ];
    $namas = [
      '25 kg',
      '> 25 - 150 kg',
      '> 150 - 500 kg',
      '> 500 - 1000 kg',
      '> 1000 kg',
    ];
    $this->data($namas, $tarifs, 31);
    // Timbangan Elektronik (Kelas II)
    $tarifs = [
      50000, 60000, 50000, 60000,
      60000, 70000, 60000, 70000,
    ];
    $namas = [
      '1 kg',
      '> 1 kg',
    ];
    $this->data($namas, $tarifs, 32);
    // Timbangan Elektronik (Kelas I)
    $tarifs = [
      125000, 135000, 125000, 135000,
      150000, 160000, 150000, 160000,
    ];
    $namas = [
      '1 kg',
      '> 1 kg',
    ];
    $this->data($namas, $tarifs, 33);
    // Timbangan Jembatan
    $tarifs = [
      0, 1000000, 0, 1000000,
      0, 1500000, 0, 1500000,
    ];
    $namas = [
      '50 ton',
      '> 50 ton',
    ];
    $this->data($namas, $tarifs, 34);
    // Timbangan Ban Berjalan
    $tarifs = [
      0, 400000, 0, 400000,
      0, 550000, 0, 550000,
      0, 650000, 0, 650000,
    ];
    $namas = [
      '100 ton',
      '> 100 - 500 ton',
      '> 500 ton',
    ];
    $this->data($namas, $tarifs, 35);
    // Alat Ukur Tekanan Dead Weight Testing Machine
    $tarifs = [
      20000, 0, 20000, 0,
      25000, 0, 25000, 0,
      50000, 0, 50000, 0,
    ];
    $namas = [
      '100 kg/cm2',
      '> 100 - 1.000 kg/cm2',
      '> 1.000 kg/cm2',
    ];
    $this->data($namas, $tarifs, 36);
    // Alat Ukur Tekanan
    $tarifs = [
      25000, 35000, 25000, 35000,
      50000, 75000, 75000, 100000,
    ];
    $namas = [
      'Tekanan Darah',
      'Pressure Calibrater',
    ];
    $this->data($namas, $tarifs, 37);
    // Alat Ukur Tekanan Manometer
    $tarifs = [
      25000, 35000, 25000, 35000,
      30000, 40000, 30000, 40000,
      35000, 45000, 35000, 45000,
    ];
    $namas = [
      '100 kg/cm2',
      '> 100 - 1.000 kg/cm2',
      '> 1.000 kg/cm2',
    ];
    $this->data($namas, $tarifs, 38);
    // Alat Ukur Tekanan Pressure Recorder
    $tarifs = [
      20000, 30000, 30000, 40000,
      30000, 40000, 40000, 50000,
      40000, 50000, 70000, 80000,
    ];
    $namas = [
      '100 kg/cm2',
      '> 100 - 1.000 kg/cm2',
      '> 1.000 kg/cm2',
    ];
    $this->data($namas, $tarifs, 39);
    // Meter Kadar Air
    $tarifs = [
      25000, 35000, 35000, 45000,
      50000, 60000, 70000, 80000,
      40000, 50000, 60000, 70000,
    ];
    $namas = [
      'Untuk Biji-bijian tidak mengandung minyak, setiap komoditi',
      'Untuk kayu dan komoditi lain, setiap komoditi',
      'Untuk Biji-bijian tidak mengandung minyak kapas dan tekstil, setiap komoditi',
    ];
    $this->data($namas, $tarifs, 40);
  }
  protected function data($datas, $tarifs, $jenis_retribusi_tipe_id)
  {
    $jenisTeraModel = new JenisTeraModel();
    $jenisTera = $jenisTeraModel->findAll();
    $jenisTempatModel = new JenisTempatModel();
    $jenisTempat = $jenisTempatModel->findAll();
    $initDatas = [];
    foreach ($datas as $data) {
      $d = [
        'jenis_retribusi_nama' => $data,
        'jenis_retribusi_tipe_id' => $jenis_retribusi_tipe_id,
      ];
      $this->db->table('jenis_retribusi')->insert($d);
      $id = $this->db->insertID();
      foreach ($jenisTera as $jenis) {
        foreach ($jenisTempat as $tempat) {
          array_push($initDatas, [
            'jenis_retribusi_id' => $id,
            'jenis_tera_id' => $jenis['jenis_tera_id'],
            'jenis_tempat_id' => $tempat['jenis_tempat_id'],
          ]);
        }
      }
    }
    $i = 0;
    foreach ($tarifs as $tarif) {
      if ($tarif != 0) {
        $data = $initDatas[$i];
        $data['jenis_retribusi_tarif_bayar'] = $tarif;
        $this->db->table('jenis_retribusi_tarif')->insert($data);
      }
      $i++;
    }
    return $initDatas;
  }
}
