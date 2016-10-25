<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notice_model extends CI_Model
{
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'notice';

	}
	
	public function add($data) {
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$data['createtime'] = $createtime;
		$data['createtimes'] = $createtimes;
		$data['createip'] =  $_SERVER["REMOTE_ADDR"];
		$data['status'] = 1;
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_allpages_number() {
		$this->db->select( ' id ');
		$this->db->where(' status = 1 ');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_allpages( $page_now , $num ){
		$page_now =  ($page_now - 1) * $num  ;
		$this->db->limit($num,$page_now);
		$this->db->where(' status = 1 ');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_by_kind($value,$kind) {
		$this->db->where(" `".$kind."` ='{$value}'");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function to_update($id , $users){
		$this->db->where("`id`='{$id}'");
		$result = $this->db->update($this->table , $users) ;
		return $result;
	}
	
	public function del ($id) {
		$this->db->where("`id` = '{$id}' ") ;
		$result = $this->db->delete($this->table) ;
		return $result;
	}
	
	
	
}