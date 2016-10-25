<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('chat_model');
		$this->load->model('relation_model');
	}
	
	function index() {
		$doctor_unaccepted = $this->doctor_model->get_unaccepted_by_userid($this->_loginuser);
		$doctor = $this->doctor_model->get_by_userid($this->_loginuser);
		$doctor_unchecked = $this->doctor_model->get_unchecked_by_userid($this->_loginuser);
		$chats = $this->chat_model->get_user_unread($this->_loginuser, $doctor['id']);
		$this->data['chats'] = $chats;
		$this->data['doctor'] = $doctor;
		$this->data['doctor_unchecked'] = $doctor_unchecked;
		$this->data['doctor_unaccepted'] = $doctor_unaccepted;
		$this->load->view('doctor/index', $this->data);
	}
	
	function get_chat() {
		$doctorid = $this->input->post('doctorid');
		$chats = $this->chat_model->get_user_unread($this->_loginuser, $doctorid);
		$json = array('result' => count($chats));
		echo json_encode($json);
	}
	
	function add() {
		$this->load->view('doctor/add', $this->data);
	}
	
	function unbind() {
		$doctorid = $this->input->post('doctorid');
		$result = $this->relation_model->unbind($this->_loginuser, $doctorid);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function cancel() {
		$doctorid = $this->input->post('doctorid');
		$result = $this->relation_model->cancel($this->_loginuser, $doctorid);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	function bind_check() {
		$doctorid = $this->input->post('doctorid');
		$result = $this->relation_model->bind_check($this->_loginuser, $doctorid);
		$is_bind_before = $this->relation_model->is_bind_before($this->_loginuser, $doctorid);
		if(!$is_bind_before) {
			$this->doctor_model->receive_money($doctorid, 20, 'RELATION');
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function bind_uncheck() {
		$doctorid = $this->input->post('doctorid');
		$result = $this->relation_model->bind_uncheck($this->_loginuser, $doctorid);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function healthopen() {
		$doctorid = $this->input->post('doctorid');
		$_healthopen = $this->input->post('healthopen');
		$result = $this->relation_model->healthopen($this->_loginuser, $doctorid, $_healthopen);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function bind() {
		$sn = $this->input->post('sn');
		$id = $sn - config_item('qrcode_start');
		$doctor = $this->doctor_model->get_by_id($id);
		$result = -1;
		if($doctor) {
			$data = array(
				'userid' => $this->_loginuser,
				'doctorid' => $doctor['id'],
				'doctorname' => $this->input->post('doctorname'),
				'doctordes' => $this->input->post('doctordes'),
				'chatopen' => 1,
				'healthopen' => 1,
				'bindway' => 'USER_INPUT_MOBILE'
			);
			$result = $this->relation_model->add($data);
			// $is_bind_before = $this->relation_model->is_bind_before($this->_loginuser, $doctor['id']);
			// if(!$is_bind_before) {
				// $this->doctor_model->receive_money($doctor['id'], 20, 'RELATION');
			// }
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function update_ddes() {
		$ddes = $this->input->post('ddes');
		$doctorid = $this->input->post('doctorid');
		$result = $this->relation_model->update_ddes_by_userid_and_doctorid($ddes, $this->_loginuser, $doctorid);
		$json = array('result' => $result);
		echo json_encode($json);
	}

}