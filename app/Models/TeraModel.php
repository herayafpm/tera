<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraModel extends Model
{
  protected $table      = 'tera';
  protected $primaryKey = 'tera_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['user_id', 'tera_no_order', 'tera_atas_nama', 'tera_atas_nama_alamat', 'tera_status', 'tera_status_bayar', 'tera_date_order', 'tera_created'];

  protected $useTimestamps = true;
  protected $createdField  = 'tera_created';
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
