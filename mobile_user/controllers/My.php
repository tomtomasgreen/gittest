<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class My extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('doctor_model');
		$this->load->model('scorelog_model');
		$this->load->model('noticedepartment_model');
	}
	
	function index() {
		$user = $this->user_model->get_by_id($this->_loginuser);
		$doctor = $this->doctor_model->get_by_userid($this->_loginuser);
		$department = $this->doctor_model->get_department($doctor['id']);
		$notices_unread = $this->noticedepartment_model->get_unread($department['id'], $this->_loginuser);
		$this->data['notices_unread'] = $notices_unread;
		$this->data['user'] = $user;
		$this->load->view('my/index', $this->data);
	}
	
	function notice_department() {
		$doctor = $this->doctor_model->get_by_userid($this->_loginuser);
		$department = $this->doctor_model->get_department($doctor['id']);
		$notices_unread = $this->noticedepartment_model->get_unread($department['id'], $this->_loginuser);
		$notices_read = $this->noticedepartment_model->get_read($department['id'], $this->_loginuser);
		$this->noticedepartment_model->read_unread($department['id'], $this->_loginuser);
		$this->data['notices_unread'] = $notices_unread;
		$this->data['notices_read'] = $notices_read;
		$this->load->view('my/notice_department', $this->data);
	}
	
	function info() {
		$user = $this->user_model->get_by_id($this->_loginuser);
		$this->data['user'] = $user;
		$this->load->view('my/info', $this->data);
	}
	
	// 更新个人信息
	function info_update() {
		$data = array(
			'thumb' => $this->input->post('thumb'),
			'username' => $this->input->post('username'),
			'sex' => $this->input->post('sex'),
			'birthyear' => $this->input->post('birthyear'),
			'birthmonth' => $this->input->post('birthmonth'),
			'province' => $this->input->post('province'),
			'city' => $this->input->post('city')
		);
		$result = $this->user_model->update_by_id($this->_loginuser, $data);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function money() {
		$user = $this->user_model->get_by_id($this->_loginuser);
		$logs = $this->scorelog_model->get_by_userid($this->_loginuser);
		$_way = array(
			'REGISTER' => '注册新账户',
			'DOSSIER' => '新增病历',
			'CHAT' => '医生对话',
			'RECORD' => '新增健康记录',
			'BUY_GIFT' => '兑换礼品',
			'OHMATE_BUY' => '商城兑换',
			'OHMATE_GIFT' => '商城赠送'
		);
		for($i = 0; $i < count($logs); $i++) {
			$logs[$i]['way'] = $_way[$logs[$i]['way']];
		}
		$this->data['user'] = $user;
		$this->data['logs'] = $logs;
		$this->load->view('my/money', $this->data);
	}
	
	function money_ohmate() {
		$user = $this->user_model->get_by_id($this->_loginuser);
		$this->data['user'] = $user;
		$this->data['isWeixinBrowser'] = nn_isWeixinBrowser();
		$this->load->view('my/money_ohmate', $this->data);
	}
	
	function relation() {
		$this->load->view('my/relation', $this->data);
	}
	
	function editpwd() {
		if($_POST) {
			$oldpassword = $this->input->post('oldpassword');
			$password = $this->input->post('password');
			$result = $this->user_model->editpwd($this->_loginuser, $oldpassword, $password);
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			$this->load->view('my/editpwd', $this->data);
		}
	}


}