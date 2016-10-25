<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class notice extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
		$this->load->model('notice_model');
	}
	
	public function index()
	{
		$page_now  = $this->input->get('page_now');
		if($page_now == null ){
			$page_now = 1 ;	
		}
		$page_number = $this->notice_model->get_allpages_number();
		$page_number =  count($page_number) ;
		$page_zong = ceil($page_number / 10) ;
		$notice_all = $this->notice_model->get_allpages($page_now,10);
		$page_ma['page_now'] = $page_now ; 
		$page_ma['page_number'] = $page_number ; 
		$page_ma['page_zong'] = $page_zong ; 
		$this->data['notice_all'] = $notice_all ;
		$this->data['page_ma'] = $page_ma ;
		$this->load->view('notice/index.html', $this->data);
	}

	public function add()
	{
		$this->load->view('notice/add.html');
	}

	function toadd() { 
		$data = array(
			'content' => $this->input->post('notice_content')
		);
		$result = $this->notice_model->add($data);
		// $this->load->view('index', $this->data);
		$this->index();
	}
	
	function del () {
		$id  = $this->input->get('id');
		$del = $this->notice_model->del($id);
		$this->index();
	}

	function update(){
		$id  = $this->input->get('id');
		$notice_update = $this->notice_model->get_by_kind( $id , 'id' );
		$this->data['notice_update'] = $notice_update ;
		$this->load->view('notice/update.html', $this->data);
	}
	
	function to_update(){
		$notice['content']  = $this->input->post('notice_content');
		$id  = $this->input->get('id');
		$to_update = $this->notice_model->to_update($id,$notice);
		$this->index();
	}
	
	function user(){
		$this->load->view('notice/user.html');
	}
	
	
	

}