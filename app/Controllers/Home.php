<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['_session'] = $this->session;
		$data['_title'] = 'Selamat Datang';
		$data['_view'] = 'welcome_message';
		return view($data['_view'], $data);
	}

	//--------------------------------------------------------------------

}
