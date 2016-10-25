<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Recorddrug_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'record_drug';
	}

	public function get_by_id($id) {
		
	}

	public function get_by_userid($userid) {
		$this->db->where("`userid`='{$userid}' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_by_userid_and_time($userid, $start, $end) {
		
	}
	
}