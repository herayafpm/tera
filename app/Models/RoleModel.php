<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
  protected $table      = 'role';
  protected $primaryKey = 'role_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['role_nama'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($this->primaryKey, 'asc'); // Untuk menambahkan query ORDER BY
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
}
