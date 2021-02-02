<?php

namespace App\Controllers\Admin\Tera\Pengujian;

use App\Controllers\Admin\Tera\BaseController;
use App\Models\JenisTeraModel;
use App\Models\TeraModel;

class RiwayatTempatPakai extends BaseController
{
  private $jenis_tempat_id = 2;
  public function index($status)
  {
    $this->getJenisTempat($this->jenis_tempat_id);
    $this->getPengujianStatus($status);
    $data['_view'] = 'admin/tera/pengujian/riwayat_tempat_pakai/index';
    $data = array_merge($data, $this->data);
    $data['_title'] = "Riwayat Pengujian Tera {$data['_jenis_tempat']['jenis_tempat_nama']} {$data['_pengujian_status']}";
    $data['_uri_datatable'] = base_url("admin/tera/pengujian/{$this->jenis_tempat_id}/riwayat/{$status}/datatable");
    $data['_uji'] = base_url("admin/tera/pengujian/{$this->jenis_tempat_id}/riwayat/{$status}/uji");
    $data['_scroll_datatable'] = "350px";
    $jenisTeraModel = new JenisTeraModel();
    $data['_jenis_teras'] = $jenisTeraModel->findAll();
    return view($data['_view'], $data);
  }
  public function datatable($status)
  {
    $method = $this->request->getMethod();
    if ($method == 'post') {
      $teraModel = new TeraModel();
      $admin = $this->data['_admin'];
      $where = ['tera.jenis_tempat_id' => $this->jenis_tempat_id, 'tera.tera_ketetapan_at !=' => null, 'tera.tera_status_bayar !=' => 0, 'tera.tera_status_pengujian' => $status];
      if ($admin->role_id == 4) {
        $where['tera_petugas.tera_petugas_admin'] = $admin->admin_id;
      }
      $like = null;
      if (!empty($this->request->getPost('jenis_tera_id'))) {
        $where['tera.jenis_tera_id'] = htmlspecialchars($this->request->getPost('jenis_tera_id'));
      }
      if (!empty($this->request->getPost('user_nik'))) {
        $where['user.user_nik'] = htmlspecialchars($this->request->getPost('user_nik'));
      }
      if (!empty($this->request->getPost('date'))) {
        $date = explode('/', htmlspecialchars($this->request->getPost('date')));
        $where['tera.tera_created >='] = $date[0] . " 00:00:00";
        $where['tera.tera_created <='] = $date[1] . " 23:59:59";
      }
      if (!empty($this->request->getPost('tera_no_order'))) {
        $like['tera.tera_no_order'] = htmlspecialchars($this->request->getPost('tera_no_order'));
      }
      if (!empty($this->request->getPost('tera_no_pendaftaran'))) {
        $like['tera.tera_no_pendaftaran'] = htmlspecialchars($this->request->getPost('tera_no_pendaftaran'));
      }
      $params = ['where' => $where, 'like' => $like];
      if ($admin->role_id == 4) {
        return $this->datatable_data_petugas($teraModel, $params);
      } else {
        return $this->datatable_data($teraModel, $params);
      }
    } else {
      return redirect()->back();
    }
  }
  protected function datatable_data_petugas($model, $params = [])
  {
    $limit = $_POST['length']; // Ambil data limit per page
    $start = $_POST['start']; // Ambil data start
    $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
    $orderBy = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $ordered = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
    $sql_total = $model->count_all_petugas($params); // Panggil fungsi count_all_petugas pada Admin
    $sql_data = $model->filter_petugas($limit, $start, $orderBy, $ordered, $params); // Panggil fungsi filter pada Admin
    $sql_filter = $model->count_all_petugas($params); // Panggil fungsi count_filter pada Admin
    $callback = [
      'draw' => $_POST['draw'], // Ini dari datatablenya
      'recordsTotal' => $sql_total,
      'recordsFiltered' => $sql_filter,
      'data' => $sql_data
    ];
    header('Content-Type: application/json');
    echo json_encode($callback); // Convert array $callback ke json
  }
}
