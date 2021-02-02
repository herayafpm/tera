<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\JenisTempatModel;

class UserFilter implements
  FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!isset($request->user)) {
      return redirect()->to(base_url('auth/login'));
    }
    if (isset($request->admin)) {
      return redirect()->to(base_url('admin/dashboard'));
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
