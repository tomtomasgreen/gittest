<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Giftbuy_model extends CI_Model {
	
	private $table;
	
	function __construct() {
		parent::__construct();
		$this->table = 'gift_doctor_buy';
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
	
	public function get_by_doctorid($doctorid) {
		$this->db->select('gift_doctor_buy.*,gift_doctor.title,gift_doctor.thumb');
		$this->db->from('gift_doctor_buy');
		$this->db->join('gift_doctor', 'gift_doctor_buy.giftid = gift_doctor.id');
		$this->db->where("gift_doctor_buy.doctorid='{$doctorid}' AND gift_doctor_buy.status='1'");
		$this->db->order_by('gift_doctor_buy.createtime', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function sn($cardid) {
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
			'sn' => 'C' . $sn1 . $sn2
		);
		$this->db->where('id', $cardid);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
	
}