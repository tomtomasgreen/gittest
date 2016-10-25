<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Mission extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('mission_model');
	}
	
	function create() {
		if($_POST) {
			$title = $this->input->post('title');
			$content = $this->input->post('content');
			$photos = $this->input->post('photos');
			$missiondate = $this->input->post('missiondate');
			$missiontime = $this->input->post('missiontime');
			$missiontimes = $missiondate . ' ' . $missiontime;
			$missiontime = strtotime($missiontimes);
			$data = array(
				'doctorid' => $this->_loginuser,
				'title' => $title,
				'content' => $content,
				'photos' => $photos,
				'missiontime' => $missiontime,
				'missiontimes' => $missiontimes
			);
			$result = $this->mission_model->add($data);
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			$this->load->view('mission/create', $this->data);
		}
	}
	


}