<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Relation_model extends CI_Model
{

	function __construct() {
		parent::__construct();
		$this->table = 'relation';
	}

	public function get_doctor($id)
	{
		return $this->db->where(array('userid'=>$id,'status'=>'1'))->get('relation')->result_array();
	}

}