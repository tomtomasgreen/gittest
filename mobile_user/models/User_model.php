<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'user';
		$this->table_scorelog = 'scorelog';
	}
	
	public function add($data) {
		$check = $this->get_by_mobile_or_email($data['mobile']);
		if(empty($check)){
			$mobile = $data['mobile'];
			$type = nn_is_mobile_or_email($data['mobile']);
			$data['mobile'] = '';
			$data[$type] = $mobile;
			$data['password'] = nn_password($data['password']);
			$createtime = time();
			$createtimes = date('Y-m-d H:i:s', $createtime);
			$data['createtime'] = $createtime;
			$data['createtimes'] = $createtimes;
			$data['createip'] = nn_get_ip();
			$data['score'] = 0;
			$data['money'] = 0;
			$data['status'] = 1;
			$this->db->insert($this->table, $data);
			$userid = $this->db->insert_id();
			// $this->scorelog($userid, 0, 'INCREASE', 'REGISTER');
			return $userid;
		} else {
			return -1;
		}
	}
	
	public function check_login($mobile, $password) {
		$this->db->where("(`mobile`='{$mobile}' OR `email`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		$user = $query->row_array();
		if($user) {
			if(nn_check_password($password, $user['password'])) {
				return $user;
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
		$this->db->where("`mobile`='{$mobile}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_by_email($email) {
		
	}













	public function get_by_mobile_or_email($mobile) {
		$this->db->where("(`mobile`='{$mobile}' OR `email`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function editpwd($userid, $oldpassword, $password) {
		$_oldpassword = $this->get_by_id($userid);
		$_oldpassword = $_oldpassword['password'];
		if(nn_check_password($oldpassword, $_oldpassword)) {
			$data['password'] = nn_password($password);
			$this->db->where('id', $userid);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
		} else {
			return -1;
		}
	}

	public function update_by_id($userid, $data) {
		$this->db->where('id', $userid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	public function update_pasword_reset($data) {
		$data['password'] = nn_password($data['password']);
		$this->db->where('mobile', $data['mobile']);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	public function scorelog($userid, $money, $type, $way) {
		$data = array(
			'userid' => $userid,
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
	
	public function receive_money($userid, $money, $way) {
		$this->db->set('money', 'money+' . $money, false);
		$this->db->set('score', 'score+' . $money, false);
		$this->db->where('id', $userid);
		$this->db->update($this->table);
		$this->scorelog($userid, $money, 'INCREASE', $way);
		return $this->db->affected_rows();
	}
	
	public function cost_money($userid, $money, $way) {
		$this->db->set('money', 'money-' . $money, false);
		$this->db->where('id', $userid);
		$this->db->update($this->table);
		$this->scorelog($userid, $money, 'DECREASE', $way);
		return $this->db->affected_rows();
	}
}