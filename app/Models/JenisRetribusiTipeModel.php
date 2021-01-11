<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisRetribusiTipeModel extends Model
{
  protected $table      = 'jenis_retribusi_tipe';
  protected $primaryKey = 'jenis_retribusi_tipe_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_retribusi_tipe_nama'];

  protected $useTimestamps = false;
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
  public function is_using($id)
  {
    $jenisRetribusiModel = new JenisRetribusiModel();
    if ($jenisRetribusiModel->where($this->primaryKey, $id)->get()->getRow()) {
      return true;
    }
    return false;
  }
}
