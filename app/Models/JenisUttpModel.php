<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisUttpModel extends Model
{
  protected $table      = 'jenis_uttp';
  protected $primaryKey = 'jenis_uttp_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_uttp_nama', 'jenis_uttp_tipe_id', 'jenis_uttp_tempat_pakai'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    if ($orderBy != null) {
      $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    }
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("jenis_uttp_tipe.*");
    $builder->join('jenis_uttp_tipe', "jenis_uttp_tipe.jenis_uttp_tipe_id = {$this->table}.jenis_uttp_tipe_id", 'LEFT');
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
    $builder->select("jenis_uttp_tipe.*");
    $builder->join('jenis_uttp_tipe', "jenis_uttp_tipe.jenis_uttp_tipe_id = {$this->table}.jenis_uttp_tipe_id", 'LEFT');
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
