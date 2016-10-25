<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Gift extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		// $this->load->model('user_model');
	}
	
	function index() {
		$this->load->view('gift/index', $this->data);
	}
	
	function history() {
		$this->load->view('gift/history', $this->data);
	}


}