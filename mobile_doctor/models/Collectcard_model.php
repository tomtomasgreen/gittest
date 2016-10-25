<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Collectcard_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'collect_card';
	}
	
	public function add($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$ip = nn_get_ip();
		$data['createtime'] = $createtime;
		$data['createtimes'] = $createtimes;
		$data['createip'] = nn_get_ip();
		$data['status'] = 1;
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_doctorid($doctorid, $status = 'notused') {
		$where = "`doctorid`='{$doctorid}' AND `status`='1' AND `usedtime`='0'";
		if($status == 'used') {
			$where = "`doctorid`='{$doctorid}' AND `status`='1' AND `usedtime`>'0'";
		}
		$this->db->where($where);
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_by_doctorid_gift($doctorid) {
		$where = "`doctorid`='{$doctorid}' AND `status`='1'";
		$this->db->where($where)->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function use_card($id) {
		$usedtime = time();
		$usedtimes = date('Y-m-d H:i:s', $usedtime);
		$usedip = nn_get_ip();
		$data = array(
			'usedtime' => $usedtime,
			'usedtimes' => $usedtimes,
			'usedip' => $usedip
		);
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	function sn($cardid) {
		$sn1 = date('Ym', time());
		$sn1 = substr($sn1, 2);
		$sn2 = $cardid;
		if($sn2 < 10) $sn2 = '000000' . $sn2;
		else if($sn2 < 100) $sn2 = '00000' . $sn2;
		else if($sn2 < 1000) $sn2 = '0000' . $sn2;
		else if($sn2 < 10000) $sn2 = '000' . $sn2;
		else if($sn2 < 100000) $sn2 = '00' . $sn2;
		else if($sn2 < 1000000) $sn2 = '0' . $sn2;
		$data = array(
			'sn' => 'A' . $sn1 . $sn2
		);
		$this->db->where('id', $cardid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	
	
}