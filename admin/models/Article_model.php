<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article_model extends CI_Model
{
	/**
	 *  查询操作
	 *  $arr 查询的字段
	 */
	public function select($id,$page_arr = null)
	{
		if($id == 0 | $id == 'all' | $add = ''){
			return $this->db->where(array('status'=>1))->get('article',$page_arr[0],$page_arr[1])->result_array();
		}else{
			return $this->db->where(array('id'=>$id))->get('article')->result_array();
		}

	}

	/**
	 * 添加操作
	 */
	public function add($data)
	{
		// dd($data);
		$this->db->insert('article',$data);
	}

	public function del($id)
	{
		$this->db->update('article',array('status'=>'0'),array('id'=>$id));
	}

	public function edit($id,$arr)
	{
		$this->db->update('article',$arr,array('id'=>$id));
	}

}