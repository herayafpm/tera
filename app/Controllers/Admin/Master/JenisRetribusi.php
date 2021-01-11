<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\Admin\BaseController;
use App\Models\JenisRetribusiModel;
use App\Models\JenisRetribusiTipeModel;
use App\Models\JenisTeraModel;
use App\Models\JenisTempatModel;
use App\Models\JenisRetribusiTarifModel;

class JenisRetribusi extends BaseController
{
  protected $form_validation = null;
  public function __construct()
  {
    helper('form');
    $this->form_validation =  \Config\Services::validation();
  }
  public function index()
  {
    $data['_view'] = 'admin/master/jenis_retribusi/index';
    $data['_title'] = 'Jenis Retribusi';
    $data['_uri_datatable'] = base_url('admin/master/jenis_retribusi/datatable');
    $data['_scroll_datatable'] = "350px";
    $data = array_merge($data, $this->data);
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $jenisRetribusiTipes = $jenisRetribusiTipeModel->findAll();
    $data['_jenis_retribusi_tipes'] = $jenisRetribusiTipes;
    $jenisTeraModel = new JenisTeraModel();
    $jenisTeras = $jenisTeraModel->findAll();
    $data['_jenis_teras'] = $jenisTeras;
    $jenisTempatModel = new JenisTempatModel();
    $jenisTempats = $jenisTempatModel->findAll();
    $data['_jenis_tempats'] = $jenisTempats;
    return view($data['_view'], $data);
  }
  public function datatable()
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $jenisRetribusiModel = new JenisRetribusiModel();
      $where = null;
      $tarif_where = null;
      $like = null;
      if (!empty($this->request->getPost('jenis_retribusi_nama'))) {
        $like['jenis_retribusi.jenis_retribusi_nama'] = htmlspecialchars($this->request->getPost('jenis_retribusi_nama'));
      }
      if (!empty($this->request->getPost('jenis_retribusi_tipe_id'))) {
        $where['jenis_retribusi_tipe.jenis_retribusi_tipe_id'] = htmlspecialchars($this->request->getPost('jenis_retribusi_tipe_id'));
      }
      if (!empty($this->request->getPost('jenis_tera_id'))) {
        $tarif_where['jenis_retribusi_tarif.jenis_tera_id'] = htmlspecialchars($this->request->getPost('jenis_tera_id'));
      }
      if (!empty($this->request->getPost('jenis_tempat_id'))) {
        $tarif_where['jenis_retribusi_tarif.jenis_tempat_id'] = htmlspecialchars($this->request->getPost('jenis_tempat_id'));
      }
      $params = ['where' => $where, 'like' => $like, 'tarif_where' => $tarif_where];
      return $this->datatable_data($jenisRetribusiModel, $params);
    } else {
      return redirect()->back();
    }
  }
  public function tambah()
  {
    $data['_view'] = 'admin/master/jenis_retribusi/tambah';
    $data['_title'] = 'Tambah Jenis Retribusi';
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $jenisRetribusiTipes = $jenisRetribusiTipeModel->findAll();
    $data['_jenis_retribusi_tipes'] = $jenisRetribusiTipes;
    $jenisTeraModel = new JenisTeraModel();
    $jenisTeras = $jenisTeraModel->findAll();
    $data['_jenis_teras'] = $jenisTeras;
    $jenisTempatModel = new JenisTempatModel();
    $jenisTempats = $jenisTempatModel->findAll();
    $data['_jenis_tempats'] = $jenisTempats;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_retribusi_nama' => [
          'label'  => 'Nama Retribusi',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jenis_retribusi_tipe_id' => [
          'label'  => 'Jenis Retribusi Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_retribusi_nama' => htmlspecialchars($this->request->getPost('jenis_retribusi_nama')),
        'jenis_retribusi_tipe_id' => htmlspecialchars($this->request->getPost('jenis_retribusi_tipe_id')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        $jenisRetribusiModel = new JenisRetribusiModel();
        $create = $jenisRetribusiModel->save($data);
        if ($create) {
          $jenis_retribusi_id = $jenisRetribusiModel->InsertID();
          $jenisRetribusiTarifModel = new JenisRetribusiTarifModel();
          foreach ($jenisTeras as $jenisTera) {
            foreach ($jenisTempats as $jenisTempat) {
              $tarif = htmlspecialchars($this->request->getPost('jenis_retribusi_tarif-' . $jenisTera['jenis_tera_id'] . "-" . $jenisTempat['jenis_tempat_id']));
              if (isset($tarif) && $tarif != 0) {
                $jenisRetribusiTarifModel->save([
                  'jenis_retribusi_id' => $jenis_retribusi_id,
                  'jenis_tera_id' => $jenisTera['jenis_tera_id'],
                  'jenis_tempat_id' => $jenisTempat['jenis_tempat_id'],
                  'jenis_retribusi_tarif_bayar' => $tarif,
                ]);
              }
            }
          }
          $this->session->setFlashdata('success', 'Jenis Retribusi berhasil ditambahkan');
          return redirect()->to(base_url('admin/master/jenis_retribusi'));
        } else {
          $this->session->setFlashdata('error', 'Gagal menambahkan jenis Retribusi');
          return redirect()->back()->withInput();
        }
      }
    } else {
      return view($data['_view'], $data);
    }
  }
  public function ubah($id = null)
  {
    $data['_view'] = 'admin/master/jenis_retribusi/ubah';
    if ($id == null) {
      return redirect()->back();
    }
    $jenisRetribusiModel = new JenisRetribusiModel();
    $jenisRetribusi = $jenisRetribusiModel->getRetribusiDetail($id);
    if (!$jenisRetribusi) {
      $this->session->setFlashdata('error', 'Jenis Retribusi tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_retribusi'));
    }
    $data['_title'] = "Ubah Jenis Retribusi {$jenisRetribusi['jenis_retribusi_nama']}";
    $data['_jenis_retribusi'] = $jenisRetribusi;
    $data['_validation'] = $this->form_validation;
    $data = array_merge($data, $this->data);
    $jenisRetribusiTipeModel = new JenisRetribusiTipeModel();
    $jenisRetribusiTipes = $jenisRetribusiTipeModel->findAll();
    $data['_jenis_retribusi_tipes'] = $jenisRetribusiTipes;
    $jenisTeraModel = new JenisTeraModel();
    $jenisTeras = $jenisTeraModel->findAll();
    $data['_jenis_teras'] = $jenisTeras;
    $jenisTempatModel = new JenisTempatModel();
    $jenisTempats = $jenisTempatModel->findAll();
    $data['_jenis_tempats'] = $jenisTempats;
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $rule = [
        'jenis_retribusi_nama' => [
          'label'  => 'Nama Retribusi',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jenis_retribusi_tipe_id' => [
          'label'  => 'Jenis Retribusi Tipe',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $data = [
        'jenis_retribusi_nama' => htmlspecialchars($this->request->getPost('jenis_retribusi_nama')),
        'jenis_retribusi_tipe_id' => htmlspecialchars($this->request->getPost('jenis_retribusi_tipe_id')),
      ];
      $this->form_validation->setRules($rule);
      if (!$this->form_validation->run($data)) {
        return redirect()->back()->withInput();
      } else {
        if ($jenisRetribusiModel->update($id, $data)) {
          $jenis_retribusi_id = $id;
          $jenisRetribusiTarifModel = new JenisRetribusiTarifModel();
          foreach ($jenisTeras as $jenisTera) {
            foreach ($jenisTempats as $jenisTempat) {
              $tarif = htmlspecialchars($this->request->getPost('jenis_retribusi_tarif-' . $jenisTera['jenis_tera_id'] . "-" . $jenisTempat['jenis_tempat_id']));
              $insertData = [
                'jenis_retribusi_id' => $jenis_retribusi_id,
                'jenis_tera_id' => $jenisTera['jenis_tera_id'],
                'jenis_tempat_id' => $jenisTempat['jenis_tempat_id'],
              ];
              if (isset($tarif) && $tarif != 0) {
                $jenis_retribusi_tarif = $jenisRetribusiTarifModel->where($insertData)->first();
                $insertData['jenis_retribusi_tarif_bayar'] = $tarif;
                if ($jenis_retribusi_tarif) {
                  $jenisRetribusiTarifModel->update($jenis_retribusi_tarif['jenis_retribusi_tarif_id'], $insertData);
                } else {
                  $jenisRetribusiTarifModel->save($insertData);
                }
              } else {
                $jenis_retribusi_tarif = $jenisRetribusiTarifModel->where($insertData)->first();
                if ($jenis_retribusi_tarif) {
                  $jenisRetribusiTarifModel->delete($jenis_retribusi_tarif['jenis_retribusi_tarif_id']);
                }
              }
            }
          }
          $this->session->setFlashdata('success', 'Jenis Retribusi berhasil diubah');
          return redirect()->to(base_url('admin/master/jenis_retribusi'));
        } else {
          $this->session->setFlashdata('error', 'Gagal mengubah Jenis Retribusi');
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
    $jenisRetribusiModel = new JenisRetribusiModel();
    $jenisRetribusi = $jenisRetribusiModel->find($id);
    if (!$jenisRetribusi) {
      $this->session->setFlashdata('error', 'Jenis Retribusi tidak ditemukan');
      return redirect()->to(base_url('admin/master/jenis_retribusi'));
    }
    // if ($Jenis RetribusiModel->is_using($id)) {
    //   $this->session->setFlashdata('error', 'Jenis Retribusi masih digunakan, tidak bisa dihapus');
    //   return redirect()->to(base_url('admin/master/Jenis Retribusi'));
    // }
    if ($jenisRetribusiModel->delete($id)) {
      $this->session->setFlashdata('success', 'Jenis Retribusi berhasil dihapus');
      return redirect()->to(base_url('admin/master/jenis_retribusi'));
    } else {
      $this->session->setFlashdata('error', 'Gagal menghapus Jenis Retribusi');
      return redirect()->to(base_url('admin/master/jenis_retribusi'));
    }
  }
}
