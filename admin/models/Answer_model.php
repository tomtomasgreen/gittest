<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Answer_model extends CI_Model
{
	/**
	 *  查询操作
	 *  $arr 查询的字段
	 */
	public function select($id,$page_arr = null)
	{
		if($id == 0 | $id == 'all' | $add = ''){
			return $this->db->where('status != -1')->get('answer',$page_arr[0],$page_arr[1])->result_array();
		}else{
			return $this->db->where(array('questionid'=>$id))->get('answer')->result_array();
		}

	}

	public function edit_status($id,$status)
	{
		$this->db->update('answer',array('status'=>$status),array('questionid'=>$id));
	}

	/**
	 * 添加操作
	 */
	public function add($data)
	{
		// dd($data);
		$this->db->insert('answer',$data);
	}

	public function del($id)
	{
		$this->db->update('answer',array('status'=>'-1'),array('id'=>$id));
	}

	public function edit($id,$arr)
	{
		$this->db->update('answer',$arr,array('questionid'=>$id));
	}

	public function edit_answer_status($id,$status)
	{
		$this->db->update('answer',array('status'=>$status),array('id'=>$id));
		$data = $this->db->where(array('id'=>$id))->get('answer')->result_array();
		$question = $this->db->where(array('id'=>$data[0]['questionid']))->get('question')->result_array();
		$answers = $question[0]['answers'];
		if($status == 1){
			$answers++;
			$this->db->update('question',array('answers'=>$answers),array('id'=>$data[0]['questionid']));
		}elseif($status == 0){
			$answers--;
			$this->db->update('question',array('answers'=>$answers),array('id'=>$data[0]['questionid']));
		}
		return $data[0]['questionid'];
	}

	public function del_answer($id)
	{
		$this->db->update('answer',$arr,array('status'=>$id));
	}


}