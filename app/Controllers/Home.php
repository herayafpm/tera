<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['_session'] = $this->session;
		if (!isset($this->session->isLogin)) {
			return redirect()->to(base_url('auth/login'));
		}
		if (isset($this->session->isAdmin)) {
			return redirect()->to(base_url('admin'));
		}
		return redirect()->to(base_url('user/tera/pendaftaran/riwayat'));
	}

	//--------------------------------------------------------------------

}
