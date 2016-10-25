<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	
	private $table, $table_relation;
	
	function __construct() {
		parent::__construct();
		$this->table = 'user';
		$this->table_relation = 'relation';
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
			$data['status'] = 1;
			$this->db->insert($this->table, $data);
			return $this->db->insert_id();
		} else {
			return -1;
		}
	}
	
	public function check_login($mobile, $password) {
		$password = nn_password($password);
		$this->db->where("(`mobile`='{$mobile}' OR `email`='{$mobile}') AND `password`='{$password}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_by_id($id) {
		$this->db->where("(`id`='{$id}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_by_doctorid($doctorid) {
		$this->db->select('user.*,relation.username as uname,relation.userphoto,relation.createtime as bindtime');
		$this->db->from('user');
		$this->db->join('relation', 'relation.userid = user.id');
		$this->db->where("relation.doctorid='{$doctorid}' AND relation.status='1'");
		$this->db->order_by('relation.createtime', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_unaccepted_by_doctorid($doctorid) {
		$this->db->select('user.*,relation.username as uname,relation.userphoto,relation.createtime as bindtime');
		$this->db->from('user');
		$this->db->join('relation', 'relation.userid = user.id');
		$this->db->where("relation.doctorid='{$doctorid}' AND relation.status='-3'");
		$this->db->order_by('relation.createtime', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_unchecked_by_doctorid($doctorid) {
		$this->db->select('user.*,relation.username as uname,relation.userphoto,relation.createtime as bindtime');
		$this->db->from('user');
		$this->db->join('relation', 'relation.userid = user.id');
		$this->db->where("relation.doctorid='{$doctorid}' AND relation.status='0'");
		$this->db->order_by('relation.createtime', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_relation($doctorid, $userid) {
		$this->db->select('user.*,relation.username as uname,relation.userphoto,relation.healthopen,relation.chatopen,relation.createtime as bindtime');
		$this->db->from('user');
		$this->db->join('relation', 'relation.userid = user.id');
		$this->db->where("relation.doctorid='{$doctorid}' AND relation.userid='{$userid}' AND relation.status='1'");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_by_mobile_or_email($mobile) {
		$this->db->where("(`mobile`='{$mobile}' OR `email`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function editpwd($userid, $oldpassword, $password) {
		$_oldpassword = $this->get_by_id($userid);
		$_oldpassword = $_oldpassword['password'];
		if($_oldpassword == nn_password($oldpassword)) {
			$data['password'] = nn_password($password);
			$this->db->where('id', $userid);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
		} else {
			return -1;
		}
	}
	
	
	
}