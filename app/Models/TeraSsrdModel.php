<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraSsrdModel extends Model
{
  protected $table      = 'tera_ssrd';
  protected $primaryKey = 'tera_ssrd_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['tera_id', 'tera_ssrd_uang', 'tera_ssrd_terbilang', 'tera_ssrd_bank', 'tera_ssrd_no_rek', 'tera_ssrd_kd_rek', 'tera_ssrd_status', 'tera_ssrd_status_by', 'tera_ssrd_status_at'];

  protected $useTimestamps = true;
  protected $createdField  = 'tera_ssrd_date';
  protected $updatedField  = '';
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("admin.*");
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_ssrd_status_by", 'LEFT');
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
    $builder->select("admin.*");
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_ssrd_status_by", 'LEFT');
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
  public function total_ssrd($tera_id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.tera_ssrd_uang");
    $builder->where(['tera_id' => $tera_id, 'tera_ssrd_status' => 1]);
    $datas = $builder->get()->getResultArray();
    $totalSsrd = 0;
    foreach ($datas as $data) {
      $totalSsrd += (int) $data['tera_ssrd_uang'];
    }
    return $totalSsrd;
  }
}
