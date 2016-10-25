<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends NN_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->load->view('test/index', $this->data);
	}
	
}