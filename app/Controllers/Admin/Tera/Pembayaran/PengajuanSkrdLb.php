<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraSkrdLbModel;

class PengajuanSkrdLb extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $id)
  {
    $data['_view'] = 'admin/tera/pembayaran/skrdlb/tambah';
    $teraSkrdLbModel = new TeraSkrdLbModel();
    $teraSkrdLbs = $teraSkrdLbModel->getWhereVerif($id);
    if (sizeof($teraSkrdLbs) > 0) {
      $this->session->setFlashdata('error', 'SKRDLB Tera sudah pernah diverifikasi');
      return redirect()->back();
    }
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $data['_title'] = "Pengajuan SKRDLB Tera {$tera['tera_no_order']} {$date}";
    $data['_url_back'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera['tera_id']}");
    $method = $this->request->getMethod();
    if ($method == 'post') {
      if (sizeof($teraSkrdLbs) > 0) {
        $this->session->setFlashdata('error', 'SKRDLB Tera sudah pernah diverifikasi');
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
    $data['tera_skrdlb_status'] = 1;
    $data['tera_skrdlb_status_by'] = $admin->admin_id;
    $data['tera_skrdlb_status_at'] = date('Y-m-d H:i:s');
    $data['tera_skrdlb_keterangan'] = htmlspecialchars($this->request->getPost('tera_skrdlb_keterangan') ?? "");
    $teraSkrdLbModel = new TeraSkrdLbModel();
    if ($teraSkrdLbModel->save($data)) {
      $teraSkrdLbModel->setTolakAllExcept($tera['tera_id'], $teraSkrdLbModel->InsertID(), $admin->admin_id);
      $teraModel = new TeraModel();
      $this->session->setFlashdata('success', 'Berhasil Mengajukan SKRDLB Tera');
      $teraModel->update($tera['tera_id'], ['tera_skrdlb_at' => date('Y-m-d H:i:s'), 'tera_skrdlb_by' => $admin->admin_id]);
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera['tera_id']}"));
    } else {
      $this->session->setFlashdata('error', 'Gagal Mengajukan SKRDLB Tera');
      return redirect()->back()->withInput();
    }
  }
}
