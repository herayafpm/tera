<?php

namespace App\Controllers\User\Tera\Pendaftaran;

use App\Controllers\User\BaseController;
use App\Models\JenisTeraModel;
use App\Models\TeraModel;
use CodeIgniter\HTTP\Request;

class Riwayat extends BaseController
{
  public function index()
  {
    $data['_view'] = 'user/tera/pendaftaran/riwayat/index';
    $data = array_merge($data, $this->data);
    $data['_title'] = "Riwayat Pendaftaran Tera";
    $data['_uri_datatable'] = base_url("user/tera/pendaftaran/riwayat/datatable");
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
      $user = $this->request->user;
      $where = ['tera.user_id' => $user->user_id];
      $like = null;
      if (!empty($this->request->getPost('jenis_tera_id'))) {
        $where['tera.jenis_tera_id'] = htmlspecialchars($this->request->getPost('jenis_tera_id'));
      }
      if (!empty($this->request->getPost('date'))) {
        $date = explode('/', htmlspecialchars($this->request->getPost('date')));
        $where['tera.tera_date_order >='] = $date[0];
        $where['tera.tera_date_order <='] = $date[1];
      }
      if (!empty($this->request->getPost('tera_no_order'))) {
        $like['tera.tera_no_order'] = htmlspecialchars($this->request->getPost('tera_no_order'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraModel, $params);
    } else {
      return redirect()->back();
    }
  }
}
