<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;
use App\Models\AdminModel;

class AuthFilter implements
  FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $session = session();
    if (!isset($session->isLogin)) {
      return redirect()->to(base_url('auth/login'));
    }
    if (isset($session->isAdmin)) {
      $adminModel = new AdminModel();
      $admin = $adminModel->getAdminDetail($session->admin_id);
      $request->admin = $admin;
    } else {
      $userModel = new UserModel();
      $user = $userModel->getUserDetail($session->user_id);
      $request->user = $user;
    }
  }

  //--------------------------------------------------------------------

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
