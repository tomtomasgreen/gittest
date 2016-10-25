<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'chat';
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
	
	public function get_reply_since($userid, $doctorid, $start) {
		$readtime = time();
		$readtimes = date('Y-m-d H:i:s', $readtime);
		$data = array(
			'readtime' => $readtime,
			'readtimes' => $readtimes,
			'readip' => nn_get_ip()
		);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='doctor' AND `createtime`>'{$start}' AND `status`='1'")->order_by('createtime', 'ASC');
		$this->db->update($this->table, $data);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='doctor' AND `createtime`>'{$start}' AND `status`='1'")->order_by('createtime', 'ASC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	function get_lastest_message($userid, $doctorid, $limit) {
		$readtime = time();
		$readtimes = date('Y-m-d H:i:s', $readtime);
		$data = array(
			'readtime' => $readtime,
			'readtimes' => $readtimes,
			'readip' => nn_get_ip()
		);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='doctor' AND `status`='1'")->order_by('createtime', 'DESC')->limit($limit);
		$this->db->update($this->table, $data);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}'")->order_by('createtime', 'DESC')->limit($limit);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	function get_user_last_message($userid, $doctorid) {
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='user' AND `status`='1'")->order_by('createtime', 'DESC')->limit(1);
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	function get_user_unread($userid, $doctorid) {
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='doctor' AND `readtime`='0' AND `status`='1'")->order_by('createtime', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
}