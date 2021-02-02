<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraModel extends Model
{
  protected $table      = 'tera';
  protected $primaryKey = 'tera_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['user_id', 'tera_no_pendaftaran', 'tera_no_order', 'tera_atas_nama', 'jenis_tera_id', 'jenis_tempat_id', 'tera_atas_nama_alamat', 'tera_total_terbilang', 'tera_status', 'tera_status_by', 'tera_status_at', 'tera_keringanan_at', 'tera_keringanan_by', 'tera_status_bayar', 'tera_status_pengujian', 'tera_ketetapan_at', 'tera_ketetapan_by', 'tera_skrdkb_terbilang', 'tera_skrdkb_at', 'tera_skrdkb_by', 'tera_skrdlb_at', 'tera_skrdlb_by', 'tera_skrdlb_terbilang', 'tera_date_order', 'tera_created'];

  protected $useTimestamps = true;
  protected $createdField  = 'tera_created';
  protected $updatedField  = '';
  protected $beforeInsert = ['getNoUrut'];
  function getNoUrut(array $datas)
  {
    if (isset($datas['data']['tera_no_pendaftaran'])) return $datas;
    $builder = $this->db->table($this->table);
    $noUrut = "T" . date('Ymd', strtotime($datas['data']['tera_date_order']));
    $data = $builder->select('tera_no_pendaftaran')->like('tera_no_pendaftaran', $noUrut)->orderBy($this->primaryKey, 'DESC')->get()->getRowArray();
    if ($data) {
      $noUrut = $data['tera_no_pendaftaran'];
      $str = substr($noUrut, 0, 1);
      $date = substr($noUrut, 1, 8);
      $no = substr($noUrut, 9, 1);
      $no = (int) $no + 1;
      $datas['data']['tera_no_pendaftaran'] = $str . $date . $no;
      return $datas;
    } else {
      $datas['data']['tera_no_pendaftaran'] = $noUrut . "1";
      return $datas;
    }
  }
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("jenis_tera.*");
    $builder->select("jenis_tempat.*");
    $builder->select("admin.*");
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('jenis_tera', "jenis_tera.jenis_tera_id = {$this->table}.jenis_tera_id", 'LEFT');
    $builder->join('jenis_tempat', "jenis_tempat.jenis_tempat_id = {$this->table}.jenis_tempat_id", 'LEFT');
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_status_by", 'LEFT');
    if (isset($params['whereIn'])) {
      $builder->whereIn($params['whereIn']);
    }
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    $datas = $builder->get()->getResultArray();
    $no = 0;
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $teraPetugasModel = new TeraPetugasModel();
    foreach ($datas as $data) {
      $datas[$no]['tera_uttps'] = $teraUttpRetribusiModel->filter(0, 0, 'tera_uttp_retribusi_id', 'asc', ['where' => ["tera_uttp_retribusi.{$this->primaryKey}" => $data[$this->primaryKey]]]);
      $datas[$no]['tera_petugas'] = $teraPetugasModel->filter(0, 0, 'tera_petugas_id', 'asc', []);
      $no++;
    }
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function getTera($id, $detail = true)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("jenis_tera.*");
    $builder->select("jenis_tempat.*");
    $builder->select("tera_status_admin.admin_nama as tera_status_admin_nama");
    $builder->select("tera_ketetapan_admin.admin_nama as tera_ketetapan_admin_nama");
    $builder->select("tera_keringanan_admin.admin_nama as tera_keringanan_admin_nama");
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('jenis_tera', "jenis_tera.jenis_tera_id = {$this->table}.jenis_tera_id", 'LEFT');
    $builder->join('jenis_tempat', "jenis_tempat.jenis_tempat_id = {$this->table}.jenis_tempat_id", 'LEFT');
    $builder->join('admin as tera_status_admin', "tera_status_admin.admin_id = {$this->table}.tera_status_by", 'LEFT');
    $builder->join('admin as tera_ketetapan_admin', "tera_ketetapan_admin.admin_id = {$this->table}.tera_ketetapan_by", 'LEFT');
    $builder->join('admin as tera_keringanan_admin', "tera_keringanan_admin.admin_id = {$this->table}.tera_keringanan_by", 'LEFT');
    $builder->where(["{$this->table}.{$this->primaryKey}" => $id]);
    $datas = $builder->get()->getRowArray();
    if ($detail) {
      $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
      $datas['tera_uttps'] = $teraUttpRetribusiModel->filter(0, 0, 'tera_uttp_retribusi_id', 'asc', ['where' => ["tera_uttp_retribusi.{$this->primaryKey}" => $datas[$this->primaryKey]]]);
    }
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function count_all($params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("jenis_tera.*");
    $builder->select("jenis_tempat.*");
    $builder->select("admin.*");
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('jenis_tera', "jenis_tera.jenis_tera_id = {$this->table}.jenis_tera_id", 'LEFT');
    $builder->join('jenis_tempat', "jenis_tempat.jenis_tempat_id = {$this->table}.jenis_tempat_id", 'LEFT');
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_status_by", 'LEFT');
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
  public function total_bayar($id)
  {
    $tera = $this->find($id);
    $total_retribusi = 0;
    if ($tera['tera_ketetapan_at'] != null) {
      $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
      $total_retribusi = $teraUttpRetribusiModel->total_retribusi($id);
    }
    $teraSsrdModel = new TeraSsrdModel();
    $total_ssrd = $teraSsrdModel->total_ssrd($id);
    return [$total_retribusi, $total_ssrd, $total_retribusi - $total_ssrd];
  }
  public function getTeraWithPetugas($id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("jenis_tera.*");
    $builder->select("jenis_tempat.*");
    $builder->select("tera_status_admin.admin_nama as tera_status_admin_nama");
    $builder->select("tera_ketetapan_admin.admin_nama as tera_ketetapan_admin_nama");
    $builder->select("tera_keringanan_admin.admin_nama as tera_keringanan_admin_nama");
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('jenis_tera', "jenis_tera.jenis_tera_id = {$this->table}.jenis_tera_id", 'LEFT');
    $builder->join('jenis_tempat', "jenis_tempat.jenis_tempat_id = {$this->table}.jenis_tempat_id", 'LEFT');
    $builder->join('admin as tera_status_admin', "tera_status_admin.admin_id = {$this->table}.tera_status_by", 'LEFT');
    $builder->join('admin as tera_ketetapan_admin', "tera_ketetapan_admin.admin_id = {$this->table}.tera_ketetapan_by", 'LEFT');
    $builder->join('admin as tera_keringanan_admin', "tera_keringanan_admin.admin_id = {$this->table}.tera_keringanan_by", 'LEFT');
    $builder->where(["{$this->table}.{$this->primaryKey}" => $id]);
    $datas = $builder->get()->getRowArray();
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $teraPetugasModel = new TeraPetugasModel();
    $datas['tera_uttps'] = $teraUttpRetribusiModel->filter(0, 0, 'tera_uttp_retribusi_id', 'asc', ['where' => ["tera_uttp_retribusi.{$this->primaryKey}" => $datas[$this->primaryKey]]]);
    $datas['tera_petugas'] = $teraPetugasModel->filter(0, 0, 'tera_petugas_id', 'asc', ['where' => ["{$this->primaryKey}" => $datas[$this->primaryKey]]]);
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function filter_petugas($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("tera_petugas.*");
    $builder->select("jenis_tera.*");
    $builder->select("jenis_tempat.*");
    $builder->select("admin.*");
    $builder->join('tera_petugas', "tera_petugas.tera_id = {$this->table}.tera_id", 'LEFT');
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('jenis_tera', "jenis_tera.jenis_tera_id = {$this->table}.jenis_tera_id", 'LEFT');
    $builder->join('jenis_tempat', "jenis_tempat.jenis_tempat_id = {$this->table}.jenis_tempat_id", 'LEFT');
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_status_by", 'LEFT');
    if (isset($params['whereIn'])) {
      $builder->whereIn($params['whereIn']);
    }
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    $datas = $builder->get()->getResultArray();
    $no = 0;
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $teraPetugasModel = new TeraPetugasModel();
    foreach ($datas as $data) {
      $datas[$no]['tera_uttps'] = $teraUttpRetribusiModel->filter(0, 0, 'tera_uttp_retribusi_id', 'asc', ['where' => ["tera_uttp_retribusi.{$this->primaryKey}" => $data[$this->primaryKey]]]);
      $datas[$no]['tera_petugas'] = $teraPetugasModel->filter(0, 0, 'tera_petugas_id', 'asc', ['where' => ["{$this->primaryKey}" => $data[$this->primaryKey]]]);
      $no++;
    }
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function count_all_petugas($params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("user.*");
    $builder->select("tera_petugas.*");
    $builder->select("jenis_tera.*");
    $builder->select("jenis_tempat.*");
    $builder->select("admin.*");
    $builder->join('tera_petugas', "tera_petugas.tera_id = {$this->table}.tera_id", 'LEFT');
    $builder->join('user', "user.user_id = {$this->table}.user_id", 'LEFT');
    $builder->join('jenis_tera', "jenis_tera.jenis_tera_id = {$this->table}.jenis_tera_id", 'LEFT');
    $builder->join('jenis_tempat', "jenis_tempat.jenis_tempat_id = {$this->table}.jenis_tempat_id", 'LEFT');
    $builder->join('admin', "admin.admin_id = {$this->table}.tera_status_by", 'LEFT');
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
