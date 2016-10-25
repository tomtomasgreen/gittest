<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Scorelog_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'scorelog';
	}

	public function get_by_userid($userid) {
		$this->db->where("`userid`='{$userid}' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_chat_by_userid_and_time($userid, $start) {
		$this->db->where("`userid`='{$userid}' AND `way`='CHAT' AND `status`='1' AND `createtime` > {$start}")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_record_by_userid_and_time($userid, $start, $way) {
		$this->db->where("`userid`='{$userid}' AND `way`='RECORD_{$way}' AND `status`='1' AND `createtime` > {$start}")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
}