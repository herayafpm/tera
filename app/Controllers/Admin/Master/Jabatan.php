<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\Admin\BaseController;
use App\Models\JabatanModel;

class Jabatan extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/master/jabatan/index';
    $data['_title'] = 'Jabatan';
    $data['_uri_datatable'] = base_url('admin/master/jabatan/datatable');
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $jabatanModel = new JabatanModel();
      $where = null;
      $like = null;
      if (!empty($this->request->getPost('jabatan_nama'))) {
        $like['jabatan_nama'] = htmlspecialchars($this->request->getPost('jabatan_nama'));
      }
      $params = ['where' => $where, 'like' => $like];
      return $this->datatable_data($jabatanModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function tambah()
  {
    $data['_view'] = 'admin/master/jabatan/tambah';
    $data['_title'] = 'Tambah Jabatan';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jabatan_nama' => [
          'label'  => 'Jabatan',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jabatan_nama' => htmlspecialchars($this->request->getPost('jabatan_nama')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $jabatanModel = new JabatanModel();
        if ($jabatanModel->save($data)) {
          $this->session->setFlashdata('success', 'Jabatan berhasil ditambahkan');
          return redirect()->to(base_url('admin/master/jabatan'));
        } else {
          $this->session->setFlashdata('error', 'Gagal menambahkan jabatan');
          return redirect()->back()->withInput();
        }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  public function ubah($id = null)
  {
    $data['_view'] = 'admin/master/jabatan/ubah';
    if ($id == null) {
      return redirect()->back();
    }
    $jabatanModel = new JabatanModel();
    $jabatan = $jabatanModel->find($id);
    if (!$jabatan) {
      $this->session->setFlashdata('error', 'Jabatan tidak ditemukan');
      return redirect()->to(base_url('admin/master/jabatan'));
    }
    $data['_title'] = "Ubah Jabatan {$jabatan['jabatan_nama']}";
    $data['_jabatan'] = $jabatan;
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jabatan_nama' => [
          'label'  => 'Jabatan',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jabatan_nama' => htmlspecialchars($this->request->getPost('jabatan_nama')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        if ($jabatan['jabatan_nama'] == $data['jabatan_nama']) {
          $this->session->setFlashdata('success', 'Jabatan tidak ada perubahan');
          return redirect()->to(base_url('admin/master/jabatan'));
        }
        if ($jabatanModel->update($id, $data)) {
          $this->session->setFlashdata('success', 'Jabatan berhasil diubah');
          return redirect()->to(base_url('admin/master/jabatan'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah jabatan');
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
    $jabatanModel = new JabatanModel();
    $jabatan = $jabatanModel->find($id);
    if (!$jabatan) {
      $this->session->setFlashdata('error', 'Jabatan tidak ditemukan');
      return redirect()->to(base_url('admin/master/jabatan'));
    }
    if ($jabatanModel->is_using($id)) {
      $this->session->setFlashdata('error', 'Jabatan masih digunakan, tidak bisa dihapus');
      return redirect()->to(base_url('admin/master/jabatan'));
    }
    if ($jabatanModel->delete($id)) {
      $this->session->setFlashdata('success', 'Jabatan berhasil dihapus');
      return redirect()->to(base_url('admin/master/jabatan'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus jabatan');
      return redirect()->to(base_url('admin/master/jabatan'));
    }
  }
}
