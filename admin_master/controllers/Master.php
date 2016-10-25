<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('master_model');
	}
	
	function editpwd() {
		$this->load->view('master/editpwd', $this->data);
	}
	
	function updatepwd() {
		$oldpassword = $this->input->post('oldpassword');
		$password = $this->input->post('password');
		$master = $this->master_model->get_by_id($this->_loginuser);
		if(nn_password($oldpassword) != $master['password']) {
			exit('原密码错误！');
		} else {
			$this->master_model->editpwd($this->_loginuser, $password);
			$this->load->view('master/updatepwd', $this->data);
		}
	}
	
}