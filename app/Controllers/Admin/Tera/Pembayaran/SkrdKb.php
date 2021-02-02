<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraSkrdKbModel;
use App\Models\TeraModel;
use App\Models\TeraUttpRetribusiModel;

class SkrdKb extends BaseController
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
    $data['_view'] = 'admin/tera/pembayaran/skrdkb/index';
    $data = array_merge($data, $this->data);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $totalBayar = $teraModel->total_bayar($id);
    $data['_total_bayar'] = $totalBayar[0];
    $data['_total_kurang_bayar'] = $totalBayar[2];
    $data['_title'] = "Riwayat SKRDKB Tera {$tera['tera_no_order']} <span class='toLocaleDateOnly'>{$date}</span>";
    $data['_tera'] = json_encode($tera);
    $data['_tera_skrdkb_at'] = $tera['tera_skrdkb_at'];
    $data['_tera_skrdkb_terbilang'] = $tera['tera_skrdkb_terbilang'];
    $data['_uri_datatable'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/datatable/{$id}");
    $data['_url_skrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$id}");
    $data['_url_ssrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}");
    $data['_url_tambah'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$id}/tambah");
    $data['_url_verif'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$id}/verif");
    $data['_url_batal'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$id}/batal");
    $data['_url_tolak'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$id}/tolak");
    $data['_url_print'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$id}/print");
    $data['_scroll_datatable'] = "350px";
    $method = $this->request->getMethod();
    if ($method == 'post') {
      return $this->process($jenis_tempat_id, $status, $tera);
    } else {
      return view($data['_view'], $data);
    }
  }
  protected function process($jenis_tempat_id, $status, $tera)
  {
    $rule = [
      'tera_skrdkb_terbilang' => [
        'label'  => 'SKRDKB Terbilang',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
    ];
    $data = [
      'tera_skrdkb_terbilang' => htmlspecialchars($this->request->getPost('tera_skrdkb_terbilang')),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    }
    $update = [
      'tera_skrdkb_terbilang' => $data['tera_skrdkb_terbilang']
    ];
    $teraModel = new TeraModel();
    if ($teraModel->update($tera['tera_id'], $update)) {
      $this->session->setFlashdata('success', 'Berhasil menyimpan');
    } else {
      $this->session->setFlashdata('error', 'Gagal menyimpan');
    }
    return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera['tera_id']}"));
  }
  public function print($jenis_tempat_id, $status, $tera_id)
  {
    helper('my');
    $data['_view'] = 'admin/tera/pembayaran/surat_skrdkb';
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($tera_id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $tera['count_retribusis'] = $teraUttpRetribusiModel->group_by_retribusi_count($tera_id);
    $totalBayar = $teraModel->total_bayar($tera_id);
    $data['_total_bayar'] = format_rupiah($totalBayar[0]);
    $data['_total_telah_bayar'] = format_rupiah($totalBayar[1]);
    $data['_total_kurang_bayar'] = format_rupiah($totalBayar[2]);
    $data['_title'] = "Print Surat SKRDKB";
    $data['tera'] = $tera;
    $data['_admin'] = $this->data['_admin'];
    return view($data['_view'], $data);
  }
  public function datatable($jenis_tempat_id, $status, $id)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraSkrdKbModel = new TeraSkrdKbModel();
      $where = ['tera_id' => $id];
      $like = null;
      if ($this->request->getPost('tera_skrdkb_status') != "") {
        $where['tera_skrdkb_status'] = htmlspecialchars($this->request->getPost('tera_skrdkb_status'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraSkrdKbModel, $params);
    } else {
      return base_url("admin/tera/pembayaran/{$jenis_tempat_id}/riwayat/{$status}");
    }
  }
  public function verif($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSkrdKbModel = new TeraSkrdKbModel();
    $teraSkrdKb = $teraSkrdKbModel->find($id);
    if (!$teraSkrdKb) {
      $this->session->setFlashdata('error', 'SKRDKB Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    }
    $admin = $this->data['_admin'];
    $teraSkrdKbs = $teraSkrdKbModel->getWhereVerif($tera_id);
    if (sizeof($teraSkrdKbs) > 0) {
      $teraSkrdKbModel->setTolakAllExcept($tera_id, $teraSkrdKbs[0]['tera_skrdkb_id'], $admin->admin_id);
      $this->session->setFlashdata('error', 'SKRDKB Tera sudah pernah diverifikasi');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    }
    $updateData = ['tera_skrdkb_status' => 1, 'tera_skrdkb_status_by' => $admin->admin_id, 'tera_skrdkb_status_at' => date('Y-m-d H:i:s')];
    $update = $teraSkrdKbModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $teraModel->update($tera_id, ['tera_skrdkb_at' => date('Y-m-d H:i:s'), 'tera_skrdkb_by' => $admin->admin_id]);
      $teraSkrdKbModel->setTolakAllExcept($tera_id, $id, $admin->admin_id);
      $this->session->setFlashdata('success', "Berhasil memverifikasi SKRDKB Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal memverifikasi SKRDKB Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    }
  }
  public function batal($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSkrdKbModel = new TeraSkrdKbModel();
    $teraSkrdKb = $teraSkrdKbModel->find($id);
    if (!$teraSkrdKb) {
      $this->session->setFlashdata('error', 'SKRDKB Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    }
    $updateData = ['tera_skrdkb_status' => 0, 'tera_skrdkb_status_by' => null, 'tera_skrdkb_status_at' => null];
    $update = $teraSkrdKbModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $countTeraSkrdKb = $teraSkrdKbModel->count_all(['where' => ['tera_id' => $tera_id, 'tera_skrdkb_status' => 1]]);
      if ($countTeraSkrdKb <= 0) {
        $teraModel->update($tera_id, ['tera_skrdkb_at' => null, 'tera_skrdkb_by' => null]);
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
      }
      $this->session->setFlashdata('success', "Berhasil membatalkan SKRDKB Tera");
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan SKRDKB Tera");
    }
    return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
  }
  public function tolak($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSkrdKbModel = new TeraSkrdKbModel();
    $teraSkrdKb = $teraSkrdKbModel->find($id);
    if (!$teraSkrdKb) {
      $this->session->setFlashdata('error', 'SKRDKB Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    }
    $admin = $this->data['_admin'];
    $updateData = ['tera_skrdkb_status' => 2, 'tera_skrdkb_status_by' => $admin->admin_id, 'tera_skrdkb_status_at' => date('Y-m-d H:i:s')];
    $update = $teraSkrdKbModel->update($id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil menolak SKRDKB Tera");
      $teraModel = new TeraModel();
      $countTeraSkrdKb = $teraSkrdKbModel->count_all(['where' => ['tera_id' => $tera_id, 'tera_skrdkb_status' => 1]]);
      if ($countTeraSkrdKb <= 0) {
        $teraModel->update($tera_id, ['tera_skrdkb_at' => null, 'tera_skrdkb_by' => null]);
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
      }
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal menolak SKRDKB Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera_id}"));
    }
  }
}
