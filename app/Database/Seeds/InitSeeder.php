<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
  public function run()
  {
    $this->call('RoleSeeder');
    $this->call('AdminSeeder');
    $this->call('JabatanSeeder');
    $this->call('JenisTeraSeeder');
    $this->call('AparaturSeeder');
    $this->call('UserSeeder');
    $this->call('JenisTempatSeeder');
    $this->call('JenisUttpTipeSeeder');
    $this->call('JenisUttpSeeder');
    $this->call('JenisRetribusiTipeSeeder');
    $this->call('JenisRetribusiSeeder');
    $this->call('JenisUttpRetribusiSeeder');
  }
}
