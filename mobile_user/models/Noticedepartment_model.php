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

	public function get_unread($departmentid, $userid) {
		$this->db->where("`departmentid`='{$departmentid}' AND `userid`='{$userid}' AND `readtime`='0' AND `type`='user' AND `status`='1'");
		$this->db->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function read_unread($departmentid, $userid) {
		$readtime = time();
		$readtimes = date('Y-m-d H:i:s', $readtime);
		$readip = nn_get_ip();
		$data = array(
			'readtime' => $readtime,
			'readtimes' => $readtimes,
			'readip' => $readip
		);
		$this->db->where("`departmentid`='{$departmentid}' AND `userid`='{$userid}' AND `readtime`='0' AND `type`='user' AND `status`='1'");
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function get_read($departmentid, $userid) {
		$this->db->where("`departmentid`='{$departmentid}' AND `userid`='{$userid}' AND `readtime`>'0' AND `type`='user' AND `status`='1'");
		$this->db->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	
}