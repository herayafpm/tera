<?php

namespace App\Controllers\Admin;

class Dashboard extends BaseController
{
  public function index()
  {
    $data['_view'] = 'admin/dashboard';
    $data['_title'] = 'Dashboard';
    $data = array_merge($data, $this->data);
    return view($data['_view'], $data);
  }
}
