<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Recordprotein_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'record_protein';
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

	public function get_by_id($id) {
		
	}

	public function get_by_userid($userid) {
		
	}

	public function get_by_userid_limit($userid, $time_s , $time_e = 'time' ) {
		if($time_s == 'time' && $time_e == 'time'){
			$time_s = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
			$time_e = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}else if( $time_s != 'time' && $time_e == 'time' ){
			$time_e = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}else if( $time_s == 'time' && $time_e != 'time' ){
			$time_s = 0 ;
		}
		$this->db->where( " measuretime > '{$time_s}' and measuretime < '{$time_e}' " );
		$this->db->where("`userid`='{$userid}' AND `status`='1'")->order_by('createtime', 'ASC');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_by_userid_and_time($userid, $start, $end) {
		
	}
	
}