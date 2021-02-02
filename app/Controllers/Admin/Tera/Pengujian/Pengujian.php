<?php

namespace App\Controllers\Admin\Tera\Pengujian;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraUttpModel;
use App\Models\TeraUttpRetribusiModel;

class Pengujian extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $id)
  {
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    if (!$tera) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $this->getJenisTempat($jenis_tempat_id);
    $data['_view'] = 'admin/tera/pengujian/pengujian';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $admin = $this->data['_admin'];
    $data['_role_id'] = $admin->role_id;
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $data['_title'] = "Pengujian Tera {$data['_jenis_tempat']['jenis_tempat_nama']} {$tera['tera_no_order']} <span class='toLocaleDateOnly'>{$date}</span>";
    $data['_tera'] = $tera;
    $data['_jenis_uttp_ids'] = array_column($tera['tera_uttps'], 'jenis_uttp_id');
    $data['_jenis_uttp_namas'] = array_column($tera['tera_uttps'], 'jenis_uttp_nama');
    $data['_kapasitass'] = array_column($tera['tera_uttps'], 'tera_uttp_kapasitas');
    $data['_daya_bacas'] = array_column($tera['tera_uttps'], 'tera_uttp_daya_baca');
    $data['_jumlahs'] = array_column($tera['tera_uttps'], 'tera_uttp_jumlah');
    $data['_tera_uttp_ids'] = array_column($tera['tera_uttps'], 'tera_uttp_retribusi_id');
    $data['_jenis_retribusi_ids'] = array_column($tera['tera_uttps'], 'jenis_retribusi_id');
    $data['_jenis_retribusi_namas'] = array_column($tera['tera_uttps'], 'jenis_retribusi)nama');
    $data['_url_pengujian'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji");
    $data['_url_back'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}");
    $data['_url_print_berita_acara'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera['tera_id']}/print_berita_acara");
    return view($data['_view'], $data);
  }
  public function print_berita_acara($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id)
  {
    helper('my');
    $data['_view'] = "admin/tera/pengujian/surat_berita_acara";
    $teraModel = new TeraModel();
    $tera = $teraModel->getTeraWithPetugas($tera_id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $teraUttpModel = new TeraUttpModel();
    $teraUttps = $teraUttpModel->filter(0, 0, 'tera_uttp_id', 'asc', ['where' => ['tera_uttp_retribusi_id' => $tera_uttp_retribusi_id]]);
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $teraUttpRetribusi = $teraUttpRetribusiModel->getTeraUttp($tera_uttp_retribusi_id);
    $data['_title'] = "Print Berita Acara Pengujian UTTP";
    $data['_admin'] = $this->data['_admin'];
    $data['tera'] = $tera;
    $data['tera_uttp_retribusi'] = $teraUttpRetribusi;
    $data['tera_uttps'] = $teraUttps;
    return view($data['_view'], $data);
  }
}
