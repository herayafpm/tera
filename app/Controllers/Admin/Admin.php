<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use App\Models\AdminModel;
use App\Models\AdminLogModel;
use App\Models\RoleModel;
use App\Models\AparaturModel;

class Admin extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/admin/index';
    $data['_title'] = 'Admin';
    $data['_uri_datatable'] = base_url('admin/admin/datatable');
    $data['_scroll_datatable'] = "350px";
    $roleModel = new RoleModel();
    $data['_roles'] = $roleModel->filter(-1, 0);
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $adminModel = new AdminModel();
      $where = ['admin.role_id !=' => 1];
      $like = null;
      if (!empty($this->request->getPost('admin_username'))) {
        $like['admin.admin_username'] = htmlspecialchars($this->request->getPost('admin_username'));
      }
      if (!empty($this->request->getPost('admin_nama'))) {
        $like['admin.admin_nama'] = htmlspecialchars($this->request->getPost('admin_nama'));
      }
      if (!empty($this->request->getPost('role_id'))) {
        $where['admin.role_id'] = htmlspecialchars($this->request->getPost('role_id'));
      }
      $params = ['where' => $where, 'like' => $like];

      return $this->datatable_data($adminModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function tambah()
  {
    $data['_view'] = 'admin/admin/tambah';
    $data['_title'] = 'Tambah Admin';
    $data['_validation'] = $this->form_validation;
    $roleModel = new RoleModel();
    $data['_roles'] = $roleModel->findAll();
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'admin_nama' => [
          'label'  => 'Nama',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'admin_username' => [
          'label'  => 'Username / NIP',
          'rules'  => 'required|is_unique[admin.admin_username]',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'is_unique' => '{field} sudah digunakan, gunakan yang lain'
          ]
        ],
        'role_id' => [
          'label'  => 'Tugas',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'admin_nama' => htmlspecialchars($this->request->getPost('admin_nama')),
        'admin_username' => htmlspecialchars($this->request->getPost('admin_username')),
        'role_id' => htmlspecialchars($this->request->getPost('role_id')),
        'admin_keterangan' => htmlspecialchars($this->request->getPost('admin_keterangan')),
        'admin_status' => htmlspecialchars($this->request->getPost('admin_status') ?? 0),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $adminModel = new AdminModel();
        $data['admin_password'] = env("passwordDefault");
        if ($adminModel->save($data)) {
          $this->session->setFlashdata('success', 'Admin berhasil ditambahkan');
          return redirect()->to(base_url('admin/admin'));
        } else {
          $this->session->setFlashdata('error', 'Gagal menambahkan admin');
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
    $adminModel = new AdminModel();
    $admin = $adminModel->find($id);
    if (!$admin) {
      $this->session->setFlashdata('error', 'Admin ditemukan');
      return redirect()->to(base_url('admin/admin'));
    }
    $data['admin'] = $admin;
    $data['_view'] = 'admin/admin/ubah';
    $data['_title'] = "Ubah Admin {$admin['admin_nama']}";
    $data['_validation'] = $this->form_validation;
    $roleModel = new RoleModel();
    $data['_roles'] = $roleModel->findAll();
    $data = array_merge($data, $this->data);
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'admin_nama' => [
          'label'  => 'Nama',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'admin_username' => [
          'label'  => 'Username / NIP',
          'rules'  => "required|is_unique[admin.admin_username,admin_id,{$id}]",
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'is_unique' => '{field} sudah digunakan, gunakan yang lain'
          ]
        ],
        'role_id' => [
          'label'  => 'Tugas',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'admin_password' => [
          'label'  => 'Password',
          'rules'  => 'update_pass[6]',
          'errors' => [
            'update_pass' => '{field} min {param} karakter',
          ]
        ],
      ];
      $data = [
        'admin_nama' => htmlspecialchars($this->request->getPost('admin_nama')),
        'admin_username' => htmlspecialchars($this->request->getPost('admin_username')),
        'role_id' => htmlspecialchars($this->request->getPost('role_id')),
        'admin_password' => htmlspecialchars($this->request->getPost('admin_password')),
        'admin_keterangan' => htmlspecialchars($this->request->getPost('admin_keterangan')),
        'admin_status' => htmlspecialchars($this->request->getPost('admin_status') ?? 0),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $aparaturModel = new AparaturModel();
        $aparatur = $aparaturModel->findByNIP($admin['admin_username']);
        if ($aparatur) {
          if ($aparatur['aparatur_nip'] != $data['admin_username'] || $aparatur['aparatur_nama'] != $data['admin_nama']) {
            $this->session->setFlashdata('error', 'Tidak bisa mengubah username atau nama admin, silahkan ubah dari menu aparatur');
            return redirect()->back()->withInput();
          }
        }
        if ($adminModel->update($id, $data)) {
          $this->session->setFlashdata('success', 'Admin berhasil diubah');
          return redirect()->to(base_url('admin/admin'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah admin');
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
    $adminModel = new AdminModel();
    $admin = $adminModel->find($id);
    if (!$admin) {
      $this->session->setFlashdata('error', 'admin ditemukan');
      return redirect()->to(base_url('admin/admin'));
    }
    if ($adminModel->is_using($id, $admin['admin_username'])) {
      $this->session->setFlashdata('error', 'admin masih digunakan, tidak bisa dihapus');
      return redirect()->to(base_url('admin/admin'));
    }
    if ($adminModel->delete($id)) {
      $this->session->setFlashdata('success', 'admin berhasil dihapus');
      return redirect()->to(base_url('admin/admin'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus admin');
      return redirect()->to(base_url('admin/admin'));
    }
  }
  public function log($id = null)
  {
    $data['_view'] = '/admin/log/index';
    $adminModel = new AdminModel();
    $admin = $adminModel->find($id);
    $data['_title'] = "Riwayat Masuk {$admin['admin_nama']}";
    $data['_uri_datatable'] = base_url("admin/admin/log/{$id}/datatable");
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
  public function log_datatable($id = null)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $adminLogModel = new AdminLogModel();
      $adminModel = new AdminModel();
      $admin = $adminModel->find($id);
      $params = ['where' => ['admin_username' => $admin['admin_username']]];
      return $this->datatable_data($adminLogModel, $params);
    } else {
      return redirect()->back();
    }
  }
}
