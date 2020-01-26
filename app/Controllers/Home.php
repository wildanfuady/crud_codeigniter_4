<?php namespace App\Controllers;

use App\Models\WelcomeModel;
class Home extends BaseController
{
	public function index()
	{
		$data['kata'] = WelcomeModel::get();
		return view('welcome_message', $data);
	}

	//--------------------------------------------------------------------

}
