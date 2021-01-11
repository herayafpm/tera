<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLogModel extends Model
{
  protected $table      = 'user_log';
  protected $primaryKey = 'user_log_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['user_nik'];
  protected $useTimestamps = true;
  protected $createdField  = 'user_log_at';
  protected $updatedField  = '';
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select('*');
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    $datas = $builder->get()->getResultArray();
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function count_all($params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    return $builder->countAllResults();
  }
}
