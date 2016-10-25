<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Passport extends CI_Controller {
	
	protected $data = array();
	private $_loginuser, $_timestamp;
   	
	function __construct() {
		parent::__construct();
		$this->_loginuser = isset($_SESSION['loginrecorder']) ? $_SESSION['loginrecorder'] : false;
		$this->_timestamp = time();
		$this->data['timestamp'] = $this->_timestamp;
		if($this->_loginuser) {
			$this->data['loginrecorder'] = $this->_loginuser;
		} else {
			// if($this->router->method != 'login' && $this->router->method != 'reg') {
				// header('Location: /passport/login');
			// }
		}
		$this->load->model('recorder_model');
	}
	
	function login() {
		if($_POST) {
			$mobile = $this->input->post('mobile');
			$password  = $this->input->post('password');
			$master = $this->recorder_model->get_by_mobile($mobile);
			if(!$master){
				exit('账号或密码错误！');
			} else {
				if($master['password'] == nn_password($password)) {
					$_SESSION['loginrecorder'] = $master['id'];
					header('Location: ' . config_item('app_url') . 'index/index');
				} else {
					exit('账号或密码错误！');
				}
			}
		} else {
			if($this->_loginuser) {
				header('Location: ' . config_item('app_url') . 'index/index');
			} else {
				$this->load->view('passport/login', $this->data);
			}
		}
	}
	
	function logout() {
		unset($_SESSION['loginrecorder']);
		header('Location: ' . config_item('app_url') . 'passport/login');
	}


}