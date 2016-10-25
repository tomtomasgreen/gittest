<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'calendar';
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

	public function get_by_doctorid_and_time($doctorid, $weekstart) {
		$this->db->where("`doctorid`='{$doctorid}' AND `status`='1' AND `weekstart`='{$weekstart}'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function update($data) {
		$doctorid = $data['doctorid'];
		$weekstart = $data['weekstart'];
		$calendar = $this->get_by_doctorid_and_time($doctorid, $weekstart);
		if($calendar) {
			$this->db->where('id', $calendar['id']);
			$this->db->update($this->table, $data);
			return $this->db->affected_rows();
		} else {
			return $this->add($data);
		}
	}

	
}