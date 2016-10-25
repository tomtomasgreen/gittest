<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class knowledge extends MY_Controller
{
	public function select()
	{
		$this->load->model('Article_model','article');
		$data['data'] = $this->article->select(0,10);
		// dd($data);
		$this->load->view('knowledge/select.html',$data);
	}

	public function add()
	{

		$this->load->view('knowledge/add.html');
	}

	public function knowledge_add()
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

		$this->load->model('Article_model','article');
		$this->article->add($arr);
		$this->select();
	}

	public function del()
	{
		$id = $this->input->get('id');
		$this->load->model('Article_model','article');
		$this->article->del($id);
		$this->select();
	}

	public function edit()
	{
		$arr['id'] = $this->uri->segment(4);
		$this->load->model('Article_model','article');
		$arr['data'] = $this->article->select($arr['id']);
		$this->load->view('knowledge/edit.html',$arr);
	}

	public function knowledge_edit()
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
		$this->load->model('Article_model','article');
		$this->article->edit($id,$arr);
		$this->select();

	}

	public function to_doctor_index(){
		 redirect('admin.php/doctorknowledge/index');
	}
	
	// private function do_upload($file)
 //    {
 //        $config['upload_path']      = base_url().'upload/'.'image/'.date('Ymd',time());
 //        $config['allowed_types']    = 'jpg|png';
 //        $config['max_size']     = 100000;

 //        $this->load->library('upload', $config);

 //        if ( ! $this->upload->do_upload($file))
 //        {
 //            $error = array('error' => $this->upload->display_errors());
 //        }
 //        else
 //        {
 //            $data = array('upload_data' => $this->upload->data());
 //        }

 //        return $error;
 //    }

}