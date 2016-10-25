<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Noticedepartment_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'notice_department';
	}
	
	public function add($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		for($i = 0; $i < count($data); $i++) {
			$data[$i]['createtime'] = $createtime;
			$data[$i]['createtimes'] = $createtimes;
			$data[$i]['createip'] = nn_get_ip();
			$data[$i]['status'] = 1;
		}
		$this->db->insert_batch($this->table, $data);
		return 1;
	}

	public function get_all($type, $departmentid) {
		$this->db->where("`departmentid`='{$departmentid}' AND `type`='{$type}' AND `status`='1'");
		$this->db->group_by('createtime');
		$this->db->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function del($createtime, $departmentid, $type) {
		$data = array(
			'status' => -1
		);
		$this->db->where("`departmentid`='{$departmentid}' AND `createtime`='{$createtime}' AND `type`='{$type}' AND `status`='1'");
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	
}