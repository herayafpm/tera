<?php

namespace App\Controllers\Admin\Tera\Pendaftaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\JenisTeraModel;
use App\Models\TeraModel;

class Riwayat extends BaseController
{
  public function index($jenis_tempat_id, $status)
  {
    $this->getJenisTempat($jenis_tempat_id);
    $this->getTeraStatus($status);
    $data['_view'] = 'admin/tera/pendaftaran/riwayat/index';
    $data = array_merge($data, $this->data);
    $data['_title'] = "Riwayat Pendaftaran Tera {$data['_jenis_tempat']['jenis_tempat_nama']} {$data['_tera_status']}";
    $data['_uri_datatable'] = base_url("admin/tera/pendaftaran/{$jenis_tempat_id}/riwayat/{$status}/datatable");
    $data['_batal_tera'] = base_url("admin/tera/pendaftaran/{$jenis_tempat_id}/riwayat/{$status}/batal");
    $data['_proses_tera'] = base_url("admin/tera/pendaftaran/{$jenis_tempat_id}/riwayat/{$status}/proses");
    $data['_print_tera'] = base_url("admin/tera/pendaftaran/{$jenis_tempat_id}/riwayat/{$status}/print_form");
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
      $where = ['tera.jenis_tempat_id' => $jenis_tempat_id, 'tera.tera_status' => $status];
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
  public function batal($jenis_tempat_id, $status, $id, $tipe)
  {
    $teraModel = new TeraModel();
    $tera = $teraModel->find($id);
    if (!$tera) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    if ($tera['tera_status_bayar'] >= 1) {
      $this->session->setFlashdata('error', 'Tera tidak bisa dibatalkan');
      return redirect()->back();
    }
    $updateData = ['tera_no_order' => "", 'tera_status' => 0, 'tera_status_by' => null, 'tera_status_at' => null];
    $updateMessage = "";
    if ($tipe == 1) {
      $updateMessage = "verifikasi";
    } else if ($tipe == 2) {
      $updateMessage = "penolakan";
    }
    $update = $teraModel->update($id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil membatalkan {$updateMessage} tera");
      return redirect()->to(base_url("admin/tera/pendaftaran/{$jenis_tempat_id}/riwayat/0"));
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan {$updateMessage} tera");
      return redirect()->back()->withInput();
    }
  }
  public function proses($jenis_tempat_id, $status, $id, $tipe)
  {
    $teraModel = new TeraModel();
    $tera = $teraModel->find($id);
    if (!$tera) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $admin = $this->data['_admin'];
    $updateData = ['tera_status' => $tipe, 'tera_status_by' => $admin->admin_id, 'tera_status_at' => date('Y-m-d H:i:s')];
    $updateMessage = "";
    if ($tipe == 1) {
      $updateMessage = "memverifikasi";
      $updateData['tera_no_order'] = $this->request->getGet('tera_no_order');
    } else if ($tipe == 2) {
      $updateMessage = "menolak";
    }
    $update = $teraModel->update($id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil {$updateMessage} tera");
      return redirect()->to(base_url("admin/tera/pendaftaran/{$jenis_tempat_id}/riwayat/{$tipe}"));
    } else {
      $this->session->setFlashdata('error', "Gagal {$updateMessage} tera");
      return redirect()->back()->withInput();
    }
  }
  public function print_form($jenis_tempat_id, $status, $id)
  {
    helper('my');
    $data['_view'] = 'admin/tera/pendaftaran/formulir';
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    if ($tera['tera_status'] != 1) {
      $this->session->setFlashdata('error', 'Tera harus sudah diverifikasi');
      return redirect()->back();
    }
    $data['_title'] = "Print Formulir Pendaftaran";
    $data['tera'] = $tera;
    return view($data['_view'], $data);
  }
}
