<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\Admin\BaseController;
use App\Models\JenisRetribusiTipeModel;

class JenisRetribusiTipe extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/master/jenis_retribusi_tipe/index';
    $data['_title'] = 'Jenis Retribusi Tipe';
    $data['_uri_datatable'] = base_url('admin/master/jenis_retribusi_tipe/datatable');
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
      $where = null;
      $like = null;
      if (!empty($this->request->getPost('jenis_retribusi_tipe_nama'))) {
        $like['jenis_retribusi_tipe_nama'] = htmlspecialchars($this->request->getPost('jenis_retribusi_tipe_nama'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($jenisRetribusiTipeModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function tambah()
  {
    $data['_view'] = 'admin/master/jenis_retribusi_tipe/tambah';
    $data['_title'] = 'Tambah Jenis Retribusi Tipe';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_retribusi_tipe_nama' => [
          'label'  => 'Nama Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_retribusi_tipe_nama' => htmlspecialchars($this->request->getPost('jenis_retribusi_tipe_nama')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
        if ($jenisRetribusiTipeModel->save($data)) {
          $this->session->setFlashdata('success', 'Jenis Retribusi Tipe berhasil ditambahkan');
          return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
        } else {
          $this->session->setFlashdata('error', 'Gagal menambahkan jenis Retribusi tipe');
          return redirect()->back()->withInput();
        }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  public function ubah($id = null)
  {
    $data['_view'] = 'admin/master/jenis_retribusi_tipe/ubah';
    if ($id == null) {
      return redirect()->back();
    }
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $jenisRetribusiTipe = $jenisRetribusiTipeModel->find($id);
    if (!$jenisRetribusiTipe) {
      $this->session->setFlashdata('error', 'Jenis Retribusi Tipe tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
    }
    $data['_title'] = "Ubah Jabatan {$jenisRetribusiTipe['jenis_retribusi_tipe_nama']}";
    $data['_jenis_retribusi_tipe'] = $jenisRetribusiTipe;
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_retribusi_tipe_nama' => [
          'label'  => 'Nama Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_retribusi_tipe_nama' => htmlspecialchars($this->request->getPost('jenis_retribusi_tipe_nama')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        if ($jenisRetribusiTipe['jenis_retribusi_tipe_nama'] == $data['jenis_retribusi_tipe_nama']) {
          $this->session->setFlashdata('success', 'Jenis Retribusi Tipe tidak ada perubahan');
          return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
        }
        if ($jenisRetribusiTipeModel->update($id, $data)) {
          $this->session->setFlashdata('success', 'Jenis Retribusi Tipe berhasil diubah');
          return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah Jenis Retribusi Tipe');
          return redirect()->back()->withInput();
        }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  public function hapus($id = null)
  {
    if ($id == null) {
      return redirect()->back();
    }
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $jenisRetribusiTipe = $jenisRetribusiTipeModel->find($id);
    if (!$jenisRetribusiTipe) {
      $this->session->setFlashdata('error', 'Jenis Retribusi Tipe tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
    }
    if ($jenisRetribusiTipeModel->is_using($id)) {
      $this->session->setFlashdata('error', 'Jenis Retribusi Tipe masih digunakan, tidak bisa dihapus');
      return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
    }
    if ($jenisRetribusiTipeModel->delete($id)) {
      $this->session->setFlashdata('success', 'Jenis Retribusi Tipe berhasil dihapus');
      return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus Jenis Retribusi Tipe');
      return redirect()->to(base_url('admin/master/jenis_retribusi_tipe'));
    }
  }
}
