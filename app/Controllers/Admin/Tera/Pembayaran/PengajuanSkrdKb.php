<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraSkrdKbModel;

class PengajuanSkrdKb extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $id)
  {
    $data['_view'] = 'admin/tera/pembayaran/skrdkb/tambah';
    $teraSkrdKbModel = new TeraSkrdKbModel();
    $teraSkrdKbs = $teraSkrdKbModel->getWhereVerif($id);
    if (sizeof($teraSkrdKbs) > 0) {
      $this->session->setFlashdata('error', 'SKRDKB Tera sudah pernah diverifikasi');
      return redirect()->back();
    }
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $data['_title'] = "Pengajuan SKRDKB Tera {$tera['tera_no_order']} {$date}";
    $data['_url_back'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera['tera_id']}");
    $method = $this->request->getMethod();
    if ($method == 'post') {
      if (sizeof($teraSkrdKbs) > 0) {
        $this->session->setFlashdata('error', 'SKRDKB Tera sudah pernah diverifikasi');
        return redirect()->back();
      }
      return $this->process($jenis_tempat_id, $status, $tera);
    } else {
      return view($data['_view'], $data);
    }
  }
  protected function process($jenis_tempat_id, $status, $tera)
  {
    $admin = $this->data['_admin'];
    $data['tera_id'] = $tera['tera_id'];
    $data['tera_skrdkb_status'] = 1;
    $data['tera_skrdkb_status_by'] = $admin->admin_id;
    $data['tera_skrdkb_status_at'] = date('Y-m-d H:i:s');
    $data['tera_skrdkb_keterangan'] = htmlspecialchars($this->request->getPost('tera_skrdkb_keterangan') ?? "");
    $teraSkrdKbModel = new TeraSkrdKbModel();
    if ($teraSkrdKbModel->save($data)) {
      $teraSkrdKbModel->setTolakAllExcept($tera['tera_id'], $teraSkrdKbModel->InsertID(), $admin->admin_id);
      $teraModel = new TeraModel();
      $this->session->setFlashdata('success', 'Berhasil Mengajukan SKRDKB Tera');
      $teraModel->update($tera['tera_id'], ['tera_skrdkb_at' => date('Y-m-d H:i:s'), 'tera_skrdkb_by' => $admin->admin_id]);
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera['tera_id']}"));
    } else {
      $this->session->setFlashdata('error', 'Gagal Mengajukan SKRDKB Tera');
      return redirect()->back()->withInput();
    }
  }
}
