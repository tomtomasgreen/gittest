<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class NN_Controller extends CI_Controller {
	
	protected $data = array();
	protected $_loginuser, $_timestamp, $_wechat;
	
	function __construct() {
		parent::__construct();
		$this->_loginuser = isset($_SESSION['loginrecorder']) ? $_SESSION['loginrecorder'] : false;
		if($this->_loginuser) {
			$this->_timestamp = time();
			// $this->_wechat = new NN_wechat($this->nw_config['appid'], $this->nw_config['appsecret']);
			$this->data['timestamp'] = $this->_timestamp;
			$this->data['loginrecorder'] = $this->_loginuser;
		} else {
			header('Location: ' . config_item('app_url') . 'passport/login');
		}
	}


}