<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class box extends MY_Controller
{
	public function index()
	{
		$search['phone'] = 'phone' ;
		$search['email'] = 'email' ;
		$this->load->model('box_model','box');
		$arr['data'] = $this->box->search( $search );
		$this->load->view('box/select.html',$arr);
	}

	public function search(){
		if( $this->input->post( 'search_phone' ) != "" ){
			$search['phone'] = $this->input->post( 'search_phone' ) ;
		}else{
			$search['phone'] = "phone" ;
		}
		if( $this->input->post( 'search_email' ) != "" ){
			$search['email'] = $this->input->post( 'search_email' ) ;
		}else{
			$search['email'] = "email" ;
		}
		$this->load->model('box_model','box');
		$arr['data'] = $this->box->search( $search );
		// var_dump($arr);exit;
		$this->load->view('box/select.html',$arr);
	}


}