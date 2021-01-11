<?php

namespace App\Models;

use CodeIgniter\Model;

class AparaturModel extends Model
{
  protected $table      = 'aparatur';
  protected $primaryKey = 'aparatur_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['aparatur_nama', 'aparatur_nip', 'aparatur_pangkat', 'jabatan_id'];

  protected $useTimestamps = true;
  protected $createdField  = 'aparatur_created';
  protected $updatedField  = 'aparatur_updated';

  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("jabatan.*");
    $builder->join('jabatan', "jabatan.jabatan_id = {$this->table}.jabatan_id", 'LEFT');
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
    $builder->select("jabatan.*");
    $builder->join('jabatan', "jabatan.jabatan_id = {$this->table}.jabatan_id", 'LEFT');
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
  public function findByNIP($nip)
  {
    return $this->where('aparatur_nip', $nip)->first();
  }
  public function is_using($id, $nip)
  {
    $adminModel = new AdminModel();
    $admin = $adminModel->where('admin_username', $nip)->first();
    if ($admin) {
      return true;
    }
    return false;
  }
}
