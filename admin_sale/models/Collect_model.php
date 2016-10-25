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

	public function select($sn){
		return $this->db->where(" sn = {$sn} AND submittime != 0 ")->get('collect')->result_array();
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
	
	public function question_details( $sn ){
		$this->db->select( '  question.content as question ,  collect_answer.content as answer ');
		$this->db->where(' collect_answer.status = 1 ');
		$this->db->from( 'collect_answer' );
		$this->db->join('collect', ' collect.id = collect_answer.collectid and collect.status = 1  ' );
		$this->db->join('question', ' question.id = collect_answer.questionid and question.status = 1 ' );
		$this->db->where('collect.sn',$sn);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	
}