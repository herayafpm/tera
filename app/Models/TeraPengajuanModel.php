<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraPengajuanModel extends Model
{
  protected $table      = 'tera_pengajuan';
  protected $primaryKey = 'tera_pengajuan_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['tera_id', 'user_id', 'tera_pengajuan_keterangan', 'tera_pengajuan_status', 'tera_pengajuan_status_by', 'tera_pengajuan_status_at', 'tera_pengajuan_date_order'];

  protected $useTimestamps = true;
  protected $createdField  = 'tera_pengajuan_date';
  protected $updatedField  = '';
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("tera_pengajuan_status_admin.admin_id as tera_pengajuan_status_admin_id,tera_pengajuan_status_admin.admin_nama as tera_pengajuan_status_admin_nama");
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('admin as tera_pengajuan_status_admin', "tera_pengajuan_status_admin.admin_id = {$this->table}.tera_pengajuan_status_by", 'LEFT');
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['orWhere'])) {
      $builder->orWhere($params['orWhere']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    $datas = $builder->get()->getResultArray();
    $no = 0;
    $teraModel = new TeraModel();
    $teraPetugasModel = new TeraPetugasModel();
    foreach ($datas as $data) {
      $datas[$no]['tera'] = $teraModel->getTera($data['tera_id']);
      $datas[$no]['petugas'] = $teraPetugasModel->filter(0, 0, 'tera_petugas_id', 'asc', []);
      $no++;
    }
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function getTeraPengajuan($id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("tera_pengajuan_status_admin.admin_id as tera_pengajuan_status_admin_id,tera_pengajuan_status_admin.admin_nama as tera_pengajuan_status_admin_nama");
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('admin as tera_pengajuan_status_admin', "tera_pengajuan_status_admin.admin_id = {$this->table}.tera_pengajuan_status_by", 'LEFT');
    $builder->where([$this->primaryKey => $id]);
    $datas = $builder->get()->getRowArray();
    $teraModel = new TeraModel();
    $datas['tera'] = $teraModel->getTera($datas['tera_id']);
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function count_all($params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("tera_pengajuan_status_admin.admin_id as tera_pengajuan_status_admin_id,tera_pengajuan_status_admin.admin_nama as tera_pengajuan_status_admin_nama");
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('admin as tera_pengajuan_status_admin', "tera_pengajuan_status_admin.admin_id = {$this->table}.tera_pengajuan_status_by", 'LEFT');
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
