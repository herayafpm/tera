<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraSkrdLbModel;
use App\Models\TeraModel;
use App\Models\TeraUttpRetribusiModel;

class SkrdLb extends BaseController
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
    $data['_view'] = 'admin/tera/pembayaran/skrdlb/index';
    $data = array_merge($data, $this->data);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $totalBayar = $teraModel->total_bayar($id);
    $data['_total_bayar'] = $totalBayar[0];
    $data['_total_kurang_bayar'] = $totalBayar[2];
    $data['_title'] = "Riwayat SKRDLB Tera {$tera['tera_no_order']} <span class='toLocaleDateOnly'>{$date}</span>";
    $data['_tera'] = json_encode($tera);
    $data['_tera_skrdlb_at'] = $tera['tera_skrdlb_at'];
    $data['_tera_skrdlb_terbilang'] = $tera['tera_skrdlb_terbilang'];
    $data['_uri_datatable'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/datatable/{$id}");
    $data['_url_skrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$id}");
    $data['_url_ssrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}");
    $data['_url_tambah'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$id}/tambah");
    $data['_url_verif'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$id}/verif");
    $data['_url_batal'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$id}/batal");
    $data['_url_tolak'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$id}/tolak");
    $data['_url_print'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$id}/print");
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
      'tera_skrdlb_terbilang' => [
        'label'  => 'SKRDLB Terbilang',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
    ];
    $data = [
      'tera_skrdlb_terbilang' => htmlspecialchars($this->request->getPost('tera_skrdlb_terbilang')),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    }
    $update = [
      'tera_skrdlb_terbilang' => $data['tera_skrdlb_terbilang']
    ];
    $teraModel = new TeraModel();
    if ($teraModel->update($tera['tera_id'], $update)) {
      $this->session->setFlashdata('success', 'Berhasil menyimpan');
    } else {
      $this->session->setFlashdata('error', 'Gagal menyimpan');
    }
    return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera['tera_id']}"));
  }
  public function print($jenis_tempat_id, $status, $tera_id)
  {
    helper('my');
    $data['_view'] = 'admin/tera/pembayaran/surat_skrdlb';
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($tera_id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $tera['count_retribusis'] = $teraUttpRetribusiModel->group_by_retribusi_count($tera_id);
    $totalBayar = $teraModel->total_bayar($tera_id);
    $data['_total_bayar'] = $totalBayar[0];
    $data['_total_telah_bayar'] = $totalBayar[1];
    $data['_total_kurang_bayar'] = $totalBayar[2];
    $data['_title'] = "Print Surat SKRDLB";
    $data['tera'] = $tera;
    $data['_admin'] = $this->data['_admin'];
    return view($data['_view'], $data);
  }
  public function datatable($jenis_tempat_id, $status, $id)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraSkrdLbModel = new TeraSkrdLbModel();
      $where = ['tera_id' => $id];
      $like = null;
      if ($this->request->getPost('tera_skrdlb_status') != "") {
        $where['tera_skrdlb_status'] = htmlspecialchars($this->request->getPost('tera_skrdlb_status'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraSkrdLbModel, $params);
    } else {
      return base_url("admin/tera/pembayaran/{$jenis_tempat_id}/riwayat/{$status}");
    }
  }
  public function verif($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSkrdLbModel = new TeraSkrdLbModel();
    $teraSkrdLb = $teraSkrdLbModel->find($id);
    if (!$teraSkrdLb) {
      $this->session->setFlashdata('error', 'SKRDLB Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    }
    $admin = $this->data['_admin'];
    $teraSkrdLbs = $teraSkrdLbModel->getWhereVerif($tera_id);
    if (sizeof($teraSkrdLbs) > 0) {
      $teraSkrdLbModel->setTolakAllExcept($tera_id, $teraSkrdLbs[0]['tera_skrdlb_id'], $admin->admin_id);
      $this->session->setFlashdata('error', 'SKRDLB Tera sudah pernah diverifikasi');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    }
    $updateData = ['tera_skrdlb_status' => 1, 'tera_skrdlb_status_by' => $admin->admin_id, 'tera_skrdlb_status_at' => date('Y-m-d H:i:s')];
    $update = $teraSkrdLbModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $teraModel->update($tera_id, ['tera_skrdlb_at' => date('Y-m-d H:i:s'), 'tera_skrdlb_by' => $admin->admin_id]);
      $teraSkrdLbModel->setTolakAllExcept($tera_id, $id, $admin->admin_id);
      $this->session->setFlashdata('success', "Berhasil memverifikasi SKRDLB Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal memverifikasi SKRDKB Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    }
  }
  public function batal($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSkrdLbModel = new TeraSkrdLbModel();
    $teraSkrdLb = $teraSkrdLbModel->find($id);
    if (!$teraSkrdLb) {
      $this->session->setFlashdata('error', 'SKRDLB Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    }
    $updateData = ['tera_skrdlb_status' => 0, 'tera_skrdlb_status_by' => null, 'tera_skrdlb_status_at' => null];
    $update = $teraSkrdLbModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $countTeraSkrdLb = $teraSkrdLbModel->count_all(['where' => ['tera_id' => $tera_id, 'tera_skrdlb_status' => 1]]);
      if ($countTeraSkrdLb <= 0) {
        $teraModel->update($tera_id, ['tera_skrdlb_at' => null, 'tera_skrdlb_by' => null]);
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
      }
      $this->session->setFlashdata('success', "Berhasil membatalkan SKRDLB Tera");
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan SKRDLB Tera");
    }
    return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
  }
  public function tolak($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSkrdLbModel = new TeraSkrdLbModel();
    $teraSkrdLb = $teraSkrdLbModel->find($id);
    if (!$teraSkrdLb) {
      $this->session->setFlashdata('error', 'SKRDLB Tera tidak ditemukkan');
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    }
    $admin = $this->data['_admin'];
    $updateData = ['tera_skrdlb_status' => 2, 'tera_skrdlb_status_by' => $admin->admin_id, 'tera_skrdlb_status_at' => date('Y-m-d H:i:s')];
    $update = $teraSkrdLbModel->update($id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil menolak SKRDLB Tera");
      $teraModel = new TeraModel();
      $countTeraSkrdLb = $teraSkrdLbModel->count_all(['where' => ['tera_id' => $tera_id, 'tera_skrdlb_status' => 1]]);
      if ($countTeraSkrdLb <= 0) {
        $teraModel->update($tera_id, ['tera_skrdlb_at' => null, 'tera_skrdlb_by' => null]);
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
      }
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal menolak SKRDLB Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera_id}"));
    }
  }
}
