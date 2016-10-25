<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('recordbmi_model');
		$this->load->model('recordwhr_model');
		$this->load->model('recordsugar_model');
		$this->load->model('recordpressure_model');
		$this->load->model('recordfood_model');
		$this->load->model('recorddrug_model');
		$this->load->model('recordvisit_model');
		$this->load->model('recordprotein_model');
	}
	
	function create($userid = 0) {
		global $AREAS;
		if(!$userid) exit('参数有误！');
		$user = $this->user_model->get_by_id($userid);
		$this->data['AREAS'] = $AREAS;
		$this->data['user'] = $user;
		$this->load->view('record/create', $this->data);
	}
	
	function save() {
		$record = $this->input->post('record');
		$userid = $this->input->post('userid');
		$measuredate = $this->input->post('measuredate');
		$measuretime_hour = $this->input->post('measuretime_hour');
		$measuretime_minute = $this->input->post('measuretime_minute');
		$measuretime = ($measuretime_hour > 9 ? $measuretime_hour : ('0' . $measuretime_hour)) . 
			':' . ($measuretime_minute > 9 ? $measuretime_minute : ('0' . $measuretime_minute));
		$measuretimes = $measuredate . ' ' . $measuretime;
		$measuretime = strtotime($measuretimes);
		$data = array(
			'userid' => $userid,
			'recorder' => $this->_loginuser,
			'measuretime' => $measuretime,
			'measuretimes' => $measuretimes
		);
		$result = -1;
		if($record == 'sugar') {
			$data['type'] = $this->input->post('type');
			$data['sugar'] = $this->input->post('sugar');
			$result = $this->recordsugar_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		} else if($record == 'pressure') {
			$data['high'] = $this->input->post('high');
			$data['low'] = $this->input->post('low');
			$result = $this->recordpressure_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		} else if($record == 'food') {
			$data['photo'] = $this->input->post('photo');
			$data['type'] = $this->input->post('type');
			$data['content'] = $this->input->post('content');
			$result = $this->recordfood_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 5, 'RECORD');
		} else if($record == 'drug') {
			$data['photo'] = $this->input->post('photo');
			$data['type'] = $this->input->post('type');
			$data['content'] = $this->input->post('content');
			$result = $this->recorddrug_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 5, 'RECORD');
		} else if($record == 'visit') {
			$data['photo'] = $this->input->post('photo');
			$data['type'] = $this->input->post('type');
			$data['content'] = $this->input->post('content');
			$result = $this->recordvisit_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 5, 'RECORD');
		} else if($record == 'bmi') {
			$data['height'] = $this->input->post('height');
			$data['weight'] = $this->input->post('weight');
			$data['bmi'] = round($data['weight'] / $data['height'] / $data['height'] * 10000, 1);
			$result = $this->recordbmi_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		} else if($record == 'whr') {
			$data['waist'] = $this->input->post('waist');
			$data['hip'] = $this->input->post('hip');
			$data['whr'] = round($data['waist'] / $data['hip'] * 100, 1);
			$result = $this->recordwhr_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		} else if($record == 'protein') {
			$data['protein'] = $this->input->post('protein');
			$result = $this->recordprotein_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
}