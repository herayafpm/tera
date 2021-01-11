<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use App\Models\UserModel;
use App\Models\UserLogModel;

class User extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/user/index';
    $data['_title'] = 'User';
    $data['_uri_datatable'] = base_url('admin/user/datatable');
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $userModel = new UserModel();
      $where = null;
      $like = null;
      if (!empty($this->request->getPost('user_nik'))) {
        $like['user.user_nik'] = htmlspecialchars($this->request->getPost('user_nik'));
      }
      if (!empty($this->request->getPost('user_nama'))) {
        $like['user.user_nama'] = htmlspecialchars($this->request->getPost('user_nama'));
      }
      if (!empty($this->request->getPost('admin_nama'))) {
        $like['admin.admin_nama'] = htmlspecialchars($this->request->getPost('admin_nama'));
      }
      $params = ['where' => $where, 'like' => $like];

      return $this->datatable_data($userModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function ubah($id = null)
  {
    if ($id == null) {
      return redirect()->back();
    }
    $userModel = new UserModel();
    $user = $userModel->find($id);
    if (!$user) {
      $this->session->setFlashdata('error', 'User ditemukan');
      return redirect()->to(base_url('admin/user'));
    }
    $data['_user'] = $user;
    $data['_view'] = 'admin/user/ubah';
    $data['_title'] = "Ubah User {$user['user_nama']}";
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'user_nama' => [
          'label'  => 'Nama',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'user_nik' => [
          'label'  => 'NIK',
          'rules'  => "required|is_unique[user.user_nik,user_id,{$id}]|min_length[16]|max_length[16]",
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'is_unique' => '{field} sudah digunakan, gunakan yang lain',
            'min_length' => '{field} harus sama dengan {param} karakter',
            'max_length' => '{field} harus sama dengan {param} karakter',
          ]
        ],
        'user_alamat' => [
          'label'  => 'Alamat',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'user_telepon' => [
          'label'  => 'No Telepon',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'user_nama' => htmlspecialchars($this->request->getPost('user_nama')),
        'user_nik' => htmlspecialchars($this->request->getPost('user_nik')),
        'user_alamat' => htmlspecialchars($this->request->getPost('user_alamat')),
        'user_telepon' => htmlspecialchars($this->request->getPost('user_telepon')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        if ($userModel->update($id, $data)) {
          $this->session->setFlashdata('success', 'User berhasil diubah');
          return redirect()->to(base_url('admin/user'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah user');
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
    $userModel = new UserModel();
    $user = $userModel->find($id);
    if (!$user) {
      $this->session->setFlashdata('error', 'user ditemukan');
      return redirect()->to(base_url('admin/user'));
    }
    // if ($userModel->is_using($id, $admin['admin_username'])) {
    //   $this->session->setFlashdata('error', 'admin masih digunakan, tidak bisa dihapus');
    //   return redirect()->to(base_url('admin/admin'));
    // }
    if ($userModel->delete($id)) {
      $this->session->setFlashdata('success', 'user berhasil dihapus');
      return redirect()->to(base_url('admin/user'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus user');
      return redirect()->to(base_url('admin/user'));
    }
  }
  public function log($id = null)
  {
    $data['_view'] = '/admin/user/log/index';
    $userModel = new UserModel();
    $user = $userModel->find($id);
    $data['_title'] = "Riwayat Masuk {$user['user_nama']}";
    $data['_uri_datatable'] = base_url("admin/user/log/{$id}/datatable");
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function log_datatable($id = null)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $userLogModel = new UserLogModel();
      $userModel = new UserModel();
      $user = $userModel->find($id);
      $params = ['where' => ['user_nik' => $user['user_nik']]];
      return $this->datatable_data($userLogModel, $params);
    } else {
      return redirect()->back();
    }
  }
}
