<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Relation_model extends CI_Model {
	
	private $table, $table_relation;
	
	function __construct() {
		parent::__construct();
		$this->table = 'relation';
	}
	
	public function add($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$data['createtime'] = $createtime;
		$data['createtimes'] = $createtimes;
		$data['createip'] = nn_get_ip();
		$data['status'] = 0;
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function unbind($userid, $doctorid) {
		$data = array(
			'status' => -1
		);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}'");
		return $this->db->update($this->table, $data);
	}

	public function healthopen($userid, $doctorid, $_healthopen) {
		$data = array(
			'healthopen' => ($_healthopen == 'true') ? '1' : '0'
		);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `status`='1'");
		return $this->db->update($this->table, $data);
	}

	public function get_by_doctorid_and_userid($doctorid, $userid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `userid`='{$userid}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_by_userid($doctorid, $userid) {
		$this->db->where("`userid`='{$userid}' AND (`status`='1' OR `status`='0' OR `status`='-3')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_unchecked_by_doctorid_and_userid($doctorid, $userid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `userid`='{$userid}' AND `status`='0'");
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_unaccepted_by_doctorid_and_userid($doctorid, $userid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `userid`='{$userid}' AND `status`='-3'");
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function is_bind_before($userid, $doctorid) {
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `status`='-1'");
		$query = $this->db->get($this->table);
		return $query->row_array() ? true : false;
	}
	
	public function update_uname_by_userid_and_doctorid($uname, $userid, $doctorid) {
		$data = array(
			'username' => $uname
		);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `status`='1'");
		return $this->db->update($this->table, $data);
	}

	public function bind_accept($userid, $doctorid) {
		$data = array(
			'status' => 1
		);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `status`='-3'");
		return $this->db->update($this->table, $data);
	}

	public function bind_unaccept($userid, $doctorid) {
		$data = array(
			'status' => -4
		);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `status`='-3'");
		return $this->db->update($this->table, $data);
	}
	
}