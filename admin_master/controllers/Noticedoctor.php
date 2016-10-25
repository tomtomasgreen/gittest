<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Noticedoctor extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('noticedepartment_model');
	}
	
	function index() {
		$notices = $this->noticedepartment_model->get_all('doctor', $this->_loginuser);
		$this->data['notices'] = $notices;
		$this->load->view('notice_doctor/index', $this->data);
	}
	
	function add() {
		$this->load->view('notice_doctor/add', $this->data);
	}
	
	function doadd() {
		$content = trim($this->input->post('content'));
		$doctors = $this->doctor_model->get_by_masterid($this->_loginuser);
		$data = array();
		for($i = 0; $i < count($doctors); $i++) {
			$data[] = array(
				'type' => 'doctor',
				'departmentid' => $this->_loginuser,
				'doctorid' => $doctors[$i]['id'],
				'content' => $content
			);
		}
		$this->noticedepartment_model->add($data);
		header('Location: ./index');
	}
	
	function del() {
		$departmentid = trim($this->input->get('did'));
		$createtime = trim($this->input->get('time'));
		$this->noticedepartment_model->del($createtime, $departmentid, 'doctor');
		header('Location: ./index');
	}
	
	
	
}