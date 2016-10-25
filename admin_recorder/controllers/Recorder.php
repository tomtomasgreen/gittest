<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Recorder extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('recorder_model');
	}
	
	function editpwd() {
		$this->load->view('recorder/editpwd', $this->data);
	}
	
	function updatepwd() {
		$oldpassword = $this->input->post('oldpassword');
		$password = $this->input->post('password');
		$recorder = $this->recorder_model->get_by_id($this->_loginuser);
		if(nn_password($oldpassword) != $recorder['password']) {
			exit('原密码错误！');
		} else {
			$this->recorder_model->editpwd($this->_loginuser, $password);
			$this->load->view('recorder/updatepwd', $this->data);
		}
	}
	
}