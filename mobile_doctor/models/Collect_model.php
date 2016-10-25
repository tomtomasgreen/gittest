<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Collect_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'collect';
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
	
	public function get_not_finished($doctorid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `submittime`='0' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_lastest_collect($doctorid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `submittime`>'0' AND `status`='1'")->order_by('createtime', 'DESC')->limit(1);
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_history_collects($doctorid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `submittime`>'0' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_invalid_collects($doctorid) {
		$this->db->where("`doctorid`='{$doctorid}' AND `status`='-1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_collects_year($doctorid, $now) {
		$start = $now - 60 * 60 * 24 * 365;
		$this->db->where("`doctorid`='{$doctorid}' AND `submittime`>'0' AND `createtime`>'{$start}' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_by_id($id) {
		$this->db->where("`id`='{$id}' AND `status`='1'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	function submit_collect($collelctid) {
		$submittime = time();
		$submittimes = date('Y-m-d H:i:s', $submittime);
		$data['submittime'] = $submittime;
		$data['submittimes'] = $submittimes;
		$data['submitip'] = nn_get_ip();
		$this->db->where('id', $collelctid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	function sn_collect($collelctid) {
		$sn1 = date('Ym', time());
		$sn1 = substr($sn1, 2);
		$sn2 = $collelctid;
		if($sn2 < 10) $sn2 = '000000' . $sn2;
		else if($sn2 < 100) $sn2 = '00000' . $sn2;
		else if($sn2 < 1000) $sn2 = '0000' . $sn2;
		else if($sn2 < 10000) $sn2 = '000' . $sn2;
		else if($sn2 < 100000) $sn2 = '00' . $sn2;
		else if($sn2 < 1000000) $sn2 = '0' . $sn2;
		$data = array(
			'sn' => $sn1 . $sn2
		);
		$this->db->where('id', $collelctid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
	function invalid_collect($collectid) {
		$data = array(
			'status' => -1
		);
		$this->db->where('id', $collectid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
}