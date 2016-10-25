<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Mission_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'mission';
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

	public function get_valid_by_doctorid($doctorid, $time) {
		$this->db->where("`doctorid`='{$doctorid}' AND `status`='1' AND `missiontime`>'{$time}'")->order_by('missiontime', 'ASC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_by_dcotorid_and_time($doctorid, $start, $end) {
		
	}
	
}