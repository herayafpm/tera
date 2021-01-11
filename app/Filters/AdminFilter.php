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
      $request->jenisTempats = $jenisTempatModel->findAll();
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
