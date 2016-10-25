<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Gift_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'gift_user';
	}
	
	public function get_all() {
		$this->db->where("`status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_by_id($giftid) {
		$this->db->where("`id`='{$giftid}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
}