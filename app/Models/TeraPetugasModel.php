<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraPetugasModel extends Model
{
  protected $table      = 'tera_petugas';
  protected $primaryKey = 'tera_petugas_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['tera_id', 'tera_petugas_admin'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("tera_petugas_admin_table.admin_nama as tera_petugas_admin_nama,tera_petugas_admin_table.admin_username as tera_petugas_admin_username");
    $builder->select("tera_petugas_aparatur.aparatur_pangkat,tera_petugas_aparatur.jabatan_id");
    $builder->select("jabatan.jabatan_nama");
    $builder->join('admin as tera_petugas_admin_table', "tera_petugas_admin_table.admin_id = {$this->table}.tera_petugas_admin", 'LEFT');
    $builder->join('aparatur as tera_petugas_aparatur', "tera_petugas_aparatur.aparatur_nip = tera_petugas_admin_table.admin_username", 'LEFT');
    $builder->join('jabatan', "jabatan.jabatan_id = tera_petugas_aparatur.jabatan_id", 'LEFT');
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
    $builder->select("tera_petugas_admin_table.admin_nama as tera_petugas_admin_nama,tera_petugas_admin_table.admin_username as tera_petugas_admin_username");
    $builder->select("tera_petugas_aparatur.aparatur_pangkat,tera_petugas_aparatur.jabatan_id");
    $builder->select("jabatan.jabatan_nama");
    $builder->join('admin as tera_petugas_admin_table', "tera_petugas_admin_table.admin_id = {$this->table}.tera_petugas_admin", 'LEFT');
    $builder->join('aparatur as tera_petugas_aparatur', "tera_petugas_aparatur.aparatur_nip = tera_petugas_admin_table.admin_username", 'LEFT');
    $builder->join('jabatan', "jabatan.jabatan_id = tera_petugas_aparatur.jabatan_id", 'LEFT');
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
