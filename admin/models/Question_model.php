<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Question_model extends CI_Model
{
	/**
	 *  查询操作
	 *  $arr 查询的字段
	 */
	public function select($id,$page_arr = null)
	{
		if($id == 0 | $id == 'all' | $add = ''){
			return $this->db->where('status != -1')->get('question',$page_arr[0],$page_arr[1])->result_array();
		}else{
			return $this->db->where(array('id'=>$id))->get('question')->result_array();
		}

	}

	public function edit_status($id,$status)
	{
		$this->db->update('question',array('status'=>$status),array('id'=>$id));
	}

	/**
	 * 添加操作
	 */
	public function add($data)
	{
		// dd($data);
		$this->db->insert('question',$data);
	}

	public function del($id)
	{
		$this->db->update('question',array('status'=>'-1'),array('id'=>$id));
	}

	public function edit($id,$arr)
	{
		$this->db->update('question',$arr,array('id'=>$id));
	}

	public function rows()
	{
		$rows = $this->db->query('select count(id) from gh_question WHERE status=1')->result_array();
		return $rows[0]['count(id)'];
	}
	
	public function get_allpages_number() {
		$this->db->select( ' id ');
		$this->db->where( ' status != -1 ');
		$query = $this->db->get('gh_question');
		return $query->result_array();
	}
	
	public function get_allpages( $page_now , $num ){
		$page_now =  ($page_now - 1) * $num  ;
		$this->db->where( ' status != -1 ');
		$this->db->limit($num,$page_now);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('gh_question');
		return $query->result_array();
	}
	
	
	
	

}