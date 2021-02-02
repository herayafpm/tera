<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\JenisTempatModel;

class AdminFilter implements
  FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!isset($request->admin)) {
      return redirect()->to(base_url('auth/login'));
    }
    $jenisTempatModel = new JenisTempatModel();
    $admin = $request->admin;
    if ($admin->role_id == 2) {
      $pengajuanStatuses = ["proses", "verifikasi", "tolak"];
      $request->pengajuanStatuses = $pengajuanStatuses;
    }
    if ($admin->role_id == 4 || $admin->role_id == 5) {
      $pengujianStatuses = ["belum", "sudah"];
      $request->pengujianStatuses = $pengujianStatuses;
    }
    if ($admin->role_id != 1 || $admin->role_id == 4) {
      $request->jenisTempats = $jenisTempatModel->findAll();
    }
    if ($admin->role_id == 2 || $admin->role_id == 4) {
      $statuses = ["proses", "verifikasi", "tolak"];
      $request->teraStatuses = $statuses;
    }
    if ($admin->role_id == 3) {
      $statuses = ["proses", "lunas", "keringanan"];
      $request->teraPembayaranStatuses = $statuses;
    }
    if ($arguments != null) {
      if (!in_array($admin->role_id, $arguments)) {
        return redirect()->to(base_url("admin/dashboard"));
      }
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
