<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class doctor extends MY_Controller
{
	public function index()
	{
		GLOBAL $AREAS;
		$this->load->model('doctor_model','doctor');
		$page = $this->input->get('page');
		$page = $page ? $page : 1;
		$data['data'] = $this->doctor->select_page($page);
		$all_doctors = $this->doctor->select(0, 10);
		$totalCount = count($all_doctors);
		$data['users_total'] = 0;
		for($i = 0; $i < count($data['data']); $i++) {
			$doctorid = $data['data'][$i]['id'];
			$users = $this->doctor->get_users_by_doctorid($doctorid);
			$data['data'][$i]['users'] = count($users);
			$data['users_total'] += $data['data'][$i]['users'];
		}
		
		$path 				= site_url() . 'admin.php/doctor/index';
		$params 			= array();
		$page_config 		= array(
			'totalCount' 	=> $totalCount,
			'perPage'		=> 30,
			'showPages'		=> 10
		);
		$data['AREAS'] = $AREAS;
		$data['isindex'] = 1;
		$data['page_data'] = array(
			'path' => $path,
			'page' => $page,
			'config' => $page_config
		);
		$this->load->view('doctor/select.html',$data);
	}
	public function export()
	{
		GLOBAL $AREAS;
		$this->load->model('doctor_model','doctor');
		$data['data'] = $this->doctor->select(0,10);
		$data['users_total'] = 0;
		for($i = 0; $i < count($data['data']); $i++) {
			$doctorid = $data['data'][$i]['id'];
			$users = $this->doctor->get_users_by_doctorid($doctorid);
			$data['data'][$i]['users'] = count($users);
			$data['users_total'] += $data['data'][$i]['users'];
		}
		$data['AREAS'] = $AREAS;
		$filename = '所有医生.xls';
		$encoded_filename = urlencode($filename);
		$encoded_filename = str_replace("+", "%20", $encoded_filename);
		header("Content-Type: application/vnd.ms-excel;charset=UTF-8");
		$ua = $_SERVER["HTTP_USER_AGENT"];
		if (preg_match("/Firefox/", $ua)) {
			header("Content-Disposition:attachment;filename*=".$encoded_filename."" );
		}else {
			header("Content-Disposition:attachment;filename=".$encoded_filename."" );
		}
		$this->load->view('doctor/export.html',$data);
	}

	public function add()
	{
		$this->load->helper('form');
		$this->load->view('doctor/add.html');
	}

	public function del()
	{
		$id = $this->uri->segment(4);
		$this->load->model('doctor_model','doctor');
		$this->doctor->del($id);
		$this->index();
	}

	public function edit()
	{
		$data['id'] = $this->uri->segment(4);
		$this->load->helper('form');
		$this->load->model('doctor_model','doctor');
		$data['data'] = $this->doctor->select($data['id']);
		$this->load->view('doctor/add.html',$data);
	}

	public function edit_doctor()
	{
			$this->load->model('doctor_model','doctor');
			$arr['mobile'] = $this->input->post('mobile');
			$arr['username'] = $this->input->post('username');
			$arr['email'] = $this->input->post('email') == '' ? '0' : $this->input->post('email');
			$arr['birthyear'] = $this->input->post('birthyear') == '' ? '180' : $this->input->post('birthyear');
			$arr['birthmonth'] = $this->input->post('birthmonth') == '' ? '1' : $this->input->post('birthmonth');
			$arr['hospital'] = $this->input->post('hospital') == '' ? '0' : $this->input->post('hospital');
			$arr['department'] = $this->input->post('department') == '' ? '0' : $this->input->post('department');
			$arr['job'] = $this->input->post('job') == '' ? '0' : $this->input->post('job');
			$arr['address'] = $this->input->post('address') == '' ? '0' : $this->input->post('address');
			$arr['ismaster'] = $this->input->post('ismaster') == '' ? '0' : $this->input->post('ismaster');
			$arr['createip'] = $this->input->op_address();
			$arr['status'] = 1;
			$arr['createtime'] = time();
			$this->doctor->edit($this->input->post('id'),$arr);
			$this->index();
	}

	/**
	 * 添加医生post数据处理
	 */
	public function add_doctor()
	{
		$this->load->library('form_validation');
		$data = $this->form_validation->run('add_doctor');
		if($data){
			$this->load->model('doctor_model');
			$arr['mobile'] = $this->input->post('mobile');
			$arr['password'] = md5($this->input->post('password'));
			$arr['username'] = $this->input->post('username');
			$arr['email'] = $this->input->post('email') == '' ? '0' : $this->input->post('email');
			$arr['birthyear'] = $this->input->post('birthyear') == '' ? '180' : $this->input->post('birthyear');
			$arr['birthmonth'] = $this->input->post('birthmonth') == '' ? '1' : $this->input->post('birthmonth');
			$arr['hospital'] = $this->input->post('hospital') == '' ? '0' : $this->input->post('hospital');
			$arr['department'] = $this->input->post('department') == '' ? '0' : $this->input->post('department');
			$arr['job'] = $this->input->post('job') == '' ? '0' : $this->input->post('job');
			$arr['address'] = $this->input->post('address') == '' ? '0' : $this->input->post('address');
			$arr['ismaster'] = $this->input->post('ismaster') == '' ? '0' : $this->input->post('ismaster');
			$arr['createtime'] = time();
			$this->doctor_model->add($arr);
			$this->add();
		}else{
			$this->add();
		}

	}

	/**
	 * 按条件搜索
	 */
	public function search()
	{
		GLOBAL $AREAS;
		$arr = array();
		$this->input->post('hospital') && $arr['hospital'] = $this->input->post('hospital');
		$this->input->post('department') && $arr['department'] = $this->input->post('department');
		$this->input->post('job') && $arr['job'] = $this->input->post('job');
		$this->input->post('username') && $arr['username'] = $this->input->post('username');
		$this->input->post('mobile') && $arr['mobile'] = $this->input->post('mobile');
		$this->input->post('ismaster') && $arr['ismaster'] = $this->input->post('ismaster');
		$this->input->post('sex') && $arr['sex'] = $this->input->post('sex');
		$this->input->post('province') && $arr['province'] = $this->input->post('province');
		$this->input->post('city') && $arr['city'] = $this->input->post('city');
		if(@$arr['sex'] == '-1') $arr['sex'] = '女';
		if(@$arr['sex'] == '1') $arr['sex'] = '男';
		if(@$arr['ismaster'] == '-1') $arr['ismaster'] = '0';
		$arr['status'] = 1;
		$this->load->model('doctor_model','doctor');
		$dataa['data'] = $this->doctor->search($arr);
		$dataa['users_total'] = 0;
		for($i = 0; $i < count($dataa['data']); $i++) {
			$doctorid = $dataa['data'][$i]['id'];
			$users = $this->doctor->get_users_by_doctorid($doctorid);
			$dataa['data'][$i]['users'] = count($users);
			$dataa['users_total'] += $dataa['data'][$i]['users'];
		}
		if(@$arr['ismaster'] == '0') $arr['ismaster'] = '-1';
		$dataa['search'] = $arr;
		$dataa['AREAS'] = $AREAS;
		$dataa['isindex'] = 0;
		$this->load->view('doctor/select.html',$dataa);
	}

	public function examine(){
		$this->load->model('doctor_model','doctor');
		$dataa['data'] = $this->doctor->examine();
		$this->load->view('doctor/examine.html',$dataa);
	}
	
	public function examine_do(){
		$id = $this->input->get('id') ;
		// var_dump($id);exit;
		$this->load->model('doctor_model','doctor');
		$dataa['data'] = $this->doctor->examine_do( $id );
		$this->examine();
	}
	
	function editpwd() {
		$this->load->model('doctor_model');
		$doctorid = $this->input->get('did');
		$doctor = $this->doctor_model->get_by_id($doctorid);
		$data = array();
		$data['doctor'] = $doctor;
		$this->load->view('doctor/editpwd', $data);
	}
	
	function updatepwd() {
		$this->load->model('doctor_model');
		$doctorid = $this->input->post('did');
		$password = $this->input->post('password');
		$this->doctor_model->editpwd_by_doctorid($doctorid, $password);
		$this->load->view('doctor/updatepwd');
	}

}