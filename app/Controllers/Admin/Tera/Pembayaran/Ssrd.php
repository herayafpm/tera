<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraSsrdModel;
use App\Models\TeraModel;

class Ssrd extends BaseController
{
  public function index($jenis_tempat_id, $status, $id)
  {
    helper('my');
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    $data['_view'] = 'admin/tera/pembayaran/ssrd/index';
    $data = array_merge($data, $this->data);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $totalBayar = $teraModel->total_bayar($id);
    $data['_total_bayar'] = $totalBayar[0];
    $data['_total_kurang_bayar'] = $totalBayar[2];
    $data['_title'] = "Riwayat SSRD Tera {$tera['tera_no_order']} {$date}";
    $data['_tera'] = json_encode($tera);
    $data['_uri_datatable'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/datatable/{$id}");
    $data['_url_skrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$tera['tera_id']}");
    $data['_url_skrdkb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera['tera_id']}");
    $data['_url_skrdlb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera['tera_id']}");
    $data['_url_back'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/riwayat/{$status}");
    $data['_url_tambah'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}/tambah");
    $data['_url_verif'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}/verif");
    $data['_url_batal'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}/batal");
    $data['_url_tolak'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}/tolak");
    $data['_print_ssrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$id}/print_ssrd");
    $data['_scroll_datatable'] = "350px";
    return view($data['_view'], $data);
  }
  public function datatable($jenis_tempat_id, $status, $id)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraSsrdModel = new TeraSsrdModel();
      $where = ['tera_id' => $id];
      $like = null;
      if ($this->request->getPost('tera_ssrd_status') != "") {
        $where['tera_ssrd_status'] = htmlspecialchars($this->request->getPost('tera_ssrd_status'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($teraSsrdModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function verif($jenis_tempat_id, $status, $tera_id, $id)
  {
    if ($status == 1) {
      $this->session->setFlashdata('error', 'SSRD Tera tidak bisa diverif');
      return redirect()->back();
    }
    $teraSsrdModel = new TeraSsrdModel();
    $teraSsrd = $teraSsrdModel->find($id);
    if (!$teraSsrd) {
      $this->session->setFlashdata('error', 'SSRD Tera tidak ditemukkan');
      return redirect()->back();
    }
    $admin = $this->data['_admin'];
    $updateData = ['tera_ssrd_status' => 1, 'tera_ssrd_status_by' => $admin->admin_id, 'tera_ssrd_status_at' => date('Y-m-d H:i:s')];
    helper('my');
    $teraModel = new TeraModel();
    $totalBayar = $teraModel->total_bayar($tera_id);
    $_total_kurang_bayar = $totalBayar[2];
    // if ($status == 0) {
    //   if ((int) $teraSsrd['tera_ssrd_uang'] != $_total_kurang_bayar) {
    //     $kurangan = format_rupiah($_total_kurang_bayar);
    //     $this->session->setFlashdata('error', "Nominal Uang harus sama dengan {$kurangan}");
    //     return redirect()->back();
    //   }
    // }
    // if ($status == 2) {
    //   if ((int) $teraSsrd['tera_ssrd_uang'] > $_total_kurang_bayar) {
    //     $kurangan = format_rupiah($_total_kurang_bayar);
    //     $this->session->setFlashdata('error', "Nominal Uang harus kurang dari atau sama dengan {$kurangan}");
    //     return redirect()->back();
    //   }
    // }
    $update = $teraSsrdModel->update($id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil memverifikasi SSRD Tera");
      if ((int) $teraSsrd['tera_ssrd_uang'] >= (int) $_total_kurang_bayar && (int) $_total_kurang_bayar != 0) {
        $teraModel->update($tera_id, ['tera_status_bayar' => 1]);
        $teraSsrdModel->where(['tera_id' => $tera_id, 'tera_ssrd_status' => 0])->set(['tera_ssrd_status' => 2, 'tera_ssrd_status_by' => $admin->admin_id, 'tera_ssrd_status_at' => date('Y-m-d H:i:s')])->update();
        return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/1/{$tera_id}"));
      }
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal memverifikasi SSRD Tera");
      return redirect()->back()->withInput();
    }
  }
  public function batal($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSsrdModel = new TeraSsrdModel();
    $teraSsrd = $teraSsrdModel->find($id);
    if (!$teraSsrd) {
      $this->session->setFlashdata('error', 'SSRD Tera tidak ditemukkan');
      return redirect()->back();
    }
    $updateData = ['tera_ssrd_status' => 0, 'tera_ssrd_status_by' => null, 'tera_ssrd_status_at' => null];
    $update = $teraSsrdModel->update($id, $updateData);
    if ($update) {
      $teraModel = new TeraModel();
      $totalBayar = $teraModel->total_bayar($tera_id);
      $_total_kurang_bayar = $totalBayar[2];
      $stat = ($status == 1) ? 0 : $status;
      if ((int) $_total_kurang_bayar != 0) {
        $teraModel->update($tera_id, ['tera_status_bayar' => $stat]);
      }
      $this->session->setFlashdata('success', "Berhasil membatalkan SSRD Tera");
      return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$stat}/{$tera_id}"));
    } else {
      $this->session->setFlashdata('error', "Gagal membatalkan SSRD Tera");
      return redirect()->back()->withInput();
    }
  }
  public function tolak($jenis_tempat_id, $status, $tera_id, $id)
  {
    $teraSsrdModel = new TeraSsrdModel();
    $teraSsrd = $teraSsrdModel->find($id);
    if (!$teraSsrd) {
      $this->session->setFlashdata('error', 'SSRD Tera tidak ditemukkan');
      return redirect()->back();
    }
    $admin = $this->data['_admin'];
    $updateData = ['tera_ssrd_status' => 2, 'tera_ssrd_status_by' => $admin->admin_id, 'tera_ssrd_status_at' => date('Y-m-d H:i:s')];
    $update = $teraSsrdModel->update($id, $updateData);
    if ($update) {
      $this->session->setFlashdata('success', "Berhasil menolak SSRD Tera");
      return redirect()->back();
    } else {
      $this->session->setFlashdata('error', "Gagal menolak SSRD Tera");
      return redirect()->back()->withInput();
    }
  }
  public function print_ssrd($jenis_tempat_id, $status, $tera_id, $id)
  {
    helper('my');
    $data['_view'] = 'admin/tera/pembayaran/surat_ssrd';
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($tera_id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $teraSsrdModel = new TeraSsrdModel();
    $teraSsrd = $teraSsrdModel->find($id);
    if (!$teraSsrd) {
      $this->session->setFlashdata('error', 'Tera SSRD tidak ditemukkan');
      return redirect()->back();
    }
    $data['_title'] = "Print Surat SSRD";
    $data['_admin'] = $this->data['_admin'];
    $data['tera'] = $tera;
    $data['tera_ssrd'] = $teraSsrd;
    return view($data['_view'], $data);
  }
}
