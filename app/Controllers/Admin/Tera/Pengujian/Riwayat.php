<?php

namespace App\Controllers\Admin\Tera\Pengujian;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\JenisTeraModel;
use App\Models\TeraModel;

class Riwayat extends BaseController
{
  private $jenis_tempat_id = 1;
  public function index($status)
  {
    $this->getJenisTempat($this->jenis_tempat_id);
    $this->getPengujianStatus($status);
    $data['_view'] = 'admin/tera/pengujian/riwayat/index';
    $data = array_merge($data, $this->data);
    $data['_title'] = "Riwayat Pengujian Tera {$data['_jenis_tempat']['jenis_tempat_nama']} {$data['_pengujian_status']}";
    $data['_uri_datatable'] = base_url("admin/tera/pengujian/{$this->jenis_tempat_id}/riwayat/{$status}/datatable");
    $data['_uji'] = base_url("admin/tera/pengujian/{$this->jenis_tempat_id}/riwayat/{$status}/uji");
    $data['_scroll_datatable'] = "350px";
    $jenisTeraModel = new JenisTeraModel();
    $data['_jenis_teras'] = $jenisTeraModel->findAll();
    return view($data['_view'], $data);
  }
  public function datatable($status)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraModel = new TeraModel();
      $admin = $this->data['_admin'];
      $where = ['tera.jenis_tempat_id' => $this->jenis_tempat_id, 'tera.tera_ketetapan_at !=' => null, 'tera.tera_status_bayar !=' => 0, 'tera.tera_status_pengujian' => $status];
      $like = null;
      if (!empty($this->request->getPost('jenis_tera_id'))) {
        $where['tera.jenis_tera_id'] = htmlspecialchars($this->request->getPost('jenis_tera_id'));
      }
      if (!empty($this->request->getPost('user_nik'))) {
        $where['user.user_nik'] = htmlspecialchars($this->request->getPost('user_nik'));
      }
      if (!empty($this->request->getPost('date'))) {
        $date = explode('/', htmlspecialchars($this->request->getPost('date')));
        $where['tera.tera_created >='] = $date[0] . " 00:00:00";
        $where['tera.tera_created <='] = $date[1] . " 23:59:59";
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
