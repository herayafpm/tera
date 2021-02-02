<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraUttpModel extends Model
{
  protected $table      = 'tera_uttp';
  protected $primaryKey = 'tera_uttp_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['tera_uttp_retribusi_id', 'tera_uttp_merk', 'tera_uttp_tipe', 'tera_uttp_no_seri', 'tera_uttp_merk_kendaraan', 'tera_uttp_buatan', 'tera_uttp_volume', 'tera_uttp_no_polisi', 'tera_uttp_no_kd_plat', 'tera_uttp_pengujian_at', 'tera_uttp_pengujian_status', 'tera_uttp_pengujian_status_by', 'tera_uttp_pengujian_status_at', 'tera_uttp_keterangan'];

  protected $teraUttpDetail = ['tera_uttp_detail_t1_muka', 'tera_uttp_detail_t2_muka', 'tera_uttp_detail_t3_muka', 'tera_uttp_detail_t4_muka', 'tera_uttp_detail_t_muka', 'tera_uttp_detail_d_muka', 'tera_uttp_detail_p_muka', 'tera_uttp_detail_q_muka', 'tera_uttp_detail_s_muka', 'tera_uttp_detail_t1_belakang', 'tera_uttp_detail_t2_belakang', 'tera_uttp_detail_t3_belakang', 'tera_uttp_detail_t4_belakang', 'tera_uttp_detail_t_belakang', 'tera_uttp_detail_d_belakang', 'tera_uttp_detail_p_belakang', 'tera_uttp_detail_q_belakang', 'tera_uttp_detail_s_belakang'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $teraUttpDetail = [];
    foreach ($this->teraUttpDetail as $teraUttp) {
      array_push($teraUttpDetail, "tera_uttp_detail.{$teraUttp}");
    }
    $builder->select("{$this->table}.*");
    $builder->select("admin.*");
    $builder->select(implode(",", $teraUttpDetail));
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_uttp_pengujian_status_by", 'LEFT');
    $builder->join('tera_uttp_detail', "tera_uttp_detail.{$this->primaryKey} = {$this->table}.{$this->primaryKey}", 'LEFT');
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
  public function getTeraUttp($tera_uttp_id)
  {
    $builder = $this->db->table($this->table);
    $teraUttpDetail = [];
    foreach ($this->teraUttpDetail as $teraUttp) {
      array_push($teraUttpDetail, "tera_uttp_detail.{$teraUttp}");
    }
    $builder->select("{$this->table}.*");
    $builder->select("admin.*");
    $builder->select(implode(",", $teraUttpDetail));
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_uttp_pengujian_status_by", 'LEFT');
    $builder->join('tera_uttp_detail', "tera_uttp_detail.{$this->primaryKey} = {$this->table}.{$this->primaryKey}", 'LEFT');
    $builder->where(["{$this->table}.{$this->primaryKey}" => $tera_uttp_id]);
    $datas = $builder->get()->getRowArray();
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function getTeraUttpByRetribusi($tera_uttp_retribusi_id)
  {
    $builder = $this->db->table($this->table);
    $teraUttpDetail = [];
    foreach ($this->teraUttpDetail as $teraUttp) {
      array_push($teraUttpDetail, "tera_uttp_detail.{$teraUttp}");
    }
    $builder->select("{$this->table}.*");
    $builder->select("admin.*");
    $builder->select(implode(",", $teraUttpDetail));
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_uttp_pengujian_status_by", 'LEFT');
    $builder->join('tera_uttp_detail', "tera_uttp_detail.{$this->primaryKey} = {$this->table}.{$this->primaryKey}", 'LEFT');
    $builder->where(["{$this->table}.tera_uttp_retribusi_id" => $tera_uttp_retribusi_id]);
    $datas = $builder->get()->getRowArray();
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function count_all($params = [])
  {
    $builder = $this->db->table($this->table);
    $teraUttpDetail = [];
    foreach ($this->teraUttpDetail as $teraUttp) {
      array_push($teraUttpDetail, "tera_uttp_detail.{$teraUttp}");
    }
    $builder->select("{$this->table}.*");
    $builder->select("admin.*");
    $builder->select(implode(",", $teraUttpDetail));
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_uttp_pengujian_status_by", 'LEFT');
    $builder->join('tera_uttp_detail', "tera_uttp_detail.{$this->primaryKey} = {$this->table}.{$this->primaryKey}", 'LEFT');
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
  public function getCountTeraPengujian($tera_uttp_retribusi_id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.{$this->primaryKey}");
    $builder->where(['tera_uttp_retribusi_id' => $tera_uttp_retribusi_id]);
    return $builder->countAllResults();
  }
}
