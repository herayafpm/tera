<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisRetribusiTarifModel extends Model
{
  protected $table      = 'jenis_retribusi_tarif';
  protected $primaryKey = 'jenis_retribusi_tarif_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['jenis_retribusi_id', 'jenis_tera_id', 'jenis_tempat_id', 'jenis_retribusi_tarif_bayar'];

  protected $useTimestamps = false;
  public function filter($params)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("jenis_tera.*");
    $builder->select("jenis_tempat.*");
    $builder->join('jenis_tera', "jenis_tera.jenis_tera_id = {$this->table}.jenis_tera_id", 'LEFT');
    $builder->join('jenis_tempat', "jenis_tempat.jenis_tempat_id = {$this->table}.jenis_tempat_id", 'LEFT');
    if (isset($params)) {
      $builder->where($params);
    }
    $datas = $builder->get()->getResultArray();
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
}
