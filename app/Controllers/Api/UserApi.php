<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class UserApi extends ResourceController
{

  protected $format       = 'json';
  protected $modelName    = 'App\Models\UserModel';

  public function show($nik = null)
  {
    try {
      $user = $this->model->findByNIK($nik);
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data user", "data" => $user], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
}
