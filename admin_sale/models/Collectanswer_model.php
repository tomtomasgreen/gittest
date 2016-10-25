<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Collectanswer_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'collect_answer';
		$this->table_question = 'question';
	}
	
	public function add_collect($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$ip = nn_get_ip();
		for($i = 0; $i < count($data); $i++) {
			$data[$i]['createtime'] = $createtime;
			$data[$i]['createtimes'] = $createtimes;
			$data[$i]['createip'] = $ip;
			$data[$i]['status'] = 1;
		}
		$this->db->insert_batch($this->table, $data);
		return 1;
	}
	
	public function get_not_finished($doctorid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `submittime`='0' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_by_collectid($collectid) {
		$query = $this->db->query("select q.title,q.id as qid,q.photos,q.content,a.content as answer,a.id from gh_question as q join gh_collect_answer as a on (q.id=a.questionid) where a.collectid='{$collectid}' order by a.id asc");
		return $query->result_array();
	}
	
	public function update_by_id($id, $data) {
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	
	
}