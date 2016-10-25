<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Recorder extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('recorder_model');
		$this->load->model('master_model');
	}
	
	function index() {
		$this->load->view('recorder/index', $this->data);
	}
	
	function add_recorder() {
		$data = array(
			'masterid' => $this->input->post('masterid'),
			'mobile' => $this->input->post('mobile'),
			'password' => $this->input->post('password'),
			'username' => $this->input->post('username')
		);
		$result = 0;
		$recorder = $this->recorder_model->get_by_mobile($data['mobile']);
		if($recorder) {
			$result = -1;
		} else {
			$data['password'] = nn_password($data['password']);
			$result = $this->recorder_model->add($data);
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function get_master() {
		$mobile = $this->input->post('master_mobile');
		$master = $this->master_model->get_by_mobile($mobile);
		if($master) {
			echo json_encode($master);
		} else {
			echo -1;
		}
	}


}