<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisUttpRetribusiModel extends Model
{
  protected $table      = 'jenis_uttp_retribusi';
  protected $primaryKey = 'jenis_uttp_retribusi_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_retribusi_tipe_id', 'jenis_uttp_id'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $filters = $jenisRetribusiTipeModel->filter($limit, $start, $orderBy, $ordered, $params);
    $no = 0;
    foreach ($filters as $data) {
      $filters[$no]['jenis_uttp'] = $this->getData($data['jenis_retribusi_tipe_id']);
      $no++;
    }
    return $filters; // Eksekusi query sql sesuai kondisi diatas
  }
  public function getData($id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("jenis_uttp.*");
    $builder->join('jenis_uttp', "jenis_uttp.jenis_uttp_id = {$this->table}.jenis_uttp_id", 'LEFT');
    $builder->where(['jenis_retribusi_tipe_id' => $id]);
    return $builder->get()->getResultArray();
  }
  public function count_all($params = [])
  {
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $filters = $jenisRetribusiTipeModel->count_all($params);
    return $filters;
  }
  public function deleteAll($id = null)
  {
    return $this->where('jenis_retribusi_tipe_id', $id)->delete();
  }
}
