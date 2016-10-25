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
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='user' AND `createtime`>'{$start}' AND `status`='1'")->order_by('createtime', 'ASC');
		$this->db->update($this->table, $data);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='user' AND `createtime`>'{$start}' AND `status`='1'")->order_by('createtime', 'ASC');
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
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='user' AND `status`='1'")->order_by('createtime', 'DESC')->limit($limit);
		$this->db->update($this->table, $data);
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `status`='1'")->order_by('createtime', 'DESC')->limit($limit);
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	function get_doctor_last_message($userid, $doctorid) {
		$this->db->where("`userid`='{$userid}' AND `doctorid`='{$doctorid}' AND `from`='doctor' AND `status`='1'")->order_by('createtime', 'DESC')->limit(1);
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function get_chats($doctorid) {
		$sql = "select c2.*,r.username,u.thumb from (select c1.* from (select * from gh_chat where doctorid={$doctorid} and `status`='1' order by createtime desc) as c1 group by userid) as c2 join gh_relation as r join gh_user as u on (c2.userid=r.userid and c2.doctorid=r.doctorid and c2.userid=u.id) where r.`status`=1 and u.`status`=1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
}