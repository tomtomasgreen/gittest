<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends NN_Controller
{
	function index()
	{
		header('Location: ' . config_item('app_url') . 'doctor/index');
	}


}