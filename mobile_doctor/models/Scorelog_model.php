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

	public function get_by_doctorid($doctorid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_chat_by_doctorid_and_time($doctorid, $start) {
		$this->db->where("`doctorid`='{$doctorid}' AND `way`='CHAT' AND `status`='1' AND `createtime` > {$start}")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_chat_by_doctorid_and_userid_and_time($doctorid, $userid, $start) {
		$this->db->select('scorelog.*');
		$this->db->from('scorelog');
		$this->db->join('chat', 'scorelog.doctorid = chat.doctorid and scorelog.createtime = chat.createtime');
		$this->db->where("scorelog.way='CHAT' AND scorelog.doctorid='{$doctorid}' AND scorelog.createtime>'{$start}' AND chat.from='doctor' and chat.userid='{$userid}'");
		$query = $this->db->get();
		return $query->result_array();
	}
	
}