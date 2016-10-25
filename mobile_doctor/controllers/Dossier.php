<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Dossier extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('dossier_model');
	}
	
	function index() {
		$dossiers = $this->dossier_model->get_my_page($this->_loginuser, 1, config_item('perpage_dossier'));
		$this->data['dossiers'] = $dossiers;
		$this->load->view('dossier/index', $this->data);
	}
	
	function show($id = 0) {
		if($id) {
			$dossier = $this->dossier_model->get_by_id($id);
			if($dossier) {
				$this->data['dossier'] = $dossier;
				$this->load->view('dossier/show', $this->data);
			} else {
				exit('病历不存在');
			}
		} else {
			exit('病历不存在');
		}
	}
	
	function create() {
		if($_POST) {
			$data = array(
				'userid' => $this->_loginuser,
				'title' => $this->input->post('title'),
				'photos' => $this->input->post('photos'),
				'content' => $this->input->post('content')
			);
			$result = $this->dossier_model->add($data);
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			$this->load->view('dossier/create', $this->data);
		}
	}


}