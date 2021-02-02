<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\JenisTeraModel;
use App\Models\TeraModel;

class Riwayat extends BaseController
{
  public function index($jenis_tempat_id, $status)
  {
    $this->getJenisTempat($jenis_tempat_id);
    $this->getTeraPembayaranStatus($status);
    $data['_view'] = 'admin/tera/pembayaran/riwayat/index';
    $data = array_merge($data, $this->data);
    $data['_title'] = "Riwayat Pembayaran Tera {$data['_jenis_tempat']['jenis_tempat_nama']} {$data['_tera_pembayaran_status']}";
    $data['_uri_datatable'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/riwayat/{$status}/datatable");
    $data['_skrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}");
    $data['_skrdkb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}");
    $data['_skrdlb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}");
    $data['_ssrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}");
    $data['_keringanan'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}");
    $data['_scroll_datatable'] = "350px";
    $jenisTeraModel = new JenisTeraModel();
    $data['_jenis_teras'] = $jenisTeraModel->findAll();
    return view($data['_view'], $data);
  }
  public function datatable($jenis_tempat_id, $status)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraModel = new TeraModel();
      $where = ['tera.jenis_tempat_id' => $jenis_tempat_id, 'tera.tera_status_bayar' => $status];
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
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraModel, $params);
    } else {
      return redirect()->back();
    }
  }
}
