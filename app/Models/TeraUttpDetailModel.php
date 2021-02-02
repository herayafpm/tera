<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraUttpDetailModel extends Model
{
  protected $table      = 'tera_uttp_detail';
  protected $primaryKey = 'tera_uttp_detail_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['tera_uttp_detail_id', 'tera_uttp_id', 'tera_uttp_detail_t1_muka', 'tera_uttp_detail_t2_muka', 'tera_uttp_detail_t3_muka', 'tera_uttp_detail_t4_muka', 'tera_uttp_detail_t_muka', 'tera_uttp_detail_d_muka', 'tera_uttp_detail_p_muka', 'tera_uttp_detail_q_muka', 'tera_uttp_detail_s_muka', 'tera_uttp_detail_t1_belakang', 'tera_uttp_detail_t2_belakang', 'tera_uttp_detail_t3_belakang', 'tera_uttp_detail_t4_belakang', 'tera_uttp_detail_t_belakang', 'tera_uttp_detail_d_belakang', 'tera_uttp_detail_p_belakang', 'tera_uttp_detail_q_belakang', 'tera_uttp_detail_s_belakang'];

  protected $useTimestamps = false;
}
