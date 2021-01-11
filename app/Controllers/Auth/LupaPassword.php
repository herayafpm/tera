<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LupaPassword extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_session'] = $this->session;
    $data['_title'] = 'Lupa Password';
    $data['_view'] = 'auth/lupa_password';
    $data['_validation'] = $this->form_validation;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      return $this->process();
    } else {
      return view($data['_view'], $data);
    }
  }

  public function process()
  {
    $rule = [
      'nik' => [
        'label'  => 'NIK',
        'rules'  => "required|find_nik",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'find_nik' => '{field} tidak ditemukan',
        ]
      ],
      'new_password' => [
        'label'  => 'Password Baru',
        'rules'  => 'required|min_length[6]|matches[new_password2]',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'min_length' => '{field} harus lebih dari 6 karakter',
          'matches' => '{field} tidak sama dengan {param}'
        ]
      ],
      'new_password2' => [
        'label'  => 'Konfirmasi Password Baru',
        'rules'  => 'required|min_length[6]|matches[new_password]',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'min_length' => '{field} harus lebih dari 6 karakter',
          'matches' => '{field} tidak sama dengan {param}'
        ]
      ],
    ];
    $data = [
      'nik' => htmlspecialchars($this->request->getPost('nik')),
      'new_password' => htmlspecialchars($this->request->getPost('new_password')),
      'new_password2' => htmlspecialchars($this->request->getPost('new_password2')),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    } else {
      $userModel = new UserModel();
      $updatePassword = $userModel->update_data(['user_nik' => $data['nik']], ['password' => $data['new_password']]);
      if ($updatePassword) {
        $this->session->setFlashdata('success', 'Password berhasil diubah');
        return redirect()->to(base_url('auth/login'));
      } else {
        $this->session->setFlashdata('error', 'Password gagal diubah');
        return redirect()->back()->withInput();
      }
    }
  }

  //--------------------------------------------------------------------

}
