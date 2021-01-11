<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisUttpTipeModel extends Model
{
  protected $table      = 'jenis_uttp_tipe';
  protected $primaryKey = 'jenis_uttp_tipe_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_uttp_tipe_nama'];

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
    $jenisUttpModel = new JenisUttpModel();
    if ($jenisUttpModel->where($this->primaryKey, $id)->get()->getRow()) {
      return true;
    }
    return false;
  }
}
