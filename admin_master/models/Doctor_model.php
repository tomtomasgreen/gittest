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
		$this->table_department = 'department';
	}
	
	public function bind($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$data['createtime'] = $createtime;
		$data['createtimes'] = $createtimes;
		$data['createip'] = nn_get_ip();
		$data['status'] = 1;
		$this->db->insert($this->table_department, $data);
		return $this->db->insert_id();
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
	
	public function get_by_masterid($masterid) {
		$this->db->select('doctor.*,department.doctorname as dname,department.doctorphoto,department.doctordes,department.createtime as bindtime');
		$this->db->from('doctor');
		$this->db->join('department', 'department.doctorid = doctor.id ');
		$this->db->where("department.masterid='{$masterid}'");
		$this->db->where("department.status= 1 ");
		$this->db->order_by('department.createtime', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_mobile_or_email($mobile) {
		$this->db->where("(`mobile`='{$mobile}' OR `email`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_by_mobile($mobile) {
		$this->db->where("(`mobile`='{$mobile}') AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_department_by_doctorid($doctorid) {
		$this->db->where("(`doctorid`='{$doctorid}') AND `status`='1'");
		$query = $this->db->get($this->table_department);
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
	
	public function del($id){
		// var_dump($id);exit;
		$del['status'] = -1 ;
		$this->db->where('doctorid', $id );
		$this->db->update('department', $del);
	}
	
	
	
	
	
}