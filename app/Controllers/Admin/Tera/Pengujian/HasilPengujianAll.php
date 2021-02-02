<?php

namespace App\Controllers\Admin\Tera\Pengujian;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\TeraModel;
use App\Models\TeraUttpDetailModel;
use App\Models\TeraUttpRetribusiModel;
use App\Models\TeraUttpModel;

class HasilPengujianAll extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index($jenis_tempat_id, $status, $tera_id, $tera_uttp_retribusi_id, $tipe)
  {
    helper('my');
    $teraModel = new TeraModel();
    $data['_url_back'] = base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/{$status}/uji/{$tera_id}/{$tera_uttp_retribusi_id}");
    $tera = $teraModel->getTera($tera_id);
    if (sizeof($tera) <= 1) {
      $this->session->setFlashdata('error', 'Tera tidak ditemukkan');
      return redirect()->to($data['_url_back']);
    }
    $teraUttpModel = new TeraUttpModel();
    $teraUttpRetribusiModel = new TeraUttpRetribusiModel();
    $teraUttpRetribusi = $teraUttpRetribusiModel->getTeraUttp($tera_uttp_retribusi_id);
    $teraUttp = $teraUttpModel->getTeraUttpByRetribusi($tera_uttp_retribusi_id);
    $data['_validation'] = $this->form_validation;
    $data['_view'] = "admin/tera/pengujian/hasil_pengujian/{$tipe}/index";
    $data['_tera_uttp_retribusi'] = $teraUttpRetribusi;
    $data['_tera_uttp'] = $teraUttp;
    $data = array_merge($data, $this->data);
    $date = date('Y-m-d', strtotime($tera['tera_date_order']));
    $data['_title'] = "Riwayat Pengujian Tera {$tera['tera_no_order']} <span class='toLocaleDateOnly'>{$date}</span> {$teraUttpRetribusi['jenis_uttp_nama']}";
    $method = $this->request->getMethod();
    if ($method == 'post') {
      if ($tipe == 1) {
        return $this->pengujian_tipe1($jenis_tempat_id, $status, $tera, $teraUttpRetribusi, $teraUttp);
      } else if ($tipe == 2) {
        return $this->pengujian_tipe2($jenis_tempat_id, $status, $tera, $teraUttpRetribusi, $teraUttp);
      } else if ($tipe == 3) {
        return $this->pengujian_tipe3($jenis_tempat_id, $status, $tera, $teraUttpRetribusi, $teraUttp);
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  protected function pengujian_tipe1($jenis_tempat_id, $status, $tera, $teraUttpRetribusi, $teraUttp)
  {
    $rule = [
      'tera_uttp_merk' => [
        'label'  => 'Merk',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_tipe' => [
        'label'  => 'Type',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_no_seri' => [
        'label'  => 'Nomor Seri',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_buatan' => [
        'label'  => 'Buatan',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
    ];
    $data = [
      'tera_uttp_merk' => htmlspecialchars($this->request->getPost('tera_uttp_merk')),
      'tera_uttp_tipe' => htmlspecialchars($this->request->getPost('tera_uttp_tipe')),
      'tera_uttp_no_seri' => htmlspecialchars($this->request->getPost('tera_uttp_no_seri')),
      'tera_uttp_buatan' => htmlspecialchars($this->request->getPost('tera_uttp_buatan')),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    } else {
      $data['tera_uttp_pengujian_at'] = date('Y-m-d H:i:s');
      $teraUttpModel = new TeraUttpModel();
      if ($teraUttpModel->where('tera_uttp_retribusi_id', $teraUttpRetribusi['tera_uttp_retribusi_id'])->set($data)->update()) {
        $teraModel = new TeraModel();
        $teraModel->update($tera['tera_id'], ['tera_status_pengujian' => 1]);
        $this->session->setFlashdata('success', 'Berhasil Menguji Tera UTTP');
        return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/1/uji/{$tera['tera_id']}/{$teraUttpRetribusi['tera_uttp_retribusi_id']}"));
      } else {
        $this->session->setFlashdata('error', 'Gagal Menguji Tera UTTP');
        return redirect()->back()->withInput();
      }
    }
  }
  protected function pengujian_tipe2($jenis_tempat_id, $status, $tera, $teraUttpRetribusi, $teraUttp)
  {
    $rule = [
      'tera_uttp_merk' => [
        'label'  => 'Merk',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_no_seri' => [
        'label'  => 'Nomor Seri',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_volume' => [
        'label'  => 'Volume',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_merk_kendaraan' => [
        'label'  => 'Merk Kendaraan',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_no_polisi' => [
        'label'  => 'No. Polisi / Chasis',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_no_kd_plat' => [
        'label'  => 'No. Kode Plat',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t1_muka' => [
        'label'  => 't1 muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t2_muka' => [
        'label'  => 't2 muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t3_muka' => [
        'label'  => 't3 muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t4_muka' => [
        'label'  => 't4 muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t_muka' => [
        'label'  => 't muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_d_muka' => [
        'label'  => 'd muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_p_muka' => [
        'label'  => 'p muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_q_muka' => [
        'label'  => 'q muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_s_muka' => [
        'label'  => 's muka',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t1_belakang' => [
        'label'  => 't1 belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t2_belakang' => [
        'label'  => 't2 belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t3_belakang' => [
        'label'  => 't3 belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t4_belakang' => [
        'label'  => 't4 belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_t_belakang' => [
        'label'  => 't belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_d_belakang' => [
        'label'  => 'd belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_p_belakang' => [
        'label'  => 'p belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_q_belakang' => [
        'label'  => 'q belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_detail_s_belakang' => [
        'label'  => 's belakang',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
    ];
    $data = [
      'tera_uttp_merk' => htmlspecialchars($this->request->getPost('tera_uttp_merk')),
      'tera_uttp_no_seri' => htmlspecialchars($this->request->getPost('tera_uttp_no_seri')),
      'tera_uttp_volume' => htmlspecialchars($this->request->getPost('tera_uttp_volume')),
      'tera_uttp_merk_kendaraan' => htmlspecialchars($this->request->getPost('tera_uttp_merk_kendaraan')),
      'tera_uttp_no_polisi' => htmlspecialchars($this->request->getPost('tera_uttp_no_polisi')),
      'tera_uttp_no_kd_plat' => htmlspecialchars($this->request->getPost('tera_uttp_no_kd_plat')),
      'tera_uttp_detail_t1_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t1_muka')),
      'tera_uttp_detail_t2_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t2_muka')),
      'tera_uttp_detail_t3_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t3_muka')),
      'tera_uttp_detail_t4_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t4_muka')),
      'tera_uttp_detail_t_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t_muka')),
      'tera_uttp_detail_d_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_d_muka')),
      'tera_uttp_detail_p_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_p_muka')),
      'tera_uttp_detail_q_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_q_muka')),
      'tera_uttp_detail_s_muka' => htmlspecialchars($this->request->getPost('tera_uttp_detail_s_muka')),
      'tera_uttp_detail_t1_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t1_belakang')),
      'tera_uttp_detail_t2_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t2_belakang')),
      'tera_uttp_detail_t3_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t3_belakang')),
      'tera_uttp_detail_t4_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t4_belakang')),
      'tera_uttp_detail_t_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_t_belakang')),
      'tera_uttp_detail_d_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_d_belakang')),
      'tera_uttp_detail_p_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_p_belakang')),
      'tera_uttp_detail_q_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_q_belakang')),
      'tera_uttp_detail_s_belakang' => htmlspecialchars($this->request->getPost('tera_uttp_detail_s_belakang')),
      'tera_uttp_keterangan' => htmlspecialchars($this->request->getPost('tera_uttp_keterangan')),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    } else {
      $data['tera_uttp_tipe'] = null;
      $data['tera_uttp_pengujian_at'] = date('Y-m-d H:i:s');
      $teraUttpModel = new TeraUttpModel();
      if ($teraUttpModel->where('tera_uttp_retribusi_id', $teraUttpRetribusi['tera_uttp_retribusi_id'])->set($data)->update()) {
        $teraUttpDetailModel = new TeraUttpDetailModel();
        $teraUttps = $teraUttpModel->where('tera_uttp_retribusi_id', $teraUttpRetribusi['tera_uttp_retribusi_id'])->get()->getResultArray();
        foreach ($teraUttps as $tera_uttp) {
          $teraUttpDetail = $teraUttpDetailModel->where(['tera_uttp_id' => $tera_uttp['tera_uttp_id']])->first();
          if ($teraUttpDetail) {
            $teraUttpDetailModel->update($teraUttpDetail['tera_uttp_detail_id'], $data);
          } else {
            $data['tera_uttp_id'] = $tera_uttp['tera_uttp_id'];
            $teraUttpDetailModel->save($data);
          }
        }
        $teraModel = new TeraModel();
        $teraModel->update($tera['tera_id'], ['tera_status_pengujian' => 1]);
        $this->session->setFlashdata('success', 'Berhasil Menguji Tera UTTP');
        return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/1/uji/{$tera['tera_id']}/{$teraUttpRetribusi['tera_uttp_retribusi_id']}"));
      } else {
        $this->session->setFlashdata('error', 'Gagal Menguji Tera UTTP');
        return redirect()->back()->withInput();
      }
    }
  }
  protected function pengujian_tipe3($jenis_tempat_id, $status, $tera, $teraUttpRetribusi, $teraUttp)
  {
    $rule = [
      'tera_uttp_merk' => [
        'label'  => 'Merk / Type / Nomor Seri',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_tipe' => [
        'label'  => 'Type',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_no_seri' => [
        'label'  => 'Nomor Seri',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_merk_kendaraan' => [
        'label'  => 'Merk Kendaraan',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'tera_uttp_no_polisi' => [
        'label'  => 'No. Polisi dan No. Lambung',
        'rules'  => "required",
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
    ];
    $data = [
      'tera_uttp_merk' => htmlspecialchars($this->request->getPost('tera_uttp_merk')),
      'tera_uttp_tipe' => htmlspecialchars($this->request->getPost('tera_uttp_tipe')),
      'tera_uttp_no_seri' => htmlspecialchars($this->request->getPost('tera_uttp_no_seri')),
      'tera_uttp_merk_kendaraan' => htmlspecialchars($this->request->getPost('tera_uttp_merk_kendaraan')),
      'tera_uttp_no_polisi' => htmlspecialchars($this->request->getPost('tera_uttp_no_polisi')),
    ];
    $this->form_validation->setRules($rule);
    if (!$this->form_validation->run($data)) {
      return redirect()->back()->withInput();
    } else {
      $data['tera_uttp_pengujian_at'] = date('Y-m-d H:i:s');
      $teraUttpModel = new TeraUttpModel();
      if ($teraUttpModel->where('tera_uttp_retribusi_id', $teraUttpRetribusi['tera_uttp_retribusi_id'])->set($data)->update()) {
        $teraModel = new TeraModel();
        $teraModel->update($tera['tera_id'], ['tera_status_pengujian' => 1]);
        $this->session->setFlashdata('success', 'Berhasil Menguji Tera UTTP');
        return redirect()->to(base_url("admin/tera/pengujian/{$jenis_tempat_id}/riwayat/1/uji/{$tera['tera_id']}/{$teraUttpRetribusi['tera_uttp_retribusi_id']}"));
      } else {
        $this->session->setFlashdata('error', 'Gagal Menguji Tera UTTP');
        return redirect()->back()->withInput();
      }
    }
  }
}
