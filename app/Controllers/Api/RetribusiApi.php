<?php

namespace App\Controllers\Api;

use App\Models\JenisRetribusiModel;
use App\Models\JenisUttpRetribusiModel;
use CodeIgniter\RESTful\ResourceController;

class RetribusiApi extends ResourceController
{

  protected $format       = 'json';
  protected $modelName    = 'App\Models\UserModel';

  public function retribusi($jenis_tempat_id, $jenis_tera_id, $jenis_uttp_id)
  {
    try {
      $jenisUttpRetribusiModel = new JenisUttpRetribusiModel();
      $jenisRetribusi = $jenisUttpRetribusiModel->where(['jenis_uttp_id' => $jenis_uttp_id])->first();
      $jenisRetribusis = [];
      if ($jenisRetribusi) {
        $jenisRetribusiModel = new JenisRetribusiModel();
        $tarif_where['jenis_retribusi_tarif.jenis_tempat_id'] = $jenis_tempat_id;
        $tarif_where['jenis_retribusi_tarif.jenis_tera_id'] = $jenis_tera_id;
        $where['jenis_retribusi.jenis_retribusi_tipe_id'] = $jenisRetribusi['jenis_retribusi_tipe_id'];
        $params = ['where' => $where, 'tarif_where' => $tarif_where];
        $jenisRetribusis = $jenisRetribusiModel->filter(0, 0, 'jenis_retribusi_id', 'asc', $params);
      }
      // $user = $this->model->findByNIK($nik);
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data retribusi", "data" => $jenisRetribusis], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
}
