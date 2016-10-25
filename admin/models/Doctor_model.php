<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Doctor_model extends CI_Model
{
	function __construct() {
		parent::__construct();
		$this->table = 'doctor';
		$this->table_collect = 'collect';

	}
	/**
	 * 添加操作
	 */
	public function add($arr)
	{
		$this->db->insert('doctor',$arr);
	}

	/**
	 *  查询操作
	 *  $arr 查询的字段
	 */
	public function select($id,$page_arr = null)
	{
		if($id == 0 | $id == 'all' | $add = ''){
			return $this->db->where(array('status'=>1))->limit(100, 0)->get('doctor',$page_arr[0],$page_arr[1])->result_array();
		}else{
			return $this->db->where(array('id'=>$id))->get('doctor')->result_array();
		}

	}
	
	public function select_page($page)
	{
		$start = ($page - 1) * 30;
		$query = $this->db->where('status', 1)
			->limit(30, $start)
			->get('doctor');
		$result = $query->result_array();
		return $result;
	}
	
	public function get_users_by_doctorid($doctorid) {
		$this->db->select('user.*,relation.username as uname,relation.userphoto,relation.createtime as bindtime');
		$this->db->from('user');
		$this->db->join('relation', 'relation.userid = user.id');
		$this->db->where("relation.doctorid='{$doctorid}' AND relation.status='1'");
		$this->db->order_by('relation.createtime', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function doctors_export() {
		$this->db->select('doctor.id,doctor.username,doctor.mobile,doctor.province,doctor.city,doctor.hospital,doctor.department,doctor.job,doctor.createtime,doctor.money,count(*) as num');
		$this->db->from('doctor');
		$this->db->join('relation', 'relation.doctorid = doctor.id');
		$this->db->where("relation.status='1' AND doctor.status='1'");
		$this->db->group_by('relation.doctorid');
		$this->db->order_by('doctor.id', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * 更该
	 */
	public function edit($id,$arr)
	{
		$this->db->update('doctor',$arr,array('id'=>$id));
	}

	public function del($id)
	{
		$this->db->update('doctor',array('status'=>'0'),array('id'=>$id));
	}

	public function search($where,$page_arr = null)
	{
		// return $this->db->where($where)->get('doctor',$page_arr[0],$page_arr[1])->result_array();
		return $this->db->like($where)->get('doctor',$page_arr[0],$page_arr[1])->result_array();
	}
	
	public function examine(){
		return $this->db->where(array('status'=>0))->get('doctor')->result_array();
	}
	
	public function examine_do($id){
		// var_dump($id);exit;
		$arr['status'] = 1 ; 
		$this->db->update('doctor',$arr,array('id'=>$id));
	}

	public function get_by_id($id) {
		$this->db->where("(`id`='{$id}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function editpwd_by_doctorid($doctorid, $password) {
		$data = array();
		$data['password'] = nn_password($password);
		// $this->db->where('id', $userid);
		$this->db->update($this->table, array('password' => nn_password($password)), array('id' => $doctorid));
		return $this->db->affected_rows();
	}
	
	public function get_all_certs() {
		$this->db->select('doctor.username,doctor.mobile,doctor.province,doctor.city,doctor.hospital,collect.createtimes,collect.submittimes,collect.sn');
		$this->db->from('doctor');
		$this->db->join('collect', 'doctor.id = collect.doctorid');
		$this->db->where("collect.`status`='1' and collect.submittime>'0' and doctor.`status`='1'");
		$this->db->order_by('collect.createtime', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_all_certs_count() {
		$this->db->select('doctor.username,doctor.mobile,doctor.province,doctor.city,doctor.hospital,count(*) as num');
		$this->db->from('doctor');
		$this->db->join('collect', 'doctor.id = collect.doctorid');
		$this->db->where("collect.`status`='1' and collect.submittime>'0' and doctor.`status`='1'");
		$this->db->group_by('collect.doctorid');
		$this->db->order_by('num', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
}