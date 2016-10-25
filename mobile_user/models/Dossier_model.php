<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Dossier_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'dossier';
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
	
	public function get_my_page($userid, $page, $per) {
		$start = ($page - 1) * $per;
		$this->db->where("`userid`='{$userid}' AND `status`='1'")->order_by('createtime', 'DESC')->limit($start, $per);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_by_id($id) {
		$this->db->where("`id`='{$id}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
}