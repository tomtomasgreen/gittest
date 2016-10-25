<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Recordsugar_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'record_sugar';
	}
	
	public function add($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$data['createtime'] = $createtime;
		$data['createtimes'] = $createtimes;
		$data['createip'] = nn_get_ip();
		$data['status'] = 1;
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_by_id($id) {
		
	}

	public function get_by_userid_and_type_limit($userid, $type, $limit = 20) {
		$this->db->where("`userid`='{$userid}' AND `type`='{$type}' AND `status`='1'")->order_by('createtime', 'ASC')->limit($limit);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_by_userid_and_time($userid, $start, $end) {
		
	}
	
}