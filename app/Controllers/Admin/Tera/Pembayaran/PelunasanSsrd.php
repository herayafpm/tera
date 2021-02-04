<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraSsrdModel;

class PelunasanSsrd extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $id)
  {
    $data['_view'] = 'admin/tera/pembayaran/ssrd/tambah';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $data['_title'] = "Tambah SSRD Tera {$tera['tera_no_order']} {$date}";
    $data['_url_back'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$tera['tera_id']}");
    $method = $this->request->getMethod();
    if ($tera['tera_status_bayar'] == 1) {
      $this->session->setFlashdata('error', 'Tera sudah lunas');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$tera['tera_id']}"));
    }
    if ($method == 'post') {
      return $this->process($jenis_tempat_id, $status, $tera);
    } else {
      return view($data['_view'], $data);
    }
  }
  protected function process($jenis_tempat_id, $status, $tera)
  {
    $teraModel = new TeraModel();
    $totalBayar = $teraModel->total_bayar($tera['tera_id']);
    $_total_kurang_bayar = $totalBayar[2];
    helper('my');
    $rule = [
      'tera_ssrd_uang' => [
        'label'  => 'Uang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_ssrd_terbilang' => [
        'label'  => 'Uang Terbilang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_ssrd_bank' => [
        'label'  => 'Bank',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_ssrd_no_rek' => [
        'label'  => 'No Rekening',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_ssrd_kd_rek' => [
        'label'  => 'Kode Rekening',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
    ];
    $data = [
      'tera_ssrd_uang' => htmlspecialchars($this->request->getPost('tera_ssrd_uang')),
      'tera_ssrd_terbilang' => htmlspecialchars($this->request->getPost('tera_ssrd_terbilang')),
      'tera_ssrd_bank' => htmlspecialchars($this->request->getPost('tera_ssrd_bank')),
      'tera_ssrd_no_rek' => htmlspecialchars($this->request->getPost('tera_ssrd_no_rek')),
      'tera_ssrd_kd_rek' => htmlspecialchars($this->request->getPost('tera_ssrd_kd_rek')),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    } else {
      $data['tera_ssrd_uang'] = str_replace('_', "", $data['tera_ssrd_uang']);
      $admin = $this->data['_admin'];
      $data['tera_id'] = $tera['tera_id'];
      $data['tera_ssrd_status'] = 1;
      $data['tera_ssrd_status_by'] = $admin->admin_id;
      $data['tera_ssrd_status_at'] = date('Y-m-d H:i:s');
      $teraSsrdModel = new TeraSsrdModel();
      if ($teraSsrdModel->save($data)) {
        $this->session->setFlashdata('success', 'Berhasil Membayar SSRD Tera');
        if ((int) $data['tera_ssrd_uang'] >= (int) $_total_kurang_bayar && (int) $_total_kurang_bayar != 0) {
          $teraModel->update($tera['tera_id'], ['tera_status_bayar' => 1]);
          $teraSsrdModel->where(['tera_id' => $tera['tera_id'], 'tera_ssrd_status' => 0])->set(['tera_ssrd_status' => 2, 'tera_ssrd_status_by' => $admin->admin_id, 'tera_ssrd_status_at' => date('Y-m-d H:i:s')])->update();
          return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/1/{$tera['tera_id']}"));
        }
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$tera['tera_id']}"));
      } else {
        $this->session->setFlashdata('error', 'Gagal Membayar SSRD Tera');
        return redirect()->back()->withInput();
      }
    }
  }
}
