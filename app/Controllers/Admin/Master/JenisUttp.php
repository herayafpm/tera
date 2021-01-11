<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\Admin\BaseController;
use App\Models\JenisUttpModel;
use App\Models\JenisUttpTipeModel;

class JenisUttp extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/master/jenis_uttp/index';
    $data['_title'] = 'Jenis UTTP';
    $data['_uri_datatable'] = base_url('admin/master/jenis_uttp/datatable');
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    $jenisUttpTipeModel = new JenisUttpTipeModel();
    $jenisUttpTipes = $jenisUttpTipeModel->findAll();
    $data['_jenis_uttp_tipes'] = $jenisUttpTipes;
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $jenisUttpModel = new JenisUttpModel();
      $where = null;
      $like = null;
      if (!empty($this->request->getPost('jenis_uttp_nama'))) {
        $like['jenis_uttp.jenis_uttp_nama'] = htmlspecialchars($this->request->getPost('jenis_uttp_nama'));
      }
      if (!empty($this->request->getPost('jenis_uttp_tipe_id'))) {
        $val = $this->request->getPost('jenis_uttp_tipe_id');
        if ($val == 'no_tipe') {
          $where['jenis_uttp_tipe.jenis_uttp_tipe_id'] = null;
        } else {
          $where['jenis_uttp_tipe.jenis_uttp_tipe_id'] = htmlspecialchars($this->request->getPost('jenis_uttp_tipe_id'));
        }
      }
      $val = $this->request->getPost('jenis_uttp_tempat_pakai');
      if ($val != "") {
        $where['jenis_uttp.jenis_uttp_tempat_pakai'] = htmlspecialchars($this->request->getPost('jenis_uttp_tempat_pakai'));
        if ($val == 'all') {
          unset($where['jenis_uttp.jenis_uttp_tempat_pakai']);
        }
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($jenisUttpModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function tambah()
  {
    $data['_view'] = 'admin/master/jenis_uttp/tambah';
    $data['_title'] = 'Tambah Jenis UTTP';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $jenisUttpTipeModel = new JenisUttpTipeModel();
    $jenisUttpTipes = $jenisUttpTipeModel->findAll();
    $data['_jenis_uttp_tipes'] = $jenisUttpTipes;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_uttp_nama' => [
          'label'  => 'Nama Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_uttp_nama' => htmlspecialchars($this->request->getPost('jenis_uttp_nama')),
        'jenis_uttp_tipe_id' => htmlspecialchars($this->request->getPost('jenis_uttp_tipe_id')),
        'jenis_uttp_tempat_pakai' => htmlspecialchars($this->request->getPost('jenis_uttp_tempat_pakai')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        if (empty($data['jenis_uttp_tipe_id'])) {
          $data['jenis_uttp_tipe_id'] = null;
        }
        $jenisUttpModel = new JenisUttpModel();
        if ($jenisUttpModel->save($data)) {
          $this->session->setFlashdata('success', 'Jenis UTTP berhasil ditambahkan');
          return redirect()->to(base_url('admin/master/jenis_uttp'));
        } else {
          $this->session->setFlashdata('error', 'Gagal menambahkan jenis uttp');
          return redirect()->back()->withInput();
        }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  public function ubah($id = null)
  {
    $data['_view'] = 'admin/master/jenis_uttp/ubah';
    if ($id == null) {
      return redirect()->back();
    }
    $jenisUttpModel = new JenisUttpModel();
    $jenisUttp = $jenisUttpModel->find($id);
    if (!$jenisUttp) {
      $this->session->setFlashdata('error', 'Jenis UTTP tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_uttp'));
    }
    $data['_title'] = "Ubah Jenis UTTP {$jenisUttp['jenis_uttp_nama']}";
    $data['_jenis_uttp'] = $jenisUttp;
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $jenisUttpTipeModel = new JenisUttpTipeModel();
    $jenisUttpTipes = $jenisUttpTipeModel->findAll();
    $data['_jenis_uttp_tipes'] = $jenisUttpTipes;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_uttp_nama' => [
          'label'  => 'Nama Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_uttp_nama' => htmlspecialchars($this->request->getPost('jenis_uttp_nama')),
        'jenis_uttp_tipe_id' => htmlspecialchars($this->request->getPost('jenis_uttp_tipe_id')),
        'jenis_uttp_tempat_pakai' => htmlspecialchars($this->request->getPost('jenis_uttp_tempat_pakai')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        if (empty($data['jenis_uttp_tipe_id'])) {
          $data['jenis_uttp_tipe_id'] = null;
        }
        if ($jenisUttpModel->update($id, $data)) {
          $this->session->setFlashdata('success', 'Jenis UTTP berhasil diubah');
          return redirect()->to(base_url('admin/master/jenis_uttp'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah Jenis UTTP');
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
    $jenisUttpModel = new JenisUttpModel();
    $jenisUttp = $jenisUttpModel->find($id);
    if (!$jenisUttp) {
      $this->session->setFlashdata('error', 'Jenis UTTP tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_uttp'));
    }
    // if ($Jenis UTTPModel->is_using($id)) {
    //   $this->session->setFlashdata('error', 'Jenis UTTP masih digunakan, tidak bisa dihapus');
    //   return redirect()->to(base_url('admin/master/Jenis UTTP'));
    // }
    if ($jenisUttpModel->delete($id)) {
      $this->session->setFlashdata('success', 'Jenis UTTP berhasil dihapus');
      return redirect()->to(base_url('admin/master/jenis_uttp'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus Jenis UTTP');
      return redirect()->to(base_url('admin/master/jenis_uttp'));
    }
  }
}
