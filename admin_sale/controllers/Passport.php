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
		$this->_loginuser = isset($_SESSION['loginsale']) ? $_SESSION['loginsale'] : false;
		$this->_timestamp = time();
		$this->data['timestamp'] = $this->_timestamp;
		if($this->_loginuser) {
			$this->data['loginsale'] = $this->_loginuser;
		} else {
			// if($this->router->method != 'login' && $this->router->method != 'reg') {
				// header('Location: /passport/login');
			// }
		}
	}
	
	function login() {
		if($_POST) {
			$password  = $this->input->post('password');
			if($password == config_item('password')){
				$_SESSION['loginsale'] = 1;
				header('Location: ' . config_item('app_url') . 'index/index');
			} else {
				exit('密码错误！');
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
		unset($_SESSION['loginsale']);
		header('Location: ' . config_item('app_url') . 'passport/login');
	}


}