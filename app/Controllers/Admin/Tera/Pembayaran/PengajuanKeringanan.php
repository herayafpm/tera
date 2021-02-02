<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraKeringananModel;

class PengajuanKeringanan extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $id)
  {
    $data['_view'] = 'admin/tera/pembayaran/keringanan/tambah';
    $teraKeringananModel = new TeraKeringananModel();
    $teraKeringanans = $teraKeringananModel->getWhereVerif($id);
    if (sizeof($teraKeringanans) > 0) {
      $this->session->setFlashdata('error', 'Keringanan Tera sudah pernah diverifikasi');
      return redirect()->back();
    }
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $data['_title'] = "Pengajuan Keringanan Tera {$tera['tera_no_order']} {$date}";
    $data['_url_back'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera['tera_id']}");
    $method = $this->request->getMethod();
    if ($method == 'post') {
      if (sizeof($teraKeringanans) > 0) {
        $this->session->setFlashdata('error', 'Keringanan Tera sudah pernah diverifikasi');
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
    $data['tera_keringanan_status'] = 1;
    $data['tera_keringanan_status_by'] = $admin->admin_id;
    $data['tera_keringanan_status_at'] = date('Y-m-d H:i:s');
    $data['tera_keringanan_keterangan'] = htmlspecialchars($this->request->getPost('tera_keringanan_keterangan') ?? "");
    $teraKeringananModel = new TeraKeringananModel();
    if ($teraKeringananModel->save($data)) {
      $teraKeringananModel->setTolakAllExcept($tera['tera_id'], $teraKeringananModel->InsertID(), $admin->admin_id);
      $teraModel = new TeraModel();
      $this->session->setFlashdata('success', 'Berhasil Mengajukan Keringanan Tera');
      $teraModel->update($tera['tera_id'], ['tera_status_bayar' => 2, 'tera_keringanan_at' => date('Y-m-d H:i:s'), 'tera_keringanan_by' => $admin->admin_id]);
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/2/{$tera['tera_id']}"));
    } else {
      $this->session->setFlashdata('error', 'Gagal Mengajukan Keringanan Tera');
      return redirect()->back()->withInput();
    }
  }
}
