<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('notice_model');
	}
	
	function index() {
		$notices = $this->notice_model->get_all();
		$this->data['notices'] = $notices;
		$this->load->view('notice/index', $this->data);
	}
	


}