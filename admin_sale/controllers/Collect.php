<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Collect extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('collect_model');
		$this->load->model('collectanswer_model');
		$this->load->model('question_model');
	}
	
	function index() {
		$this->load->view('collect/index', $this->data);
	}
	
	
	function show() {
		$sn = $this->input->post('num');
		if($sn == 0 || $sn == null || $sn == ''){
			echo '<script>alert("错误信息...")</script>';
		}
		$this->load->model('collect_model','collect');
		$data = $this->collect->select($sn);
		$arr['data'] = $data;
		$this->load->view('collect/show',$arr);
	}
	
	function down_img(){
		$url = $this->input->get('url');
		$arr['url'] = $url;
		$this->load->view('collect/down_img' , $arr );
	}
	
	function question_details(){
		$sn = $this->input->get('sn');
		$data = $this->collect_model->question_details( $sn );
		$arr['data'] = $data;
		$this->load->view('collect/question_details' , $arr );
	}

	
	
	
	
	


}