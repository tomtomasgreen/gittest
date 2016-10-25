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
	
	function index() {
		$this->load->view('master/index', $this->data);
	}
	
	function add() {
		$data = array(
			'mobile' => $this->input->post('mobile'),
			'password' => $this->input->post('password'),
			'username' => $this->input->post('username'),
			'hospital' => $this->input->post('hospital'),
			'department' => $this->input->post('department'),
			'job' => $this->input->post('job'),
			'address' => $this->input->post('address')
		);
		$master = $this->master_model->get_by_mobile($data['mobile']);
		if($master) exit('手机号已被使用！');
		$data['password'] = nn_password($data['password']);
		$result = $this->master_model->add($data);
		$this->load->view('master/add', $this->data);
	}


}