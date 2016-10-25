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
		// if($_SESSION['logindoctor'] != 5)
		// $_SESSION['logindoctor'] = 4;
		// $this->_loginuser = isset($_SESSION['logindoctor']) ? $_SESSION['logindoctor'] : false;
		$this->_loginuser = isset($_COOKIE['logindoctor']) ? $_COOKIE['logindoctor'] : false;
		// luiji_log(__FILE__, __LINE__, 'this->_loginuser - ' . $this->_loginuser, 'debug');
		// luiji_log(__FILE__, __LINE__, 'logindoctor cookie - ' . $_COOKIE['logindoctor'], 'debug');
		$this->logdb();
		if($this->_loginuser) {
			$this->_timestamp = time();
			// $this->_wechat = new NN_wechat($this->nw_config['appid'], $this->nw_config['appsecret']);
			$this->data['timestamp'] = $this->_timestamp;
			$this->data['loginuser'] = $this->_loginuser;
		} else {
			header('Location: ' . config_item('app_url') . 'passport/login');
		}
	}


	function logdb() {
		$uri = 'doctor.php/'.$this->uri->uri_string();
		$par = json_encode($this->input->post());
		// $context->db->where ( '', '' );
		$createtime = time ();
		$createtimes = date ( 'Y-m-d H:i:s', $createtime );
		$data = array (
				'createip' => "",
				'createtime' => $createtimes,
				'createtimes' => $createtimes,
				'type' => 21,
				'userid' => "",
				'isDoc' => 0,
				'request_post' => $uri,
				'request_get' => $par,
				'salt' => "",
				'funs' => "" 
		);
		
		$this->db->insert ( 'log', $data );
	}
}