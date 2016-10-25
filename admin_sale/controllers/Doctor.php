<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
	}
	
	function index() {
		$this->load->view('doctor/index', $this->data);
	}
	
	function add() {
		$data = array(
			'mobile' => $this->input->post('mobile'),
			'password' => $this->input->post('password'),
			'username' => $this->input->post('username'),
			'province' => $this->input->post('province'),
			'city' => $this->input->post('city'),
			'hospital' => $this->input->post('hospital'),
			'department' => $this->input->post('department'),
			'job' => $this->input->post('job'),
			'address' => ''
		);
		$doctor = $this->doctor_model->get_by_mobile($data['mobile']);
		if($doctor) exit('手机号已被使用！');
		$data['password'] = nn_password2($data['password']);
		$result = $this->doctor_model->add($data);
		$this->load->view('doctor/add', $this->data);
	}

}