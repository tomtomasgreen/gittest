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
		$this->table_answer = 'answer';
		$this->table_colelctanswer = 'colelct_answer';
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
		$this->db->where("`status`='1'")->order_by('createtime', 'DESC')->limit($start, $per);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_by_id($id) {
		$this->db->where("`id`='{$id}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_new_questions($doctorid) {
		$query = $this->db->query("select q.id from `gh_question` as q WHERE q.locked = '0' AND q.id not in (select questionid from gh_answer where doctorid = '{$doctorid}')");
		return $query->result_array();
	}
	
}