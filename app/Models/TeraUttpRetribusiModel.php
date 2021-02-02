<?php

namespace App\Models;

use CodeIgniter\Model;

class TeraUttpRetribusiModel extends Model
{
  protected $table      = 'tera_uttp_retribusi';
  protected $primaryKey = 'tera_uttp_retribusi_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_uttp_id', 'tera_id', 'tera_uttp_kapasitas', 'tera_uttp_daya_baca', 'tera_uttp_jumlah', 'jenis_retribusi_id', 'tera_uttp_retribusi', 'tera_uttp_keringanan', 'tera_uttp_sanksi_adm'];

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
    $builder->select("jenis_uttp_tipe.*");
    $builder->select("jenis_retribusi.*");
    $builder->select("jenis_retribusi_tipe.*");
    $builder->join('jenis_uttp', "jenis_uttp.jenis_uttp_id = {$this->table}.jenis_uttp_id", 'LEFT');
    $builder->join('jenis_uttp_tipe', "jenis_uttp_tipe.jenis_uttp_tipe_id = jenis_uttp.jenis_uttp_tipe_id", 'LEFT');
    $builder->join('jenis_retribusi', "jenis_retribusi.jenis_retribusi_id = {$this->table}.jenis_retribusi_id", 'LEFT');
    $builder->join('jenis_retribusi_tipe', "jenis_retribusi_tipe.jenis_retribusi_tipe_id = jenis_retribusi.jenis_retribusi_tipe_id", 'LEFT');
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
  public function getTeraUttp($tera_uttp_retribusi_id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("jenis_uttp.*");
    $builder->select("jenis_uttp_tipe.*");
    $builder->select("jenis_retribusi.*");
    $builder->select("jenis_retribusi_tipe.*");
    $builder->join('jenis_uttp', "jenis_uttp.jenis_uttp_id = {$this->table}.jenis_uttp_id", 'LEFT');
    $builder->join('jenis_uttp_tipe', "jenis_uttp_tipe.jenis_uttp_tipe_id = jenis_uttp.jenis_uttp_tipe_id", 'LEFT');
    $builder->join('jenis_retribusi', "jenis_retribusi.jenis_retribusi_id = {$this->table}.jenis_retribusi_id", 'LEFT');
    $builder->join('jenis_retribusi_tipe', "jenis_retribusi_tipe.jenis_retribusi_tipe_id = jenis_retribusi.jenis_retribusi_tipe_id", 'LEFT');
    $builder->where(["{$this->table}.{$this->primaryKey}" => $tera_uttp_retribusi_id]);
    $datas = $builder->get()->getRowArray();
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function total_retribusi($tera_id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("tera_uttp_retribusi,tera_uttp_keringanan,tera_uttp_jumlah,tera_uttp_sanksi_adm");
    $builder->where(['tera_id' => $tera_id]);
    $datas = $builder->get()->getResultArray();
    $totalRetribusi = 0;
    foreach ($datas as $data) {
      $totalRetribusi += (int) $data['tera_uttp_jumlah'] * ((int) $data['tera_uttp_retribusi'] - $data['tera_uttp_keringanan']) + (int) $data['tera_uttp_sanksi_adm'];
    }
    return $totalRetribusi;
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
  public function group_by_retribusi_count($tera_id)
  {
    $f = [];
    foreach ($this->allowedFields as $field) {
      array_push($f, "{$this->table}.$field");
    }
    $fields = implode(",", $f);
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.jenis_retribusi_id, COUNT(*) as count_retribusi");
    $builder->select("jenis_retribusi.*");
    $builder->select("jenis_retribusi_tipe.*");
    $builder->join('jenis_retribusi', "jenis_retribusi.jenis_retribusi_id = {$this->table}.jenis_retribusi_id", 'LEFT');
    $builder->join('jenis_retribusi_tipe', "jenis_retribusi_tipe.jenis_retribusi_tipe_id = jenis_retribusi.jenis_retribusi_tipe_id", 'LEFT');
    $builder->where(["{$this->table}.tera_id" => $tera_id]);
    $builder->groupBy(["{$this->table}.jenis_retribusi_id"]);
    $datas = $builder->get()->getResultArray();
    return $datas;
  }
}
