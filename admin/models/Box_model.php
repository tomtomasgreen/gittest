<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Box_model extends CI_Model
{
	/**
	 *  查询操作
	 *  $arr 查询的字段
	 */
	public function select($id,$page_arr = null)
	{
		if($id == 0 | $id == 'all' | $add = ''){
			return $this->db->where(array('status'=>1))->get('box',$page_arr[0],$page_arr[1])->result_array();
		}else{
			return $this->db->where(array('userid'=>$id))->get('box')->result_array();
		}
	}
	
	public function search( $search ){
		if( $search['phone'] != 'phone' ){
			$this->db->where( " mobile = {$search['phone']} " ) ;
		}
		if( $search['email'] != 'email' ){
			$this->db->where( " email = {$search['email']} " ) ;
		}
		$this->db->select( '  user.* ,  box.sn ,box.bindtime ');
		$this->db->where(' user.status = 1 ');
		$this->db->from( 'user' );
		$this->db->join('box', ' user.id = box.userid and box.status = 1 ' );
		$query = $this->db->get();
		return $query->result_array();
	}


}