<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\Admin\BaseController;
use App\Models\JenisUttpRetribusiModel;
use App\Models\JenisRetribusiTipeModel;
use App\Models\JenisUttpModel;

class JenisUttpRetribusi extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/master/jenis_uttp_retribusi/index';
    $data['_title'] = 'Jenis Retribusi Tipe';
    $data['_uri_datatable'] = base_url('admin/master/jenis_uttp_retribusi/datatable');
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $jenisUttpRetribusiModel = new JenisUttpRetribusiModel();
      $where = null;
      $like = null;
      if (!empty($this->request->getPost('jenis_retribusi_tipe_nama'))) {
        $like['jenis_retribusi_tipe_nama'] = htmlspecialchars($this->request->getPost('jenis_retribusi_tipe_nama'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($jenisUttpRetribusiModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function ubah($id = null)
  {
    $data['_view'] = 'admin/master/jenis_uttp_retribusi/ubah';
    if ($id == null) {
      return redirect()->back();
    }
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $jenisRetribusiTipe = $jenisRetribusiTipeModel->find($id);
    if (!$jenisRetribusiTipe) {
      $this->session->setFlashdata('error', 'Jenis Retribusi Tipe tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_uttp_retribusi'));
    }
    $jenisUttpModel = new JenisUttpModel();
    $jenisUttps = $jenisUttpModel->filter(-1, null, null, null);
    $data['_jenis_uttps'] = $jenisUttps;
    $data['_title'] = "Ubah Daftar Retribusi Jenis UTTP";
    $data['_jenis_retribusi_tipe'] = $jenisRetribusiTipe;
    $data = array_merge($data, $this->data);
    $jenisUttpRetribusiModel = new JenisUttpRetribusiModel();
    $jenisUttpRetribusis = $jenisUttpRetribusiModel->getData($id);
    $jenisUttpRetribusis = array_column($jenisUttpRetribusis, 'jenis_uttp_id');
    $data['_jenis_uttp_retribusis'] = $jenisUttpRetribusis;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $data = [
        'jenis_uttp' => $this->request->getPost('jenis_uttp'),
      ];
      $update = $jenisUttpRetribusiModel->deleteAll($id);
      if ($data['jenis_uttp'] != null) {
        $jeniss = [];
        foreach ($data['jenis_uttp'] as $j) {
          array_push($jeniss, [
            'jenis_retribusi_tipe_id' => $id,
            'jenis_uttp_id' => $j,
          ]);
        }
        $update = $jenisUttpRetribusiModel->insertBatch($jeniss);
      }
      if ($update) {
        $this->session->setFlashdata('success', 'Retribusi Jenis UTTP berhasil diubah');
        return redirect()->to(base_url('admin/master/jenis_uttp_retribusi'));
      } else {
        $this->session->setFlashdata('error', 'Gagal mengubah Retribusi Jenis UTTP');
        return redirect()->back()->withInput();
      }
    } else {
      return view($data['_view'], $data);
    }
  }
}
