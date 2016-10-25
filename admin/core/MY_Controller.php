<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$name = $this->session->userdata('name');
		$uid = $this->session->userdata('uid');

		if(!$name || !$uid){
			echo '<script>window.location.href="'.base_url().'admin.php/login/index"</script>';
			die;
		}



	}
}