<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Gift extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('collectcard_model');
		$this->load->model('package_model');
	}
	
	function index() {
		$this->load->view('gift/index', $this->data);
	}
	
	function history() {
		$cards = $this->collectcard_model->get_by_doctorid_gift($this->_loginuser);
		$packages = $this->package_model->get_by_doctorid_gift($this->_loginuser);
		$this->data['cards'] = $cards;
		$this->data['packages'] = $packages;
		$this->load->view('gift/history', $this->data);
	}


}