<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'department';
	}
	
	function get_mates_by_masterid($masterid) {
		$this->db->select('doctor.*');
		$this->db->from('doctor');
		$this->db->join('department', 'department.doctorid = doctor.id');
		$this->db->where("department.masterid='{$masterid}' AND department.status='1'");
		$query = $this->db->get();
		return $query->result_array();
	}
	
}