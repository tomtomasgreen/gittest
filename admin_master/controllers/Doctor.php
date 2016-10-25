<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('user_model');
	}
	
	function index() {
		$doctors = $this->doctor_model->get_by_masterid($this->_loginuser);
		$this->data['doctors'] = $doctors;
		$this->load->view('doctor/index', $this->data);
	}
	
	function add() {
		$this->load->view('doctor/add', $this->data);
	}
	
	function users($doctorid = 0) {
		$users = $this->user_model->get_by_doctorid($doctorid);
		$this->data['users'] = $users;
		$this->load->view('doctor/users', $this->data);
	}
	
	function bind() {
		$mobile = $this->input->post('mobile');
		$doctor = $this->doctor_model->get_by_mobile($mobile);
		if($doctor) {
			$department = $this->doctor_model->get_department_by_doctorid($doctor['id']);
			if($department) {
				echo '该手机号医生已被添加！';exit;
			} else {
				$data = array(
					'masterid' => $this->_loginuser,
					'doctorid' => $doctor['id']
				);
				$this->doctor_model->bind($data);
				header('Location: ./');
			}
		} else {
			echo '不存在该手机号医生！';exit;
		}
	}

	function del(){
		$id = $this->input->get('id');
		$doctor = $this->doctor_model->del($id);
		$this->index();
	}

}