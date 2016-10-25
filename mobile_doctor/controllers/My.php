<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class My extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('scorelog_model');
		$this->load->model('department_model');
		$this->load->model('noticedepartment_model');
	}
	
	function index() {
		$doctor = $this->doctor_model->get_by_id($this->_loginuser);
		$department = $this->doctor_model->get_department($this->_loginuser);
		$notices_unread = $this->noticedepartment_model->get_unread($department['id'], $this->_loginuser);
		$this->data['doctor'] = $doctor;
		$this->data['notices_unread'] = $notices_unread;
		$this->load->view('my/index', $this->data);
	}
	
	function info() {
		$doctor = $this->doctor_model->get_by_id($this->_loginuser);
		$this->data['doctor'] = $doctor;
		$this->load->view('my/info', $this->data);
	}
	
	function department() {
		$department = $this->doctor_model->get_department($this->_loginuser);
		$notices_unread = $this->noticedepartment_model->get_unread($department['id'], $this->_loginuser);
		$mates = false;
		if($department) {
			$masterid = $department['id'];
			$mates = $this->department_model->get_mates_by_masterid($masterid);
		}
		$this->data['department'] = $department;
		$this->data['notices_unread'] = $notices_unread;
		$this->data['mates'] = $mates;
		$this->load->view('my/department', $this->data);
	}
	
	function notice_department() {
		$department = $this->doctor_model->get_department($this->_loginuser);
		$notices_unread = $this->noticedepartment_model->get_unread($department['id'], $this->_loginuser);
		$notices_read = $this->noticedepartment_model->get_read($department['id'], $this->_loginuser);
		$this->noticedepartment_model->read_unread($department['id'], $this->_loginuser);
		$this->data['notices_unread'] = $notices_unread;
		$this->data['notices_read'] = $notices_read;
		$this->load->view('my/notice_department', $this->data);
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
			'city' => $this->input->post('city'),
			'hospital' => $this->input->post('hospital'),
			'department' => $this->input->post('department')
		);
		$result = $this->doctor_model->update_by_id($this->_loginuser, $data);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function money() {
		$doctor = $this->doctor_model->get_by_id($this->_loginuser);
		$logs = $this->scorelog_model->get_by_doctorid($this->_loginuser);
		$_way = array(
			'REGISTER' => '注册新账户',
			'RELATION' => '添加患者',
			'CHAT' => '患者对话',
			'NEW_COLLECT' => '兑换答题券'
		);
		for($i = 0; $i < count($logs); $i++) {
			$logs[$i]['way'] = $_way[$logs[$i]['way']];
		}
		$this->data['doctor'] = $doctor;
		$this->data['logs'] = $logs;
		$this->load->view('my/money', $this->data);
	}
	
	function editpwd() {
		if($_POST) {
			$oldpassword = $this->input->post('oldpassword');
			$password = $this->input->post('password');
			$result = $this->doctor_model->editpwd($this->_loginuser, $oldpassword, $password);
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			$this->load->view('my/editpwd', $this->data);
		}
	}


}