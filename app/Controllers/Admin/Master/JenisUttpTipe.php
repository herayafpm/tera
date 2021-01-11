<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\Admin\BaseController;
use App\Models\JenisUttpTipeModel;

class JenisUttpTipe extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/master/jenis_uttp_tipe/index';
    $data['_title'] = 'Jenis UTTP Tipe';
    $data['_uri_datatable'] = base_url('admin/master/jenis_uttp_tipe/datatable');
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $jenisUttpTipeModel = new JenisUttpTipeModel();
      $where = null;
      $like = null;
      if (!empty($this->request->getPost('jenis_uttp_tipe_nama'))) {
        $like['jenis_uttp_tipe_nama'] = htmlspecialchars($this->request->getPost('jenis_uttp_tipe_nama'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($jenisUttpTipeModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function tambah()
  {
    $data['_view'] = 'admin/master/jenis_uttp_tipe/tambah';
    $data['_title'] = 'Tambah Jenis UTTP Tipe';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_uttp_tipe_nama' => [
          'label'  => 'Nama Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_uttp_tipe_nama' => htmlspecialchars($this->request->getPost('jenis_uttp_tipe_nama')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $jenisUttpTipeModel = new JenisUttpTipeModel();
        if ($jenisUttpTipeModel->save($data)) {
          $this->session->setFlashdata('success', 'Jenis UTTP Tipe berhasil ditambahkan');
          return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
        } else {
          $this->session->setFlashdata('error', 'Gagal menambahkan jenis uttp tipe');
          return redirect()->back()->withInput();
        }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  public function ubah($id = null)
  {
    $data['_view'] = 'admin/master/jenis_uttp_tipe/ubah';
    if ($id == null) {
      return redirect()->back();
    }
    $jenisUttpTipeModel = new JenisUttpTipeModel();
    $jenisUttpTipe = $jenisUttpTipeModel->find($id);
    if (!$jenisUttpTipe) {
      $this->session->setFlashdata('error', 'Jenis UTTP Tipe tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
    }
    $data['_title'] = "Ubah Jabatan {$jenisUttpTipe['jenis_uttp_tipe_nama']}";
    $data['_jenis_uttp_tipe'] = $jenisUttpTipe;
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_uttp_tipe_nama' => [
          'label'  => 'Nama Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_uttp_tipe_nama' => htmlspecialchars($this->request->getPost('jenis_uttp_tipe_nama')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        if ($jenisUttpTipe['jenis_uttp_tipe_nama'] == $data['jenis_uttp_tipe_nama']) {
          $this->session->setFlashdata('success', 'Jenis UTTP Tipe tidak ada perubahan');
          return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
        }
        if ($jenisUttpTipeModel->update($id, $data)) {
          $this->session->setFlashdata('success', 'Jenis UTTP Tipe berhasil diubah');
          return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah Jenis UTTP Tipe');
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
    $jenisUttpTipeModel = new JenisUttpTipeModel();
    $jenisUttpTipe = $jenisUttpTipeModel->find($id);
    if (!$jenisUttpTipe) {
      $this->session->setFlashdata('error', 'Jenis UTTP Tipe tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
    }
    if ($jenisUttpTipeModel->is_using($id)) {
      $this->session->setFlashdata('error', 'Jenis UTTP Tipe masih digunakan, tidak bisa dihapus');
      return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
    }
    if ($jenisUttpTipeModel->delete($id)) {
      $this->session->setFlashdata('success', 'Jenis UTTP Tipe berhasil dihapus');
      return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus Jenis UTTP Tipe');
      return redirect()->to(base_url('admin/master/jenis_uttp_tipe'));
    }
  }
}
