<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Box_model extends CI_Model {
	
	private $table;
	private $boxes = array(
		'12817925101',
		'12817925102',
		'12817925103',
		'12817925104',
		'12817925105',
		'12817925106',
		'12817925107',
		'12817925108',
		'12817925109'
	);
	
	function __construct() {
		parent::__construct();
		$this->table = 'box';
	}
	
	public function add($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$data['bindtime'] = $createtime;
		$data['bindtimes'] = $createtimes;
		$data['bindip'] = nn_get_ip();
		$data['status'] = 1;
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_by_sn($sn) {
		$this->db->where("(`sn`='{$sn}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function is_sn_valid($sn) {
		$valid = false;
		for($i = 0; $i < count($this->boxes); $i++) {
			if($sn == $this->boxes[$i]) {
				$valid = true;
				break;
			}
		}
		return $valid;
	}

	public function get_by_userid($userid) {
		$this->db->where("(`userid`='{$userid}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function unbind($userid, $sn) {
		$data = array(
			'status' => -1
		);
		$this->db->where("`userid`='{$userid}' AND `sn`='{$sn}'");
		return $this->db->update($this->table, $data);
		// return true;
	}
	
}