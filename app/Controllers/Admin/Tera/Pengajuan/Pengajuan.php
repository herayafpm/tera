<?php

namespace App\Controllers\Admin\Tera\Pengajuan;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\UserModel;
use App\Models\TeraPengajuanModel;
use App\Models\AdminModel;
use App\Models\JenisTeraModel;
use App\Models\JenisUttpModel;
use App\Models\TeraModel;
use App\Models\TeraPetugasModel;
use App\Models\TeraUttpRetribusiModel;
use App\Models\TeraUttpModel;

class Pengajuan extends BaseController
{
  protected $jenis_tempat_id = 2;
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/tera/pengajuan/tambah';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $data['_title'] = "Pengajuan Tera Tempat Pakai";
    $adminModel = new AdminModel();
    $data['_petugass'] =  $adminModel->filter(0, 0, 'admin_id', 'desc', ['where' => ['admin.role_id' => 4, 'admin.admin_status' => 1]]);
    $jenisTeraModel = new JenisTeraModel();
    $jenisTeras = $jenisTeraModel->findAll();
    $data['_jenis_teras'] = $jenisTeras;
    $jenisUttpModel = new JenisUttpModel();
    $paramsJenisUttp = null;
    $paramsJenisUttp['where'] = ['jenis_uttp_tempat_pakai' => 1];
    $jenisUttps = $jenisUttpModel->filter(-1, null, null, null, $paramsJenisUttp);
    $data['_jenis_uttps'] = $jenisUttps;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      return $this->process();
    } else {
      return view($data['_view'], $data);
    }
  }
  protected function process()
  {
    $min_jenis_uttp = 1;
    $max_petugas = 2;
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
      'user_telepon' => [
        'label'  => 'No Telepon Wajib Tera',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_pengajuan_keterangan' => [
        'label'  => 'Keterangan',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_pengajuan_date_order' => [
        'label'  => 'Tanggal Booking',
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
      'petugas_ids' => [
        'label'  => 'Petugas',
        'rules'  => "required|min_length_array[1]|max_length_array[{$max_petugas}]",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'max_length_array' => '{field} harus 1 atau {param} petugas',
          'min_length_array' => '{field} harus 1 atau {param} petugas',
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
      'user_telepon' => htmlspecialchars($this->request->getPost('user_telepon')),
      'tera_pengajuan_keterangan' => $this->request->getPost('tera_pengajuan_keterangan'),
      'tera_pengajuan_date_order' => htmlspecialchars($this->request->getPost('tera_pengajuan_date_order')),
      'tera_no_order' => htmlspecialchars($this->request->getPost('tera_no_order')),
      'jenis_tera_id' => htmlspecialchars($this->request->getPost('jenis_tera_id')),
      'tera_atas_nama' => htmlspecialchars($this->request->getPost('tera_atas_nama')),
      'tera_atas_nama_alamat' => htmlspecialchars($this->request->getPost('tera_atas_nama_alamat')),
      'petugas_ids' => $this->request->getPost('petugas_ids'),
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
        $userModel->update($user['user_id'], [
          'user_nama' => $data['user_nama'],
          'user_alamat' => $data['user_alamat'],
          'user_telepon' => $data['user_telepon'],
        ]);
      } else {
        $userModel->save([
          'user_nik' => $data['user_nik'],
          'user_nama' => $data['user_nama'],
          'user_alamat' => $data['user_alamat'],
          'user_telepon' => $data['user_telepon'],
          'user_password' => env("passwordDefault"),
        ]);
        $data['user_id'] = $userModel->InsertID();
      }
      unset($data['user_nik']);
      unset($data['user_nama']);
      unset($data['user_alamat']);
      unset($data['user_telepon']);
      $admin = $this->data['_admin'];
      $data['tera_pengajuan_status'] = 1;
      $data['tera_pengajuan_status_by'] = $admin->admin_id;
      $data['tera_pengajuan_status_at'] = date('Y-m-d H:i:s');
      $teraPengajuanModel = new TeraPengajuanModel();
      if ($teraPengajuanModel->save($data)) {
        $data['jenis_tempat_id'] = $this->jenis_tempat_id;
        $data['tera_status'] = 1;
        $data['tera_status_by'] = $admin->admin_id;
        $data['tera_status_at'] = date('Y-m-d H:i:s');
        $data['tera_date_order'] = $data['tera_pengajuan_date_order'];
        $teraModel = new TeraModel();
        $tera_pengajuan_id = $teraPengajuanModel->InsertID();
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
          $teraPetugasModel = new TeraPetugasModel();
          foreach ($data['petugas_ids'] as $petugas) {
            $teraPetugasModel->save(['tera_id' => $tera_id, 'tera_petugas_admin' => $petugas]);
          }
          $teraPengajuanModel->update($tera_pengajuan_id, ['tera_id' => $tera_id]);
          $this->session->setFlashdata('success', 'Berhasil Mengajukan Tera');
          return redirect()->to(base_url("admin/tera/pengajuan/riwayat/1"));
        } else {
          $teraModel->delete($tera_pengajuan_id);
          $this->session->setFlashdata('error', 'Gagal mengajukan');
          return redirect()->back()->withInput();
        }
      } else {
        $this->session->setFlashdata('error', 'Gagal mengajukan Tera');
        return redirect()->back()->withInput();
      }
    }
  }
}
