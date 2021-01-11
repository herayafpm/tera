<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AparaturSeeder extends Seeder
{
  public function run()
  {
    $date = date('Y-m-d H:i:s');
    $initDatas = [
      [
        "aparatur_nip" => "19681128 199603 1 006",
        "aparatur_nama" => "KEPALA DINPERINDAG KAB. BANYUMAS",
        "aparatur_pangkat" => "IVE",
        "jabatan_id" => 1,
        'aparatur_created' => $date,
        'aparatur_updated' => $date,
      ],
      [
        "aparatur_nip" => "19681120 199603 1 006",
        "aparatur_nama" => "Sekretaris Dinas",
        "aparatur_pangkat" => "IIIB",
        "jabatan_id" => 2,
        'aparatur_created' => $date,
        'aparatur_updated' => $date,
      ],
      [
        "aparatur_nip" => "19681121 199603 1 006",
        "aparatur_nama" => "Kepala Bidang Metrologi",
        "aparatur_pangkat" => "IVD",
        "jabatan_id" => 3,
        'aparatur_created' => $date,
        'aparatur_updated' => $date,
      ],
      [
        "aparatur_nip" => "19681122 199603 1 006",
        "aparatur_nama" => "Bendahara Penerimaan Pembantu",
        "aparatur_pangkat" => "IIIC",
        "jabatan_id" => 4,
        'aparatur_created' => $date,
        'aparatur_updated' => $date,
      ],
      [
        "aparatur_nip" => "19681123 199603 1 006",
        "aparatur_nama" => "Pegawai Yang Berhak",
        "aparatur_pangkat" => "IIA",
        "jabatan_id" => 5,
        'aparatur_created' => $date,
        'aparatur_updated' => $date,
      ],
      [
        "aparatur_nip" => "19681124 199603 1 006",
        "aparatur_nama" => "Petugas Pendaftaran",
        "aparatur_pangkat" => "IA",
        "jabatan_id" => 6,
        'aparatur_created' => $date,
        'aparatur_updated' => $date,
      ],
      [
        "aparatur_nip" => "19681125 199603 1 006",
        "aparatur_nama" => "Petugas Loket",
        "aparatur_pangkat" => "IB",
        "jabatan_id" => 7,
        'aparatur_created' => $date,
        'aparatur_updated' => $date,
      ],
    ];
    $this->db->table('aparatur')->insertBatch($initDatas);
  }
}
