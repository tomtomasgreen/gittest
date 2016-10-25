<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('chat_model');
		$this->load->model('user_model');
		$this->load->model('scorelog_model');
	}
	
	function index() {
		$this->load->view('chat/index', $this->data);
	}
	
	function doctor($doctorid = 0) {
		$this->data['doctorid'] = $doctorid;
		$this->load->view('chat/doctor', $this->data);
	}
	
	function send() {
		$data = array(
			'userid' => $this->input->post('userid'),
			'doctorid' => $this->input->post('doctorid'),
			'from' => $this->input->post('from'),
			'content' => $this->input->post('content')
		);
		$last_message = $this->chat_model->get_user_last_message($data['userid'], $data['doctorid']);
		// luiji_log(__FILE__, __LINE__, 'last_message => ' . $last_message['createtimes'], 'debug');
		if(date('Y-m-d', $last_message['createtime']) != date('Y-m-d', $this->_timestamp)) {
			// luiji_log(__FILE__, __LINE__, 'last_message 不是今天发的', 'debug');
			$start = date('Y-m-d 00:00:00', $this->_timestamp);
			// luiji_log(__FILE__, __LINE__, 'start ' . $start, 'debug');
			$start = strtotime($start) - 1;
			// luiji_log(__FILE__, __LINE__, 'start ' . $start, 'debug');
			$scorelogs = $this->scorelog_model->get_chat_by_userid_and_time($data['userid'], $start);
			// luiji_log(__FILE__, __LINE__, '本月已加分 ' . count($scorelogs) . ' 次', 'debug');
			// if(count($scorelogs) < 4) {
			// 调整为一天一次积分
			if(count($scorelogs) < 1) {
				$this->user_model->receive_money($data['userid'], 5, 'CHAT');
			}
		} else {
			// luiji_log(__FILE__, __LINE__, 'last_message 是今天发的', 'debug');
		}
		$result = $this->chat_model->add($data);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function get_reply() {
		$userid = $this->input->post('userid');
		$doctorid = $this->input->post('doctorid');
		$since = $this->input->post('since');
		$result = $this->chat_model->get_reply_since($userid, $doctorid, $since);
		echo json_encode($result);
	}
	
	function get_lastest() {
		$userid = $this->input->post('userid');
		$doctorid = $this->input->post('doctorid');
		$num = $this->input->post('num');
		$result = $this->chat_model->get_lastest_message($userid, $doctorid, $num);
		echo json_encode($result);
	}
	
}