<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Doctorknowledge extends MY_Controller
{
	public function index()
	{
		$this->load->model('Doctorknowledge_model','question');
		$arr['data'] = $this->question->select(0);
		$this->load->view('doctorknowledge/select.html',$arr);
	}

	public function add()
	{

		$this->load->view('doctorknowledge/add.html');
	}

	public function question_add()
	{
		$arr['title'] = $this->input->post('title');
		if ($this->input->post('type') == 1) {
			$arr['content'] = htmlspecialchars($this->input->post('content'));
			$arr['description'] = $this->input->post('description');
		} elseif($this->input->post('type') == 2) {
			$arr['url'] = $this->input->post('url');
		}
		$arr['createtime'] = time();
		$arr['createtimes'] = date('Y-m-d H:i:s',time());
		$arr['status'] = 1;

		if($_FILES["thumb"]["tmp_name"]){
			$name = explode('/',$_FILES["thumb"]["type"]);
			$file_name = date('Ymd',time()).'/'.time().'.'.$name[1];
			move_uploaded_file($_FILES["thumb"]["tmp_name"],'./upload/'.'image/'.$file_name);
			$arr['photos'] = $file_name;
		}

		$this->load->model('Doctorknowledge_model','question');
		$this->question->add($arr);
		$this->add();
	}

	public function question_del()
	{
		$id = $this->uri->segment(4);
		$this->load->model('Doctorknowledge_model','question');
		$this->question->del($id);
		$this->index();
	}

	public function edit_status()
	{
		$id = $this->uri->segment(4);
		$status = $this->uri->segment(6);
		$this->load->model('Doctorknowledge_model','question');
		$this->question->edit_status($id,$status);
		$this->index();
	}

	public function edit()
	{
		$arr['id'] = $this->uri->segment(4);
		$this->load->model('Doctorknowledge_model','question');
		$arr['data'] = $this->question->select($arr['id']);
		$this->load->view('doctorknowledge/edit.html',$arr);
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
		$this->load->model('Doctorknowledge_model','question');
		$this->question->edit($id,$arr);
		$this->index();
	}
	public function doctorknowledge_add()
		{
			$arr['title'] = $this->input->post('title');
			$arr['thumb'] = $this->input->post('thumb');
			if ($this->input->post('type') == 1) {
				// $arr['content'] = htmlspecialchars($this->input->post('content'));
				$arr['content'] = $this->input->post('content');
				$arr['description'] = $this->input->post('description');
			} elseif($this->input->post('type') == 2) {
				$arr['url'] = $this->input->post('url');
			}
			$arr['status'] = 1;
			$arr['createtime'] = time();
			$arr['createtimes'] = date('Y-m-d H-i-s',time());
			$arr['createip'] = '';
			// var_dump($arr['content']);exit;
			$this->load->model('doctorknowledge_model','article');
			$this->article->add_article($arr);
			$this->index();
		}
	
	public function doctorknowledge_edit()
	{
		$id = $this->input->post('id');
		$arr['content'] = $this->input->post('content');
		$arr['title'] = $this->input->post('title');
		$arr['description'] = $this->input->post('description');
		$arr['status'] = 1;
		if(!empty($_FILES["thumb"]["tmp_name"])){
			$name = explode('/',$_FILES["thumb"]["type"]);
			$file_name = date('Ymd',time()).'/'.time().'.'.$name[1];
			move_uploaded_file($_FILES["thumb"]["tmp_name"],'./upload/'.'image/'.$file_name);
			$arr['thumb'] = $file_name;	
		}
		// var_dump($arr['content']);exit;
		$this->load->model('doctorknowledge_model','article');
		$this->article->edit_article($id,$arr);
		$this->index();

	}
	
	public function del()
	{
		$id = $this->input->get('id');
		$this->load->model('doctorknowledge_model','article');
		$this->article->del($id);
		$this->index();
	}
	

}