<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	protected $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->model('recordbox_model');
		$this->load->model('box_model');
		$this->load->model('user_model');
	}
	
	function record() {
		$sn = $this->input->get('sn');
		$time = $this->input->get('time');
		$sugar = $this->input->get('sugar');
		$token = $this->input->get('token');
		$test = $this->input->get('test');
		$tmpArr = array($sn, $time, $sugar);
		$tmpStr = implode( $tmpArr );
		// echo $tmpStr;
		$tmpStr = sha1( $tmpStr );
		// echo $tmpStr;
		$result = 'error';
		if( $tmpStr == $token ) {
			$userid = 0;
			$box = $this->box_model->get_by_sn($sn);
			if($box) {
				$userid = $box['userid'];
			}
			$data = array(
				'userid' => $userid,
				'sn' => $sn,
				'sugar' => $sugar,
				'measuretime' => $time,
				'measuretimes' => date('Y-m-d H:i:s', $time)
			);
			$id = 1;
			if($test != '1') {
				$id = $this->recordbox_model->add($data);
			}
			if($id > 0) {
				$result = 'ok';
			}
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function get_money() {
		$mobile = $this->input->get('mobile');
		$time = $this->input->get('time');
		$token = $this->input->get('token');
		$tmpArr = array($mobile, $time, 'ohmate');
		$tmpStr = implode( $tmpArr );
		// echo $tmpStr;
		$tmpStr = sha1( $tmpStr );
		// echo $tmpStr;
		$result = 'error';
		$money = 0;
		if( $tmpStr == $token ) {
			$user = $this->user_model->get_by_mobile($mobile);
			if($user) {
				$result = 'ok';
				$money = $user['money'];
			}
		}
		$json = array('result' => $result, 'money' => $money);
		echo json_encode($json);
	}
	
	function cost_money() {
		$mobile = $this->input->get('mobile');
		$time = $this->input->get('time');
		$money = $this->input->get('money');
		$token = $this->input->get('token');
		$test = $this->input->get('test');
		$tmpArr = array($mobile, $time, $money, 'ohmate');
		$tmpStr = implode( $tmpArr );
		// echo $tmpStr;
		$tmpStr = sha1( $tmpStr );
		// echo $tmpStr;
		$result = 'error';
		if( $tmpStr == $token ) {
			$user = $this->user_model->get_by_mobile($mobile);
			if($user) {
				$this->user_model->cost_money($user['id'], $money, 'OHMATE_BUY');
				$result = 'ok';
			}
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function receive_money() {
		$mobile = $this->input->get('mobile');
		$time = $this->input->get('time');
		$money = $this->input->get('money');
		$token = $this->input->get('token');
		$test = $this->input->get('test');
		$tmpArr = array($mobile, $time, $money, 'ohmate');
		$tmpStr = implode( $tmpArr );
		// echo $tmpStr;
		$tmpStr = sha1( $tmpStr );
		// echo $tmpStr;
		$result = 'error';
		if( $tmpStr == $token ) {
			$user = $this->user_model->get_by_mobile($mobile);
			if($user) {
				$this->user_model->receive_money($user['id'], $money, 'OHMATE_GIFT');
				$result = 'ok';
			}
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}


}