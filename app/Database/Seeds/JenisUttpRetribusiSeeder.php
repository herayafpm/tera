<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JenisUttpRetribusiSeeder extends Seeder
{
  public function run()
  {
    $this->db->query('INSERT INTO jenis_uttp_retribusi (jenis_uttp_retribusi_id, jenis_retribusi_tipe_id, jenis_uttp_id) VALUES
(4, 3, 13),
(5, 3, 14),
(8, 40, 11),
(9, 40, 37),
(10, 39, 4),
(11, 39, 9),
(12, 1, 1),
(13, 1, 2),
(14, 1, 3),
(15, 38, 38),
(16, 38, 41),
(17, 38, 42),
(18, 38, 43);');
  }
}
