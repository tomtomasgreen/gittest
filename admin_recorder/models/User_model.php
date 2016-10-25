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
		$this->table_recorder = 'recorder';
		$this->table_department = 'department';
		$this->table_relation = 'relation';
	}
	
	public function add($data) {
		$check = $this->get_by_mobile_or_email($data['mobile']);
		if(empty($check)){
			$mobile = $data['mobile'];
			$type = nn_is_mobile_or_email($data['mobile']);
			$data['mobile'] = '';
			$data[$type] = $mobile;
			$data['password'] = nn_password2($data['password']);
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

	public function get_by_mobile_or_email($mobile) {
		$this->db->where("(`mobile`='{$mobile}' OR `email`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_by_mobile($mobile) {
		$this->db->where("`mobile`='{$mobile}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_all_users($recorderid) {
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->join('relation', 'relation.userid = user.id');
		$this->db->join('department', 'relation.doctorid = department.doctorid');
		$this->db->join('recorder', 'recorder.masterid = department.masterid');
		$this->db->where("recorder.id='{$recorderid}' AND relation.status='1' AND recorder.status='1'");
		$this->db->order_by('user.createtime', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_id($id) {
		$this->db->where("(`id`='{$id}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
}