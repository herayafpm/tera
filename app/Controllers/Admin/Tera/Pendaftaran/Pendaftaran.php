<?php

namespace App\Controllers\Admin\Tera\Pendaftaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\JenisTeraModel;
use App\Models\JenisUttpModel;
use App\Models\UserModel;

class Pendaftaran extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id)
  {
    $this->getJenisTempat($jenis_tempat_id);
    $data['_view'] = 'admin/tera/pendaftaran/tambah';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $data['_title'] = "Pendaftaran Tera {$data['_jenis_tempat']['jenis_tempat_nama']}";
    $jenisTeraModel = new JenisTeraModel();
    $jenisTeras = $jenisTeraModel->findAll();
    $data['_jenis_teras'] = $jenisTeras;
    $jenisUttpModel = new JenisUttpModel();
    $jenisUttps = $jenisUttpModel->filter(-1, null, null, null);
    $data['_jenis_uttps'] = $jenisUttps;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $min_jenis_uttp = 5;
      $rule = [
        'user_nik' => [
          'label'  => 'NIK Wajib Tera',
          'rules'  => 'required|min_length[16]|max_length[16]',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'min_length' => '{field} harus sama dengan {param} karakter',
            'max_length' => '{field} harus sama dengan {param} karakter',
          ]
        ],
        'user_nama' => [
          'label'  => 'Nama Wajib Tera',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'user_alamat' => [
          'label'  => 'Alamat Wajib Tera',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'tera_no_order' => [
          'label'  => 'No Order',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jenis_tera_id' => [
          'label'  => 'Jenis Pekerjaan',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'tera_atas_nama' => [
          'label'  => 'Atas Nama',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'tera_atas_nama_alamat' => [
          'label'  => 'Atas Nama Alamat',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jenis_uttp_ids' => [
          'label'  => 'Tera Jenis UTTP',
          'rules'  => 'required|min_length_array[5]',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'min_length_array' => '{field} harus lebih dari sama dengan {param} jenis',
          ]
        ],
        'jenis_uttp_namas' => [
          'label'  => 'Tera Jenis UTTP',
          'rules'  => 'required|min_length_array[5]',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
            'min_length_array' => '{field} harus lebih dari sama dengan {param} jenis',
          ]
        ],
        'kapasitass' => [
          'label'  => 'Tera Jenis UTTP',
          'rules'  => "min_length_array[{$min_jenis_uttp}]",
          'errors' => [
            'min_length_array' => '{field} harus lebih dari sama dengan {param} jenis',
          ]
        ],
        'daya_bacas' => [
          'label'  => 'Tera Jenis UTTP',
          'rules'  => "min_length_array[{$min_jenis_uttp}]",
          'errors' => [
            'min_length_array' => '{field} harus lebih dari sama dengan {param} jenis',
          ]
        ],
        'jumlahs' => [
          'label'  => 'Tera Jenis UTTP',
          'rules'  => "min_length_array[{$min_jenis_uttp}]",
          'errors' => [
            'min_length_array' => '{field} harus lebih dari sama dengan {param} jenis',
          ]
        ],
      ];
      $data = [
        'user_nik' => htmlspecialchars($this->request->getPost('user_nik')),
        'user_nama' => htmlspecialchars($this->request->getPost('user_nama')),
        'user_alamat' => htmlspecialchars($this->request->getPost('user_alamat')),
        'tera_no_order' => htmlspecialchars($this->request->getPost('tera_no_order')),
        'jenis_tera_id' => htmlspecialchars($this->request->getPost('jenis_tera_id')),
        'tera_atas_nama' => htmlspecialchars($this->request->getPost('tera_atas_nama')),
        'tera_atas_nama_alamat' => htmlspecialchars($this->request->getPost('tera_atas_nama_alamat')),
        'jenis_uttp_ids' => $this->request->getPost('jenis_uttp_ids'),
        'jenis_uttp_namas' => $this->request->getPost('jenis_uttp_namas'),
        'kapasitass' => $this->request->getPost('kapasitass'),
        'daya_bacas' => $this->request->getPost('daya_bacas'),
        'jumlahs' => $this->request->getPost('jumlahs'),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $userModel = new UserModel();
        $user = $userModel->findByNIK($data['user_nik']);
        if ($user) {
          $data['user_id'] = $user['user_id'];
        }
        // $jabatanModel = new JabatanModel();
        // if ($jabatanModel->save($data)) {
        //   $this->session->setFlashdata('success', 'Jabatan berhasil ditambahkan');
        //   return redirect()->to(base_url('admin/master/jabatan'));
        // } else {
        //   $this->session->setFlashdata('error', 'Gagal menambahkan jabatan');
        //   return redirect()->back()->withInput();
        // }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
}
