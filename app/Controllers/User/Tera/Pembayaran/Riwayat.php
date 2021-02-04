<?php

namespace App\Controllers\User\Tera\Pembayaran;

use App\Controllers\User\BaseController;
use App\Models\JenisTeraModel;
use App\Models\TeraModel;

class Riwayat extends BaseController
{
  public function index()
  {
    $data['_view'] = 'user/tera/pembayaran/riwayat/index';
    $data = array_merge($data, $this->data);
    $data['_title'] = "Riwayat Pembayaran Tera";
    $data['_uri_datatable'] = base_url("user/tera/pembayaran/riwayat/datatable");
    $data['_scroll_datatable'] = "350px";
    $jenisTeraModel = new JenisTeraModel();
    $data['_jenis_teras'] = $jenisTeraModel->findAll();
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraModel = new TeraModel();
      $where = [];
      $like = null;
      if (!empty($this->request->getPost('jenis_tera_id'))) {
        $where['tera.jenis_tera_id'] = htmlspecialchars($this->request->getPost('jenis_tera_id'));
      }
      if (!empty($this->request->getPost('user_nik'))) {
        $where['user.user_nik'] = htmlspecialchars($this->request->getPost('user_nik'));
      }
      if (!empty($this->request->getPost('tera_no_order'))) {
        $like['tera.tera_no_order'] = htmlspecialchars($this->request->getPost('tera_no_order'));
      }
      if (!empty($this->request->getPost('tera_no_pendaftaran'))) {
        $like['tera.tera_no_pendaftaran'] = htmlspecialchars($this->request->getPost('tera_no_pendaftaran'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraModel, $params);
    } else {
      return redirect()->back();
    }
  }
}
