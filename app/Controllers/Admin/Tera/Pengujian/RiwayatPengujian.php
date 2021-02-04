<?php

namespace App\Controllers\Admin\Tera\Pengujian;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraUttpModel;
use App\Models\TeraUttpRetribusiModel;

class RiwayatPengujian extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id)
  {
    helper('my');
    $teraModel = new TeraModel();
    $data['_url_back'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}");
    $tera = $teraModel->getTera($tera_id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->to($data['_url_back']);
    }
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $teraUttpModel = new TeraUttpModel();
    $teraUttpRetribusi = $teraUttpRetribusiModel->getTeraUttp($tera_uttp_retribusi_id);
    $teraUttp = $teraUttpModel->getTeraUttpByRetribusi($tera_uttp_retribusi_id);
    $data['_validation'] = $this->form_validation;
    $data['_view'] = 'admin/tera/pengujian/riwayat_pengujian/index';
    $data['_tera_uttp_retribusi'] = $teraUttpRetribusi;
    $data['_tera_uttp'] = $teraUttp;
    $data = array_merge($data, $this->data);
    $admin = $this->data['_admin'];
    $data['_role_id'] = $admin->role_id;
    $date = date('d-m-Y', strtotime($tera['tera_date_order']));
    $data['_title'] = "Riwayat Pengujian Tera {$tera['tera_no_order']} {$date} {$teraUttpRetribusi['jenis_uttp_nama']}";
    $data['_tera'] = json_encode($tera);
    $data['_tera_uttp_pengujian_at'] = date('Y-m-d', strtotime($teraUttp['tera_uttp_pengujian_at']));
    $data['_tera_keringanan_at'] = $tera['tera_keringanan_at'];
    $data['_uri_datatable'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}/datatable");
    $data['_url_pengujian'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}");
    $data['_url_verif'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}/verif");
    $data['_url_batal'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}/batal");
    $data['_url_tolak'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}/tolak");
    $data['_url_verif_all'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}/verif_all");
    $data['_url_batal_all'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}/batal_all");
    $data['_url_tolak_all'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}/tolak_all");
    $data['_scroll_datatable'] = "350px";
    return view($data['_view'], $data);
  }
  public function datatable($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraUttpModel = new teraUttpModel();
      $where = ['tera_uttp_retribusi_id' => $tera_uttp_retribusi_id];
      $like = null;
      if ($this->request->getPost('tera_uttp_pengujian_status') != "") {
        $where['tera_uttp.tera_uttp_pengujian_status'] = htmlspecialchars($this->request->getPost('tera_uttp_pengujian_status'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraUttpModel, $params);
    } else {
      return base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}");
    }
  }
  public function verif_all($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id)
  {
    $admin = $this->data['_admin'];
    $teraUttpModel = new TeraUttpModel();
    $updateData = [
      'tera_uttp_pengujian_status' => 1,
      'tera_uttp_pengujian_status_by' => $admin->admin_id,
      'tera_uttp_pengujian_status_at' => date('Y-m-d H:i:s'),
    ];
    $update = $teraUttpModel->where('tera_uttp_retribusi_id', $tera_uttp_retribusi_id)->set($updateData)->update();
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil mensahkan pengujian");
    } else {
      $this->session->setFlashdata('error', "Gagal mensahkan pengujian");
    }
    return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}"));
  }
  public function verif($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id, $tera_uttp_id)
  {
    $admin = $this->data['_admin'];
    $teraUttpModel = new TeraUttpModel();
    $updateData = [
      'tera_uttp_pengujian_status' => 1,
      'tera_uttp_pengujian_status_by' => $admin->admin_id,
      'tera_uttp_pengujian_status_at' => date('Y-m-d H:i:s'),
    ];
    $update = $teraUttpModel->update($tera_uttp_id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil mensahkan pengujian");
    } else {
      $this->session->setFlashdata('error', "Gagal mensahkan pengujian");
    }
    return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}"));
  }
  public function batal($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id, $tera_uttp_id)
  {
    $teraUttpModel = new TeraUttpModel();
    $updateData = [
      'tera_uttp_pengujian_status' => 0,
      'tera_uttp_pengujian_status_by' => null,
      'tera_uttp_pengujian_status_at' => null,
    ];
    $update = $teraUttpModel->update($tera_uttp_id, $updateData);
    if ($update) {
      $this->session->setFlashdata('batal', "Berhasil membatalkan sah / batal pengujian");
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan sah / batal pengujian");
    }
    return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}"));
  }
  public function batal_all($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id)
  {
    $teraUttpModel = new TeraUttpModel();
    $updateData = [
      'tera_uttp_pengujian_status' => 0,
      'tera_uttp_pengujian_status_by' => null,
      'tera_uttp_pengujian_status_at' => null,
    ];
    $update = $teraUttpModel->where('tera_uttp_retribusi_id', $tera_uttp_retribusi_id)->set($updateData)->update();
    if ($update) {
      $this->session->setFlashdata('batal', "Berhasil membatalkan sah / batal pengujian");
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan sah / batal pengujian");
    }
    return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}"));
  }
  public function tolak($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id, $tera_uttp_id)
  {
    $admin = $this->data['_admin'];
    $teraUttpModel = new TeraUttpModel();
    $updateData = [
      'tera_uttp_pengujian_status' => 2,
      'tera_uttp_pengujian_status_by' => $admin->admin_id,
      'tera_uttp_pengujian_status_at' => date('Y-m-d H:i:s'),
    ];
    $update = $teraUttpModel->update($tera_uttp_id, $updateData);
    if ($update) {
      $this->session->setFlashdata('batal', "Berhasil membatalkan pengujian");
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan pengujian");
    }
    return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}"));
  }
  public function tolak_all($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id)
  {
    $admin = $this->data['_admin'];
    $teraUttpModel = new TeraUttpModel();
    $updateData = [
      'tera_uttp_pengujian_status' => 2,
      'tera_uttp_pengujian_status_by' => $admin->admin_id,
      'tera_uttp_pengujian_status_at' => date('Y-m-d H:i:s'),
    ];
    $update = $teraUttpModel->where('tera_uttp_retribusi_id', $tera_uttp_retribusi_id)->set($updateData)->update();
    if ($update) {
      $this->session->setFlashdata('batal', "Berhasil membatalkan pengujian");
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan pengujian");
    }
    return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}"));
  }
  public function print_keterangan_pengganti($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id, $tera_uttp_id)
  {
    helper('my');
    $data['_view'] = "admin/tera/pengujian/surat_keterangan_pengganti";
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($tera_id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $teraUttpModel = new TeraUttpModel();
    $teraUttp = $teraUttpModel->getTeraUttp($tera_uttp_id);
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $teraUttpRetribusi = $teraUttpRetribusiModel->getTeraUttp($tera_uttp_retribusi_id);
    $data['_title'] = "Print Surat Keterangan Pengganti Tanda Tera";
    $data['_admin'] = $this->data['_admin'];
    $data['tera'] = $tera;
    $data['tera_uttp'] = $teraUttp;
    $data['tera_uttp_retribusi'] = $teraUttpRetribusi;
    return view($data['_view'], $data);
  }
}
