<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('chat_model');
		$this->load->model('doctor_model');
		$this->load->model('scorelog_model');
	}
	
	function index() {
		$chats = $this->chat_model->get_chats($this->_loginuser);
		// luiji_log(__FILE__, __LINE__, count($chats), 'debug');
		$chats1 = array();
		$chats2 = array();
		for($i = 0; $i < count($chats); $i++) {
			if($chats[$i]['readtime'] || $chats[$i]['from'] == 'doctor') {
				$chats2[] = $chats[$i];
			} else {
				$chats1[] = $chats[$i];
			}
		}
		$this->data['chats1'] = $chats1;
		$this->data['chats2'] = $chats2;
		$this->load->view('chat/index', $this->data);
	}
	
	function user($id) {
		$user = $this->user_model->get_relation($this->_loginuser, $id);
		$this->data['user'] = $user;
		$this->data['userid'] = $id;
		$this->load->view('chat/user', $this->data);
	}
	
	function send() {
		$data = array(
			'userid' => $this->input->post('userid'),
			'doctorid' => $this->input->post('doctorid'),
			'from' => $this->input->post('from'),
			'content' => $this->input->post('content')
		);
		$last_message = $this->chat_model->get_doctor_last_message($data['userid'], $data['doctorid']);
		// luiji_log(__FILE__, __LINE__, 'last_message => ' . $last_message['createtimes'], 'debug');
		if(date('Y-m-d', $last_message['createtime']) != date('Y-m-d', $this->_timestamp)) {
			// luiji_log(__FILE__, __LINE__, 'last_message 不是今天发的', 'debug');
			$start = date('Y-m-01 00:00:00', $this->_timestamp);
			// luiji_log(__FILE__, __LINE__, 'start ' . $start, 'debug');
			$start = strtotime($start) - 1;
			// luiji_log(__FILE__, __LINE__, 'start ' . $start, 'debug');
			// $scorelogs = $this->scorelog_model->get_chat_by_doctorid_and_time($data['doctorid'], $start);
			$scorelogs = $this->scorelog_model->get_chat_by_doctorid_and_userid_and_time($data['doctorid'], $data['userid'], $start);
			// luiji_log(__FILE__, __LINE__, '本月已加分 ' . count($scorelogs) . ' 次', 'debug');
			if(count($scorelogs) < 4) {
				// 2016-08-25 => 取消医生对话获得积分
				$this->doctor_model->receive_money($data['doctorid'], 5, 'CHAT');
				// $this->doctor_model->receive_money($data['doctorid'], 0, 'CHAT');
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