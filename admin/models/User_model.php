<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model
{
	
	function __construct() {
		parent::__construct();
		$this->table = 'user';

	}
	
	/**
	 *  查询操作
	 *  $arr 查询的字段
	 */
	public function select($id,$page_arr = null)
	{
		if($id == 0 | $id == 'all' | $add = ''){
			return $this->db->where(array('status'=>1))->get('user',$page_arr[0],$page_arr[1])->result_array();
		}else{
			return $this->db->where(array('id'=>$id))->get('user')->result_array();
		}

	}

	/**
	 * 添加操作
	 */
	public function add($data)
	{
		// dd($data);
		$this->db->insert('user',$data);
	}

	public function del($id)
	{
		$this->db->update('user',array('status'=>'0'),array('id'=>$id));
	}

	public function edit($id,$arr)
	{
		$this->db->update('user',$arr,array('id'=>$id));
	}
	
	public function get_allpages_number() {
		$this->db->select( ' id ');
		$this->db->where(' status = 1 ');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	public function get_allpages( $page_now , $num ){
		$page_now =  ($page_now - 1) * $num  ;
		$this->db->select( '  user.* ,  box.sn  ');
		$this->db->limit($num,$page_now);
		$this->db->where(' user.status = 1 ');
		$this->db->from($this->table);
		$this->db->join('box', ' user.id = box.userid and box.status = 1 ' , 'left');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_by_id($id) {
		$this->db->where("(`id`='{$id}' AND `status`='1')");
		$query = $this->db->get($this->table);
		return $query->row_array();
	}
	
	public function editpwd_by_userid($userid, $password) {
		$data = array();
		$data['password'] = nn_password($password);
		// $this->db->where('id', $userid);
		$this->db->update($this->table, array('password' => nn_password($password)), array('id' => $userid));
		return $this->db->affected_rows();
	}
	
	
	
	

}