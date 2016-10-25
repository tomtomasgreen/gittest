<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class question extends MY_Controller
{
	public function index()
	{
		$this->load->model('question_model','question');
		
		
		$page_now  = $this->input->get('page_now');
		if($page_now == null ){
			$page_now = 1 ;	
		}
		$page_number = $this->question->get_allpages_number();
		$page_number =  count($page_number) ;
		$page_zong = ceil($page_number / 10) ;
		$data = $this->question->get_allpages($page_now,10);
		$page_ma['page_now'] = $page_now ; 
		$page_ma['page_number'] = $page_number ; 
		$page_ma['page_zong'] = $page_zong ; 
		$this->data['data'] = $data ;
		$this->data['page_ma'] = $page_ma ;
		$this->load->view('question/select.html', $this->data);
	}

	public function add()
	{

		$this->load->view('question/add.html');
	}

	public function question_add()
	{
		$arr['content'] = $this->input->post('content');
		$arr['createtime'] = time();
		$arr['createtimes'] = date('Y-m-d H:i:s',time());
		$arr['status'] = 1;

		$this->load->model('question_model','question');
		$this->question->add($arr);
		$this->add();
	}

	public function question_del()
	{
		$id = $this->uri->segment(4);
		$this->load->model('question_model','question');
		$this->question->del($id);
		$this->index();
	}

	public function edit_status()
	{
		$id = $this->uri->segment(4);
		$status = $this->uri->segment(6);
		$this->load->model('question_model','question');
		$this->question->edit_status($id,$status);
		$this->index();
	}

	public function edit()
	{
		$id = $this->uri->segment(4);
		$this->load->model('question_model','question');
		$arr['data'] = $this->question->select($id);
		$this->load->view('question/edit.html',$arr);
	}

	public function question_edit()
	{
		$id = $this->input->post('id');
		$arr['title'] = $this->input->post('title');
		$arr['content'] = $this->input->post('content');
		if($_FILES["thumb"]["tmp_name"]){
			$file = './upload/'.'image/'.date('Ymd',time());
			if(!file_exists($file)){
   				mkdir($file, 0777);
			}
			$name = explode('/',$_FILES["thumb"]["type"]);
			$file_name = date('Ymd',time()).'/'.time().'.'.$name[1];
			move_uploaded_file($_FILES["thumb"]["tmp_name"],'./upload/'.'image/'.$file_name);
			$arr['photos'] = $file_name;
		}
		$this->load->model('question_model','question');
		$this->question->edit($id,$arr);
		$this->index();
	}

	public function answer_select($id)
	{
		$id = $this->uri->segment(4);
		$this->load->model('answer_model','answer');
		$arr['data'] = $this->answer->select($id);
		$this->load->model('doctor_model','doctor');
		$arr['doctor'] = @$this->doctor->select($arr['data']['0']['doctorid']);
		$this->load->model('question_model','question');
		$arr['question'] = @$this->question->select($id);
		$this->load->view('answer/select.html',$arr);
	}

	public function edit_answer_status()
	{
		$id = $this->uri->segment(4);
		$status = $this->uri->segment(6);
		$this->load->model('answer_model','answer');
		$data = $this->answer->edit_answer_status($id,$status);
		$this->answer_select($data);
	}

	public function del_answer()
	{
		$id = $this->uri->segment(4);
		$this->load->model('answer_model','answer');
		$data = $this->answer->del_answer($id);
		$this->answer_select();
	}


}