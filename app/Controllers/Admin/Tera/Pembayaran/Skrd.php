<?php

namespace App\Controllers\Admin\Tera\Pembayaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraUttpRetribusiModel;

class Skrd extends BaseController
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
    $data['_view'] = 'admin/tera/pembayaran/skrd';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $data['_title'] = "SKRD Tera {$data['_jenis_tempat']['jenis_tempat_nama']}";
    $paramsJenisUttp = null;
    if ($jenis_tempat_id == 2) {
      $paramsJenisUttp['where'] = ['jenis_uttp_tempat_pakai' => 1];
    } else if ($jenis_tempat_id == 1) {
      $paramsJenisUttp['where'] = ['jenis_uttp_tempat_pakai' => 0];
    }
    $data['_tera'] = $tera;
    $data['_jenis_uttp_ids'] = array_column($tera['tera_uttps'], 'jenis_uttp_id');
    $data['_jenis_uttp_namas'] = array_column($tera['tera_uttps'], 'jenis_uttp_nama');
    $data['_kapasitass'] = array_column($tera['tera_uttps'], 'tera_uttp_kapasitas');
    $data['_daya_bacas'] = array_column($tera['tera_uttps'], 'tera_uttp_daya_baca');
    $data['_jumlahs'] = array_column($tera['tera_uttps'], 'tera_uttp_jumlah');
    $data['_tera_uttp_ids'] = array_column($tera['tera_uttps'], 'tera_uttp_retribusi_id');
    $data['_jenis_retribusi_ids'] = array_column($tera['tera_uttps'], 'jenis_retribusi_id');
    $data['_jenis_retribusi_namas'] = array_column($tera['tera_uttps'], 'jenis_retribusi)nama');
    $data['_retribusis'] = array_column($tera['tera_uttps'], 'tera_uttp_retribusi');
    $data['_keringanans'] = array_column($tera['tera_uttps'], 'tera_uttp_keringanan');
    $data['_sanksi_adms'] = array_column($tera['tera_uttps'], 'tera_uttp_sanksi_adm');
    $data['_url_api'] = base_url("api/retribusi/{$jenis_tempat_id}/{$tera['jenis_tera_id']}");
    $data['_url_print'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$tera['tera_id']}/print");
    $data['_url_batal_penetapan'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$tera['tera_id']}/batal_penetapan");
    $data['_url_skrdkb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$status}/{$tera['tera_id']}");
    $data['_url_skrdlb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$status}/{$tera['tera_id']}");
    $data['_url_ssrd'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/ssrd/{$status}/{$tera['tera_id']}");
    $data['_url_keringanan'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/keringanan/{$status}/{$tera['tera_id']}");
    // $data['_url_skrdkb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdkb/{$tera['jenis_tera_id']}/{$tera['tera_id']}");
    // $data['_url_skrdlb'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrdlb/{$tera['jenis_tera_id']}/{$tera['tera_id']}");
    $data['_url_back'] = base_url("admin/tera/pembayaran/{$jenis_tempat_id}/riwayat/{$status}");
    if ($tera['tera_ketetapan_at'] != null) {
      $data['tera_ketetapan_at'] = $tera['tera_ketetapan_at'];
      // $date1 = date_create(date('Y-m-d', strtotime($tera['tera_ketetapan_at'])));
      // $date2 = date_create(date('Y-m-d'));
      // $date2->modify('+1 day');
      // $date_diff = date_diff($date1, $date2);
      // $data['_ketetapan_diff'] = $date_diff->days;
    }
    $data['tera_keringanan_at'] = $tera['tera_keringanan_at'];
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
      'tera_total_terbilang' => [
        'label'  => 'Total Terbilang',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
    ];
    $data = [
      'tera_total_terbilang' => htmlspecialchars($this->request->getPost('tera_total_terbilang')),
      'tera_uttp_ids' => $this->request->getPost('tera_uttp_ids'),
      'jenis_retribusi_ids' => $this->request->getPost('jenis_retribusi_ids'),
      'retribusis' => $this->request->getPost('retribusis'),
      'keringanans' => $this->request->getPost('keringanans'),
      'sanksi_adms' => $this->request->getPost('sanksi_adms'),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    }
    $tera_uttp_ids = explode(',', $data['tera_uttp_ids'][0]);
    $jenis_retribusi_ids = explode(',', $data['jenis_retribusi_ids'][0]);
    $retribusis = explode(',', $data['retribusis'][0]);
    $keringanans = explode(',', $data['keringanans'][0]);
    $sanksi_adms =  explode(',', $data['sanksi_adms'][0]);
    $no = 0;
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    foreach ($jenis_retribusi_ids as $jenis_retribusi_id) {
      if ($jenis_retribusi_id != null) {
        $teraUttpUpdate = [
          'jenis_retribusi_id' => $jenis_retribusi_id,
          'tera_uttp_retribusi' => $retribusis[$no],
        ];
        if ($tera['tera_keringanan_at'] != null) {
          $teraUttpUpdate['tera_uttp_keringanan'] = $keringanans[$no];
        }
        if ($tera['tera_ketetapan_at'] != null) {
          $teraUttpUpdate['tera_uttp_sanksi_adm'] = $sanksi_adms[$no];
        }
        $teraUttpRetribusiModel->update($tera_uttp_ids[$no], $teraUttpUpdate);
      }
      $no++;
    }
    $update = [
      'tera_total_terbilang' => $data['tera_total_terbilang']
    ];
    $teraModel = new TeraModel();
    if ($this->request->getPost('tetapkan') !== null) {
      $admin = $this->data['_admin'];
      $update['tera_ketetapan_by'] = $admin->admin_id;
      $update['tera_ketetapan_at'] = date('Y-m-d H:i:s');
      $this->session->setFlashdata('success', 'Berhasil menyimpan dan menetapkan');
    } else {
      $this->session->setFlashdata('success', 'Berhasil menyimpan');
    }
    $teraModel->update($tera['tera_id'], $update);
    return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$tera['tera_id']}"));
  }
  public function batal_penetapan($jenis_tempat_id, $status, $id)
  {
    $teraModel = new TeraModel();
    $teraModel->update($id, [
      'tera_ketetapan_by' => null,
      'tera_ketetapan_at' => null,
    ]);
    $this->session->setFlashdata('success', 'Berhasil membatalkan penetapan');
    return redirect()->to(base_url("admin/tera/pembayaran/{$jenis_tempat_id}/skrd/{$status}/{$id}"));
  }
  public function print($jenis_tempat_id, $status, $id)
  {
    helper('my');
    $data['_view'] = 'admin/tera/pembayaran/surat_skrd';
    $teraModel = new TeraModel();
    $tera = $teraModel->getTera($id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->back();
    }
    $data['_title'] = "Print Surat SKRD";
    $data['_admin'] = $this->data['_admin'];
    $data['tera'] = $tera;
    return view($data['_view'], $data);
  }
}
