<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'doctor';
		$this->table_scorelog = 'scorelog';
	}
	
	public function add($data) {
		$check = $this->get_by_mobile($data['mobile']);
		if(empty($check)){
			$data['password'] = nn_password($data['password']);
			$createtime = time();
			$createtimes = date('Y-m-d H:i:s', $createtime);
			$data['createtime'] = $createtime;
			$data['createtimes'] = $createtimes;
			$data['createip'] = nn_get_ip();
			$data['score'] = 0;
			$data['money'] = 0;
			$data['status'] = 0;
			$this->db->insert($this->table, $data);
			$doctorid = $this->db->insert_id();
			// $this->scorelog($userid, 0, 'INCREASE', 'REGISTER');
			return $doctorid;
		} else {
			return -1;
		}
	}
	
	public function update_pasword_reset($data) {
		$data['password'] = nn_password($data['password']);
		$this->db->where('mobile', $data['mobile']);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	public function check_login($mobile, $password) {
		
		$this->db->where("(`mobile`='{$mobile}' OR `email`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		$doctor = $query->row_array();
		if($doctor) {
			/*if($mobile == "13661091726" || $mobile == "13471197944"){
				return $doctor;
			}*/
			if(nn_check_password($password, $doctor['password'])) {
				return $doctor;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function get_by_id($id) {
		$this->db->where("(`id`='{$id}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_by_mobile($mobile) {
		$this->db->where("(`mobile`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function editpwd($doctorid, $oldpassword, $password) {
		$_oldpassword = $this->get_by_id($doctorid);
		$_oldpassword = $_oldpassword['password'];
		if(nn_check_password($oldpassword, $_oldpassword)) {
			$data['password'] = nn_password($password);
			$this->db->where('id', $doctorid);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
		} else {
			return -1;
		}
	}

	public function get_department($doctorid) {
		$this->db->select('master.*');
		$this->db->from('master');
		$this->db->join('department', 'department.masterid = master.id');
		$this->db->where("department.doctorid='{$doctorid}' AND department.status='1'");
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function update_by_id($doctorid, $data) {
		$this->db->where('id', $doctorid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	public function scorelog($doctorid, $money, $type, $way) {
		$data = array(
			'doctorid' => $doctorid,
			'score' => $money,
			'type' => $type,
			'way' => $way
		);
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$data['createtime'] = $createtime;
		$data['createtimes'] = $createtimes;
		$data['createip'] = nn_get_ip();
		$data['status'] = 1;
		$this->db->insert($this->table_scorelog, $data);
	}
	
	public function cost_money($doctorid, $money, $way) {
		$this->db->set('money', 'money-' . $money, false);
		$this->db->where('id', $doctorid);
		$this->db->update($this->table);
		$this->scorelog($doctorid, $money, 'DECREASE', $way);
		return $this->db->affected_rows();
	}
	
	public function receive_money($doctorid, $money, $way) {
		$doctor = $this->get_by_id($doctorid);
		$cancel = true;
		if($way == 'CHAT') {
		//add by liweichen 9.23
			if(in_array($doctor['city'], config_item('whitelist_chat_city')) || in_array($doctor['province'], config_item('whitelist_chat_province')) || in_array($doctor['mobile'], config_item('whitelist_chat_doctor'))) {
				$cancel = false;
			}
		} else if($way == 'RELATION') {
			if(!in_array($doctor['province'], config_item('blacklist_relation_province')) || in_array($doctor['mobile'], config_item('whitelist_relation_doctor'))) {
				$cancel = false;
			}
		}
		if($cancel) {
			return 1;
		} else {
			$this->db->set('money', 'money+' . $money, false);
			$this->db->set('score', 'score+' . $money, false);
			$this->db->where('id', $doctorid);
			$this->db->update($this->table);
			$this->scorelog($doctorid, $money, 'INCREASE', $way);
			return $this->db->affected_rows();
		}
	}
}