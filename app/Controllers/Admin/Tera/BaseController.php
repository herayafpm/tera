<?php

namespace App\Controllers\Admin\Tera;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\JenisTempatModel;

class BaseController extends Controller
{

  /**
   * An array of helpers to be loaded automatically upon
   * class instantiation. These helpers will be available
   * to all other controllers that extend BaseController.
   *
   * @var array
   */
  protected $helpers = [];

  /**
   * Constructor.
   */
  protected $session;
  public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
  {
    // Do Not Edit This Line
    parent::initController($request, $response, $logger);

    $this->session = \Config\Services::session();
    $this->data['_admin'] = $request->admin;
    $this->data['_jenis_tempats'] = $request->jenisTempats ?? [];
    $this->data['_tera_statuses'] = $request->teraStatuses ?? [];
    $this->data['_pengujian_statuses'] = $request->pengujianStatuses ?? [];
    $this->data['_pengajuan_statuses'] = $request->pengajuanStatuses ?? [];
    $this->data['_tera_pembayaran_statuses'] = $request->teraPembayaranStatuses ?? [];
    $this->data['uri'] = current_url(true);
    $this->data['_session'] = $this->session;
    //--------------------------------------------------------------------
    // Preload any models, libraries, etc, here.
    //--------------------------------------------------------------------
    // E.g.:
    // $this->session = \Config\Services::session();
  }
  public function getPengajuanStatus($status)
  {
    return $this->data['_pengajuan_status'] = $this->data['_pengajuan_statuses'][$status];
  }
  public function getPengujianStatus($status)
  {
    return $this->data['_pengujian_status'] = $this->data['_pengujian_statuses'][$status];
  }
  protected function getJenisTempat($jenis_tempat_id)
  {
    $jenisTempatModel = new JenisTempatModel();
    $this->data['_jenis_tempat'] = $jenisTempatModel->find($jenis_tempat_id);
  }
  protected function getTeraStatus($status)
  {
    $this->data['_tera_status'] = $this->data['_tera_statuses'][$status];
  }
  protected function getTeraPembayaranStatus($status)
  {
    $this->data['_tera_pembayaran_status'] = $this->data['_tera_pembayaran_statuses'][$status];
  }
  protected function datatable_data($model, $params = [])
  {
    $limit = $_POST['length']; // Ambil data limit per page
    $start = $_POST['start']; // Ambil data start
    $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
    $orderBy = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $ordered = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
    $sql_total = $model->count_all($params); // Panggil fungsi count_all pada Admin
    $sql_data = $model->filter($limit, $start, $orderBy, $ordered, $params); // Panggil fungsi filter pada Admin
    $sql_filter = $model->count_all($params); // Panggil fungsi count_filter pada Admin
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
