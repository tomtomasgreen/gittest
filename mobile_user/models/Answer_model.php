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
	}
	
	public function get_by_questionid($questionid) {
		$this->db->where("`questionid`='{$questionid}' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
}