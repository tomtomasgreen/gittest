<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'master';
	}
	
	public function get_by_mobile($mobile) {
		$this->db->where("`mobile`='{$mobile}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_by_id($id) {
		$this->db->where("`id`='{$id}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function editpwd($masterid, $password) {
		$data['password'] = nn_password($password);
		$this->db->where('id', $masterid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
}