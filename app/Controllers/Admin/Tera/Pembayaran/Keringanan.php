<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraKeringananModel;
use App\Models\TeraModel;

class Keringanan extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $id)
  {
    helper('my');
    $teraModel = new TeraModel();
    $data['_url_back'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/riwayat/{$status}");
    $tera = $teraModel->getTera($id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->to($data['_url_back']);
    }
    $data['_validation'] = $this->form_validation;
    $data['_view'] = 'admin/tera/pembayaran/keringanan/index';
    $data = array_merge($data, $this->data);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $totalBayar = $teraModel->total_bayar($id);
    $data['_total_bayar'] = $totalBayar[0];
    $data['_total_kurang_bayar'] = $totalBayar[2];
    $data['_title'] = "Riwayat Pengajuan Keringanan Tera {$tera['tera_no_order']} <span class='toLocaleDateOnly'>{$date}</span>";
    $data['_tera'] = json_encode($tera);
    $data['_tera_keringanan_at'] = $tera['tera_keringanan_at'];
    $data['_uri_datatable'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/datatable/{$id}");
    $data['_url_skrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$id}");
    $data['_url_ssrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}");
    $data['_url_tambah'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$id}/tambah");
    $data['_url_verif'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$id}/verif");
    $data['_url_batal'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$id}/batal");
    $data['_url_tolak'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$id}/tolak");
    $data['_scroll_datatable'] = "350px";
    return view($data['_view'], $data);
  }
  public function datatable($jenis_tempat_id, $status, $id)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraKeringananModel = new TeraKeringananModel();
      $where = ['tera_id' => $id];
      $like = null;
      if ($this->request->getPost('tera_keringanan_status') != "") {
        $where['tera_keringanan_status'] = htmlspecialchars($this->request->getPost('tera_keringanan_status'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraKeringananModel, $params);
    } else {
      return base_url("admin/tera/pembayaran/{$jenis_tempat_id}/riwayat/{$status}");
    }
  }
  public function verif($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraKeringananModel = new TeraKeringananModel();
    $teraKeringanan = $teraKeringananModel->find($id);
    if (!$teraKeringanan) {
      $this->session->setFlashdata('error', 'Keringanan Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
    }
    $admin = $this->data['_admin'];
    $teraKeringanans = $teraKeringananModel->getWhereVerif($tera_id);
    if (sizeof($teraKeringanans) > 0) {
      $teraKeringananModel->setTolakAllExcept($tera_id, $teraKeringanans[0]['tera_keringanan_id'], $admin->admin_id);
      $this->session->setFlashdata('error', 'Keringanan Tera sudah pernah diverifikasi');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
    }
    $updateData = ['tera_keringanan_status' => 1, 'tera_keringanan_status_by' => $admin->admin_id, 'tera_keringanan_status_at' => date('Y-m-d H:i:s')];
    $update = $teraKeringananModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $teraModel->update($tera_id, ['tera_status_bayar' => 2, 'tera_keringanan_at' => date('Y-m-d H:i:s'), 'tera_keringanan_by' => $admin->admin_id]);
      $teraKeringananModel->setTolakAllExcept($tera_id, $id, $admin->admin_id);
      $this->session->setFlashdata('success', "Berhasil memverifikasi Keringanan Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/2/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal memverifikasi Keringanan Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
    }
  }
  public function batal($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraKeringananModel = new TeraKeringananModel();
    $teraKeringanan = $teraKeringananModel->find($id);
    if (!$teraKeringanan) {
      $this->session->setFlashdata('error', 'Keringanan Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
    }
    $updateData = ['tera_keringanan_status' => 0, 'tera_keringanan_status_by' => null, 'tera_keringanan_status_at' => null];
    $update = $teraKeringananModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $countTeraKeringanan = $teraKeringananModel->count_all(['where' => ['tera_id' => $tera_id, 'tera_keringanan_status' => 1]]);
      if ($countTeraKeringanan <= 0) {
        $teraModel->update($tera_id, ['tera_keringanan_at' => null, 'tera_keringanan_by' => null]);
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/0/{$tera_id}"));
      }
      $this->session->setFlashdata('success', "Berhasil membatalkan Keringanan Tera");
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan Keringanan Tera");
    }
    return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
  }
  public function tolak($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraKeringananModel = new TeraKeringananModel();
    $teraKeringanan = $teraKeringananModel->find($id);
    if (!$teraKeringanan) {
      $this->session->setFlashdata('error', 'Keringanan Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
    }
    $admin = $this->data['_admin'];
    $updateData = ['tera_keringanan_status' => 2, 'tera_keringanan_status_by' => $admin->admin_id, 'tera_keringanan_status_at' => date('Y-m-d H:i:s')];
    $update = $teraKeringananModel->update($id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil menolak Keringanan Tera");
      $teraModel = new TeraModel();
      $countTeraKeringanan = $teraKeringananModel->count_all(['where' => ['tera_id' => $tera_id, 'tera_keringanan_status' => 1]]);
      if ($countTeraKeringanan <= 0) {
        $teraModel->update($tera_id, ['tera_status_bayar' => 0, 'tera_keringanan_at' => null, 'tera_keringanan_by' => null]);
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/0/{$tera_id}"));
      }
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal menolak Keringanan Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera_id}"));
    }
  }
}
