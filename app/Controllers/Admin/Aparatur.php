<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use App\Models\AparaturModel;
use App\Models\JabatanModel;
use App\Models\AdminModel;

class Aparatur extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/aparatur/index';
    $data['_title'] = 'Aparatur';
    $data['_uri_datatable'] = base_url('admin/aparatur/datatable');
    $data['_scroll_datatable'] = "350px";
    $jabatanModel = new JabatanModel();
    helper('my');
    $data['_pangkats'] = get_pangkat();
    $data['_jabatans'] = $jabatanModel->findAll();
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $aparaturModel = new AparaturModel();
      $where = null;
      $like = null;
      if (!empty($this->request->getPost('aparatur_nip'))) {
        $like['aparatur.aparatur_nip'] = htmlspecialchars($this->request->getPost('aparatur_nip'));
      }
      if (!empty($this->request->getPost('aparatur_nama'))) {
        $like['aparatur.aparatur_nama'] = htmlspecialchars($this->request->getPost('aparatur_nama'));
      }
      if (!empty($this->request->getPost('jabatan_id'))) {
        $where['aparatur.jabatan_id'] = htmlspecialchars($this->request->getPost('jabatan_id'));
      }
      if (!empty($this->request->getPost('aparatur_pangkat'))) {
        $where['aparatur.aparatur_pangkat'] = htmlspecialchars($this->request->getPost('aparatur_pangkat'));
      }
      $params = ['where' => $where, 'like' => $like];

      return $this->datatable_data($aparaturModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function tambah()
  {
    $data['_view'] = 'admin/aparatur/tambah';
    $data['_title'] = 'Tambah Aparatur';
    $data['_validation'] = $this->form_validation;
    $jabatanModel = new JabatanModel();
    helper('my');
    $data['_pangkats'] = get_pangkat();
    $data['_jabatans'] = $jabatanModel->findAll();
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'aparatur_nama' => [
          'label'  => 'Nama',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'aparatur_nip' => [
          'label'  => 'NIP',
          'rules'  => 'required|is_unique[aparatur.aparatur_nip]|min_length[18]|max_length[18]',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'is_unique' => '{field} sudah digunakan, gunakan yang lain',
            'min_length' => '{field} harus sama dengan {param} karakter',
            'max_length' => '{field} harus sama dengan {param} karakter',
          ]
        ],
        'aparatur_pangkat' => [
          'label'  => 'Pangkat / Golongan',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jabatan_id' => [
          'label'  => 'Jabatan',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'aparatur_nama' => htmlspecialchars($this->request->getPost('aparatur_nama')),
        'aparatur_nip' => htmlspecialchars($this->request->getPost('aparatur_nip')),
        'aparatur_pangkat' => htmlspecialchars($this->request->getPost('aparatur_pangkat')),
        'jabatan_id' => htmlspecialchars($this->request->getPost('jabatan_id')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $aparaturModel = new AparaturModel();
        if ($aparaturModel->save($data)) {
          $this->session->setFlashdata('success', 'Aparatur berhasil ditambahkan');
          return redirect()->to(base_url('admin/aparatur'));
        } else {
          $this->session->setFlashdata('error', 'Gagal menambahkan aparatur');
          return redirect()->back()->withInput();
        }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  public function ubah($id = null)
  {
    if ($id == null) {
      return redirect()->back();
    }
    $aparaturModel = new AparaturModel();
    $aparatur = $aparaturModel->find($id);
    if (!$aparatur) {
      $this->session->setFlashdata('error', 'Aparatur ditemukan');
      return redirect()->to(base_url('admin/aparatur'));
    }
    $data['_aparatur'] = $aparatur;
    $data['_view'] = 'admin/aparatur/ubah';
    $data['_title'] = "Ubah Aparatur {$aparatur['aparatur_nama']}";
    $data['_validation'] = $this->form_validation;
    $jabatanModel = new JabatanModel();
    helper('my');
    $data['_pangkats'] = get_pangkat();
    $data['_jabatans'] = $jabatanModel->findAll();
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'aparatur_nama' => [
          'label'  => 'Nama',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'aparatur_nip' => [
          'label'  => 'NIP',
          'rules'  => "required|is_unique[aparatur.aparatur_nip,aparatur_id,{$id}]|min_length[18]|max_length[18]",
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'is_unique' => '{field} sudah digunakan, gunakan yang lain',
            'min_length' => '{field} harus sama dengan {param} karakter',
            'max_length' => '{field} harus sama dengan {param} karakter',
          ]
        ],
        'aparatur_pangkat' => [
          'label'  => 'Pangkat / Golongan',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jabatan_id' => [
          'label'  => 'Jabatan',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'aparatur_nama' => htmlspecialchars($this->request->getPost('aparatur_nama')),
        'aparatur_nip' => htmlspecialchars($this->request->getPost('aparatur_nip')),
        'aparatur_pangkat' => htmlspecialchars($this->request->getPost('aparatur_pangkat')),
        'jabatan_id' => htmlspecialchars($this->request->getPost('jabatan_id')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $aparaturModel = new AparaturModel();
        if ($aparaturModel->update($id, $data)) {
          $adminModel = new AdminModel();
          $admin = $adminModel->findByUsername($aparatur['aparatur_nip']);
          if ($admin) {
            $adminModel->update($admin['admin_id'], [
              'admin_username' => $data['aparatur_nip'],
              'admin_nama' => $data['aparatur_nama'],
            ]);
          }
          $this->session->setFlashdata('success', 'Aparatur berhasil diubah');
          return redirect()->to(base_url('admin/aparatur'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah aparatur');
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
    $aparaturModel = new AparaturModel();
    $aparatur = $aparaturModel->find($id);
    if (!$aparatur) {
      $this->session->setFlashdata('error', 'Aparatur tidak ditemukan');
      return redirect()->to(base_url('aparatur/aparatur'));
    }
    if ($aparaturModel->is_using($id, $aparatur['aparatur_nip'])) {
      $this->session->setFlashdata('error', 'Aparatur masih digunakan, tidak bisa dihapus');
      return redirect()->to(base_url('admin/aparatur'));
    }
    if ($aparaturModel->delete($id)) {
      $this->session->setFlashdata('success', 'Aparatur berhasil dihapus');
      return redirect()->to(base_url('admin/aparatur'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus aparatur');
      return redirect()->to(base_url('admin/aparatur'));
    }
  }
}
