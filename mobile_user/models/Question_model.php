<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'question';
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
	
	public function get_all_page($page, $per) {
		$start = ($page - 1) * $per;
		$this->db->where("`status`='1' AND `answers`>'0'")->order_by('createtime', 'DESC')->limit($per, $start);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function search($title, $type, $userid) {
		$title = nn_sql_escape($title);
		if($type == 'all') {
			$this->db->where("(`title` like '%{$title}%' OR `content` like '%{$title}%') AND `answers`>'0' AND `status`='1'");
		} else {
			$this->db->where("(`title` like '%{$title}%' OR `content` like '%{$title}%') AND `userid`='{$userid}' AND `status`='1'");
		}
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_by_id($id) {
		$this->db->where("`id`='{$id}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_by_userid($userid) {
		$this->db->where("`userid`='{$userid}' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
}