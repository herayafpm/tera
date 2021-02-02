<?php

namespace App\Controllers\Admin\Tera\Pendaftaran;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\JenisTeraModel;
use App\Models\JenisUttpModel;
use App\Models\UserModel;
use App\Models\TeraModel;
use App\Models\TeraUttpRetribusiModel;
use App\Models\TeraUttpModel;

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
    if ($jenis_tempat_id != 1) {
      $this->session->setFlashdata('error', 'Halaman tidak ditemukan');
      return redirect()->to(base_url('admin/dashboard'));
    }
    $this->getJenisTempat($jenis_tempat_id);
    $data['_view'] = 'admin/tera/pendaftaran/tambah';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $data['_title'] = "Pendaftaran Tera {$data['_jenis_tempat']['jenis_tempat_nama']}";
    $jenisTeraModel = new JenisTeraModel();
    $jenisTeras = $jenisTeraModel->findAll();
    $data['_jenis_teras'] = $jenisTeras;
    $jenisUttpModel = new JenisUttpModel();
    $paramsJenisUttp = null;
    if ($jenis_tempat_id == 2) {
      $paramsJenisUttp['where'] = ['jenis_uttp_tempat_pakai' => 1];
    } else if ($jenis_tempat_id == 1) {
      $paramsJenisUttp['where'] = ['jenis_uttp_tempat_pakai' => 0];
    }
    $jenisUttps = $jenisUttpModel->filter(-1, null, null, null, $paramsJenisUttp);
    $data['_jenis_uttps'] = $jenisUttps;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      return $this->process($jenis_tempat_id);
    } else {
      return view($data['_view'], $data);
    }
  }
  protected function process($jenis_tempat_id)
  {
    $min_jenis_uttp = 1;
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
        'rules'  => "required|min_length_array[{$min_jenis_uttp}]",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'min_length_array' => '{field} harus lebih dari sama dengan {param} jenis',
        ]
      ],
      'jenis_uttp_namas' => [
        'label'  => 'Tera Jenis UTTP',
        'rules'  => "required|min_length_array[{$min_jenis_uttp}]",
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
      $data['jenis_tempat_id'] = $jenis_tempat_id;
      $userModel = new UserModel();
      $user = $userModel->findByNIK($data['user_nik']);
      if ($user) {
        $data['user_id'] = $user['user_id'];
      } else {
        $userModel->save([
          'user_nik' => $data['user_nik'],
          'user_nama' => $data['user_nama'],
          'user_alamat' => $data['user_alamat'],
          'user_password' => env("passwordDefault"),
        ]);
        $data['user_id'] = $userModel->InsertID();
      }
      unset($data['user_nik']);
      unset($data['user_nama']);
      unset($data['user_alamat']);
      $admin = $this->data['_admin'];
      $data['tera_status'] = 1;
      $data['tera_status_by'] = $admin->admin_id;
      $data['tera_status_at'] = date('Y-m-d H:i:s');
      $data['tera_date_order'] = date('Y-m-d');
      $teraModel = new TeraModel();
      if ($teraModel->save($data)) {
        $tera_id = $teraModel->InsertID();
        $jenis_uttp_ids = explode(',', $data['jenis_uttp_ids'][0]);
        $kapasitass = explode(',', $data['kapasitass'][0]);
        $daya_bacas =  explode(',', $data['daya_bacas'][0]);
        $jumlahs =  explode(',', $data['jumlahs'][0]);
        $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
        $teraUttpModel = new TeraUttpModel();
        $no = 0;
        foreach ($jenis_uttp_ids as $jenis_uttp_id) {
          $teraUttpRetribusiModel->save([
            'tera_id' => $tera_id,
            'jenis_uttp_id' => $jenis_uttp_id,
            'tera_uttp_kapasitas' => $kapasitass[$no],
            'tera_uttp_daya_baca' => $daya_bacas[$no],
            'tera_uttp_jumlah' => $jumlahs[$no],
          ]);
          $teraUttpRetribusiId = $teraUttpRetribusiModel->InsertID();
          for ($i = 0; $i < (int) $jumlahs[$no]; $i++) {
            $teraUttpModel->save(['tera_uttp_retribusi_id' => $teraUttpRetribusiId]);
          }
          $no++;
        }
        $this->session->setFlashdata('success', 'Berhasil Mendaftar');
        return redirect()->to(base_url("admin/tera/pendaftaran/{$jenis_tempat_id}/riwayat/1"));
      } else {
        $this->session->setFlashdata('error', 'Gagal mendaftar');
        return redirect()->back()->withInput();
      }
    }
  }
}
