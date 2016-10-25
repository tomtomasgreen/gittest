<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Relation_model extends CI_Model {
	
	private $table, $table_relation;
	
	function __construct() {
		parent::__construct();
		$this->table = 'relation';
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
	
}