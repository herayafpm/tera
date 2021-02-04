<?php

namespace App\Controllers\Admin\Tera\Pengajuan;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraPengajuanModel;

class Riwayat extends BaseController
{
  public function index($status)
  {
    $this->getPengajuanStatus($status);
    $data['_view'] = 'admin/tera/pengajuan/riwayat/index';
    $data = array_merge($data, $this->data);
    $data['_title'] = "Riwayat Pengajuan Tera {$data['_pengajuan_status']}";
    $data['_uri_datatable'] = base_url("admin/tera/pengajuan/riwayat/{$status}/datatable");
    $data['_batal_tera'] = base_url("admin/tera/pengajuan/riwayat/{$status}/batal");
    $data['_proses_tera'] = base_url("admin/tera/pengajuan/riwayat/{$status}/proses");
    $data['_print_surat_tugas'] = base_url("admin/tera/pengajuan/riwayat/{$status}/print_surat_tugas");
    $data['_scroll_datatable'] = "350px";
    return view($data['_view'], $data);
  }
  public function datatable($status)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraPengajuanModel = new TeraPengajuanModel();
      $where = ['tera_pengajuan.tera_pengajuan_status' => $status];
      $like = null;
      if (!empty($this->request->getPost('user_nik'))) {
        $where['user.user_nik'] = htmlspecialchars($this->request->getPost('user_nik'));
      }
      if (!empty($this->request->getPost('date'))) {
        $date = explode('/', htmlspecialchars($this->request->getPost('date')));
        $where['tera_pengajuan.tera_pengajuan_date >='] = $date[0] . " 00:00:00";
        $where['tera_pengajuan.tera_pengajuan_date <='] = $date[1] . " 23:59:59";
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraPengajuanModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function batal($status, $id, $tipe)
  {
    $teraPengajuanModel = new TeraPengajuanModel();
    $teraPengajuan = $teraPengajuanModel->find($id);
    if (!$teraPengajuan) {
      $this->session->setFlashdata('error', 'Pengajuan Tera tidak ditemukkan');
      return redirect()->back();
    }
    $updateData = ['tera_pengajuan_status' => 0, 'tera_pengajuan_status_by' => null, 'tera_pengajuan_status_at' => null];
    $updateMessage = "";
    if ($tipe == 1) {
      $updateMessage = "verifikasi";
    } else if ($tipe == 2) {
      $updateMessage = "penolakan";
    }
    $update = $teraPengajuanModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $teraModel->update($teraPengajuan['tera_id'], ['tera_status' => 0, 'tera_status_by' => null, 'tera_status_at' => null]);
      $this->session->setFlashdata('success', "Berhasil membatalkan {$updateMessage} pengajuan tera");
      return redirect()->to(base_url("admin/tera/pengajuan/riwayat/0"));
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan {$updateMessage} pengajuan tera");
      return redirect()->back()->withInput();
    }
  }
  public function proses($status, $id, $tipe)
  {
    $teraPengajuanModel = new TeraPengajuanModel();
    $teraPengajuan = $teraPengajuanModel->find($id);
    if (!$teraPengajuan) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $admin = $this->data['_admin'];
    $updateData = ['tera_pengajuan_status' => $tipe, 'tera_pengajuan_status_by' => $admin->admin_id, 'tera_pengajuan_status_at' => date('Y-m-d H:i:s')];
    $updateMessage = "";
    if ($tipe == 1) {
      $updateMessage = "memverifikasi";
    } else if ($tipe == 2) {
      $updateMessage = "menolak";
    }
    $update = $teraPengajuanModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $teraModel->update($teraPengajuan['tera_id'], ['tera_status' => $tipe, 'tera_status_by' => $admin->admin_id, 'tera_status_at' => date('Y-m-d H:i:s')]);
      $this->session->setFlashdata('success', "Berhasil {$updateMessage} pengajuan tera");
      return redirect()->to(base_url("admin/tera/pengajuan/riwayat/{$tipe}"));
    } else {
      $this->session->setFlashdata('error', "Gagal {$updateMessage} pengajuan tera");
      return redirect()->back()->withInput();
    }
  }
  public function print_surat_tugas($status, $id)
  {
    helper('my');
    $data['_view'] = 'admin/tera/pengajuan/surat_tugas';
    $teraPengajuanModel = new TeraPengajuanModel();
    $teraPengajuan = $teraPengajuanModel->getTeraPengajuan($id);
    if (sizeof($teraPengajuan) <= 1) {
      $this->session->setFlashdata('error', 'Pengajuan Tera tidak ditemukkan');
      return redirect()->back();
    }
    if ($teraPengajuan['tera_pengajuan_status'] != 1) {
      $this->session->setFlashdata('error', 'Pengajuan Tera harus sudah diverifikasi');
      return redirect()->back();
    }
    $data['_title'] = "Print Surat Tugas";
    $data['tera_pengajuan'] = $teraPengajuan;
    $data['tera'] = $teraPengajuan['tera'];
    $data['petugass'] = $teraPengajuan['petugas'];
    return view($data['_view'], $data);
  }
}
