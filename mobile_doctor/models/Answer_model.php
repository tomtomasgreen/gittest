<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'answer';
		$this->table_question = 'question';
	}
	
	public function add_collect($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$ip = nn_get_ip();
		$ids = array();
		for($i = 0; $i < count($data); $i++) {
			$data[$i]['createtime'] = $createtime;
			$data[$i]['createtimes'] = $createtimes;
			$data[$i]['createip'] = $ip;
			$data[$i]['status'] = 1;
			$ids[$i] = $data[$i]['questionid'];
		}
		$this->db->insert_batch($this->table, $data);
		$this->db->set('answers', 'answers+1', false);
		$this->db->where_in('id', $ids);
		$this->db->update($this->table_question);
		return $this->db->affected_rows();;
	}
	
}