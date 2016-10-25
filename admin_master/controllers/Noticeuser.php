<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Noticeuser extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('user_model');
		$this->load->model('noticedepartment_model');
	}
	
	function index() {
		$notices = $this->noticedepartment_model->get_all('user', $this->_loginuser);
		$this->data['notices'] = $notices;
		$this->load->view('notice_user/index', $this->data);
	}
	
	function add() {
		$this->load->view('notice_user/add', $this->data);
	}
	
	
	function doadd() {
		$content = trim($this->input->post('content'));
		$doctors = $this->doctor_model->get_by_masterid($this->_loginuser);
		for($i = 0; $i < count($doctors); $i++) {
			$data = array();
			$users = $this->user_model->get_by_doctorid($doctors[$i]['id']);
			for($j = 0; $j < count($users); $j++) {
				$data[] = array(
					'type' => 'user',
					'departmentid' => $this->_loginuser,
					'userid' => $users[$j]['id'],
					'content' => $content
				);
			}
			$this->noticedepartment_model->add($data);
		}
		header('Location: ./index');
	}
	
	function del() {
		$departmentid = trim($this->input->get('did'));
		$createtime = trim($this->input->get('time'));
		$this->noticedepartment_model->del($createtime, $departmentid, 'user');
		header('Location: ./index');
	}
	
	
	
}