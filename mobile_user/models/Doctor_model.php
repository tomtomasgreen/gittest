<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {
	
	private $table, $table_relation;
	
	function __construct() {
		parent::__construct();
		$this->table = 'doctor';
		$this->table_relation = 'relation';
		$this->table_scorelog = 'scorelog';
	}

	public function get_by_userid($userid) {
		$this->db->select('doctor.*,relation.id as rid,relation.doctorname as dname,relation.doctordes as ddes,relation.doctorphoto,relation.chatopen,relation.healthopen,relation.createtime as bindtime');
		$this->db->from('doctor');
		$this->db->join('relation', 'relation.doctorid = doctor.id');
		$this->db->where("relation.userid='{$userid}' AND relation.status='1'");
		$this->db->order_by('relation.createtime', 'DESC');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_department($doctorid) {
		$this->db->select('master.*');
		$this->db->from('master');
		$this->db->join('department', 'department.masterid = master.id');
		$this->db->where("department.doctorid='{$doctorid}' AND department.status='1'");
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_unaccepted_by_userid($userid) {
		$this->db->select('doctor.*,relation.id as rid,relation.doctorname as dname,relation.doctordes as ddes,relation.doctorphoto,relation.chatopen,relation.healthopen,relation.createtime as bindtime');
		$this->db->from('doctor');
		$this->db->join('relation', 'relation.doctorid = doctor.id');
		$this->db->where("relation.userid='{$userid}' AND relation.status='-3'");
		$this->db->order_by('relation.createtime', 'DESC');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_unchecked_by_userid($userid) {
		$this->db->select('doctor.*,relation.id as rid,relation.doctorname as dname,relation.doctordes as ddes,relation.doctorphoto,relation.chatopen,relation.healthopen,relation.createtime as bindtime');
		$this->db->from('doctor');
		$this->db->join('relation', 'relation.doctorid = doctor.id');
		$this->db->where("relation.userid='{$userid}' AND relation.status='0'");
		$this->db->order_by('relation.createtime', 'DESC');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_by_mobile($mobile) {
		$this->db->where("(`mobile`='{$mobile}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}

	public function get_by_id($id) {
		$this->db->where("(`id`='{$id}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function scorelog($doctorid, $money, $type, $way) {
		$data = array(
			'doctorid' => $doctorid,
			'score' => $money,
			'type' => $type,
			'way' => $way
		);
		$createtime = time();
		$createtimes = date('Y-m-d H:i:s', $createtime);
		$data['createtime'] = $createtime;
		$data['createtimes'] = $createtimes;
		$data['createip'] = nn_get_ip();
		$data['status'] = 1;
		$this->db->insert($this->table_scorelog, $data);
	}
	
	public function receive_money($doctorid, $money, $way) {
		$doctor = $this->get_by_id($doctorid);
		$cancel = true;
		if($way == 'RELATION') {
			if(!in_array($doctor['province'], config_item('blacklist_relation_province')) || in_array($doctor['mobile'], config_item('whitelist_relation_doctor'))) {
				$cancel = false;
			}
		}
		if($cancel) {
			return 1;
		} else {
			$this->db->set('money', 'money+' . $money, false);
			$this->db->set('score', 'score+' . $money, false);
			$this->db->where('id', $doctorid);
			$this->db->update($this->table);
			$this->scorelog($doctorid, $money, 'INCREASE', $way);
			return $this->db->affected_rows();
		}
	}
	
}