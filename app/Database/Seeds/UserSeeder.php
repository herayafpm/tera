<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run()
  {
    $password = password_hash(env('passwordDefault'), PASSWORD_DEFAULT);
    $date = date('Y-m-d H:i:s');
    $initDatas = [
      [
        "user_nik" => "3304110701000001",
        "user_nama" => "Heraya Fitra",
        "user_alamat" => "Slatri RT 04 RW 01 Karangkobar Banjarnegara Jawa Tengah",
        "user_telepon" => "0895378036526",
        "verif_by" => 2,
        'user_password' => $password,
        'user_created' => $date,
        'user_updated' => $date,
      ],
      [
        "user_nik" => "3304110701000002",
        "user_nama" => "Ray Dragneel",
        "user_alamat" => "Slatri RT 04 RW 01 Karangkobar Banjarnegara Jawa Tengah",
        "user_telepon" => "0895378036526",
        "verif_by" => 2,
        'user_password' => $password,
        'user_created' => $date,
        'user_updated' => $date,
      ],
    ];
    $this->db->table('user')->insertBatch($initDatas);
  }
}
