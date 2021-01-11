<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraUttpModel extends Model
{
  protected $table      = 'tera_uttp';
  protected $primaryKey = 'tera_uttp_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_uttp_id', 'tera_uttp_kapasitas', 'tera_uttp_daya_baca', 'tera_uttp_merk', 'tera_uttp_tipe', 'tera_uttp_buatan', 'tera_uttp_volume', 'tera_uttp_no_polisi', 'tera_uttp_no_kd_plat'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("jenis_uttp.*");
    $builder->join('jenis_uttp', "jenis_uttp.jenis_uttp_id = {$this->table}.jenis_uttp_id", 'LEFT');
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
    $builder->select("jenis_uttp.*");
    $builder->join('jenis_uttp', "jenis_uttp.jenis_uttp_id = {$this->table}.jenis_uttp_id", 'LEFT');
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
