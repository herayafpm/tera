<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraSkrdLbModel extends Model
{
  protected $table      = 'tera_skrdlb';
  protected $primaryKey = 'tera_skrdlb_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['tera_id', 'tera_skrdlb_keterangan', 'tera_skrdlb_status', 'tera_skrdlb_status_by', 'tera_skrdlb_status_at'];

  protected $useTimestamps = true;
  protected $createdField  = 'tera_skrdlb_date';
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
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_skrdlb_status_by", 'LEFT');
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
  public function getWhereVerif($id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->where(['tera_id' => $id, 'tera_skrdlb_status' => 1]);
    $datas = $builder->get()->getResultArray();
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function setTolakAllExcept($tera_id, $id, $admin_id)
  {
    return $this->where(['tera_id' => $tera_id, "{$this->primaryKey} !=" => $id, 'tera_skrdlb_status' => 0])->set(['tera_skrdlb_status' => 2, 'tera_skrdlb_status_at' => date('Y-m-d H:i:s'), 'tera_skrdlb_status_by' => $admin_id])->update();
  }
  public function count_all($params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("admin.*");
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_skrdlb_status_by", 'LEFT');
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
