<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisRetribusiModel extends Model
{
  protected $table      = 'jenis_retribusi';
  protected $primaryKey = 'jenis_retribusi_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_retribusi_nama', 'jenis_retribusi_tipe_id', 'jenis_tera_id', 'jenis_tempat_id', 'jenis_retribusi_tarif'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("jenis_retribusi_tipe.*");
    $builder->join('jenis_retribusi_tipe', "jenis_retribusi_tipe.jenis_retribusi_tipe_id = {$this->table}.jenis_retribusi_tipe_id", 'LEFT');
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    $datas = $builder->get()->getResultArray();
    $jenisRetribusiTarifModel = new JenisRetribusiTarifModel();
    $initDatas = [];
    foreach ($datas as $data) {
      $where = [$this->primaryKey => $data[$this->primaryKey]];
      if (isset($params['tarif_where'])) {
        $where = array_merge($where, $params['tarif_where']);
      }
      $data['tarifs'] = $jenisRetribusiTarifModel->filter($where);
      array_push($initDatas, $data);
    }
    return $initDatas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function count_all($params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("jenis_retribusi_tipe.*");
    $builder->join('jenis_retribusi_tipe', "jenis_retribusi_tipe.jenis_retribusi_tipe_id = {$this->table}.jenis_retribusi_tipe_id", 'LEFT');
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
  public function getRetribusiDetail($jenis_retribusi_id)
  {
    $retribusi = $this->find($jenis_retribusi_id);
    $jenisRetribusiTarifModel = new JenisRetribusiTarifModel();
    $retribusi['tarifs'] = $jenisRetribusiTarifModel->filter(['jenis_retribusi_id' => $jenis_retribusi_id]);
    return $retribusi;
  }
}
