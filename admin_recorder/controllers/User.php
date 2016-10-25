<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('relation_model');
		$this->load->model('doctor_model');
		$this->load->model('recorder_model');
		$this->load->model('recordsugar_model');
		$this->load->model('recordpressure_model');
		$this->load->model('recordfood_model');
		$this->load->model('recorddrug_model');
		$this->load->model('recordprotein_model');
		$this->load->model('recordbmi_model');
		$this->load->model('recordvisit_model');
		$this->load->model('recordwhr_model');
	}
	
	function index() {
		global $AREAS;
		$users = $this->user_model->get_all_users($this->_loginuser);
		$whitelist = false;
		if(in_array($this->_loginuser, config_item('whitelist'))) {
			$whitelist = true;
		}
		$this->data['whitelist'] = $whitelist;
		$this->data['users'] = $users;
		$this->data['AREAS'] = $AREAS;
		$this->load->view('user/index', $this->data);
	}
	
	function add() {
		if($_POST) {
			$doctorid = $this->input->post('doctorid');
			$data = array(
				'mobile' => $this->input->post('mobile'),
				'password' => $this->input->post('password'),
				'username' => $this->input->post('username')
			);
			$result = 0;
			$user = $this->user_model->get_by_mobile($data['mobile']);
			if($user) {
				$result = -1;
			} else {
				// $data['password'] = nn_password($data['password']);
				$result = $this->user_model->add($data);
				$relation = array(
					'userid' => $result,
					'doctorid' => $doctorid,
					'chatopen' => 1,
					'healthopen' => 1,
					'bindway' => 'RECORDER_ADD'
				);
				$this->relation_model->add($relation);
				$this->doctor_model->receive_money($doctorid, 20, 'RELATION');
			}
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			$recorder = $this->recorder_model->get_by_id($this->_loginuser);
			$doctors = $this->doctor_model->get_by_masterid($recorder['masterid']);
			$this->data['doctors'] = $doctors;
			$this->load->view('user/add', $this->data);
		}
	}
	
	function history($userid = 0) {
		global $AREAS;
		if(!$userid) exit('参数有误！');
		$user = $this->user_model->get_by_id($userid);
		$this->data['AREAS'] = $AREAS;
		$this->data['user'] = $user;
		
		$sugar_records = $this->recordsugar_model->get_by_userid($userid, $this->_loginuser);
		$pressure_records = $this->recordpressure_model->get_by_userid($userid, $this->_loginuser);
		$food_records = $this->recordfood_model->get_by_userid($userid, $this->_loginuser);
		$drug_records = $this->recorddrug_model->get_by_userid($userid, $this->_loginuser);
		$visit_records = $this->recordvisit_model->get_by_userid($userid, $this->_loginuser);
		$protein_records = $this->recordprotein_model->get_by_userid($userid, $this->_loginuser);
		$bmi_records = $this->recordbmi_model->get_by_userid($userid, $this->_loginuser);
		$whr_records = $this->recordwhr_model->get_by_userid($userid, $this->_loginuser);
		$this->data['sugar_records'] = $sugar_records;
		$this->data['pressure_records'] = $pressure_records;
		$this->data['food_records'] = $food_records;
		$this->data['drug_records'] = $drug_records;
		$this->data['protein_records'] = $protein_records;
		$this->data['bmi_records'] = $bmi_records;
		$this->data['whr_records'] = $whr_records;
		$this->data['visit_records'] = $visit_records;
		$this->load->view('user/history', $this->data);
	}


}