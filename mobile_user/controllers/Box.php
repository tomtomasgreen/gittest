<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Box extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('box_model');
	}
	
	function index() {
		$box = $this->box_model->get_by_userid($this->_loginuser);
		$this->data['box'] = $box;
		$this->load->view('box/index', $this->data);
	}
	
	function add() {
		$this->load->view('box/add', $this->data);
	}
	
	function unbind() {
		$sn = $this->input->post('sn');
		$result = $this->box_model->unbind($this->_loginuser, $sn);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function bind() {
		$sn = $this->input->post('sn');
		$result = -1;
		if($this->box_model->is_sn_valid($sn)) {
			$box = $this->box_model->get_by_sn($sn);
			if(!$box) {
				$data = array(
					'sn' => $sn,
					'userid' => $this->_loginuser
				);
				$result = $this->box_model->add($data);
			}
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	

}