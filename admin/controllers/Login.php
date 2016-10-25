<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function index()
	{
		$this->load->view('login.html');
	}

	public function admin_login()
	{
		//模拟数据库
		$info = array(
			'uid' => '1',
			'name' => 'admin',
			'pass' => md5('mcmno1')
			);

		$xinyu = array(
		    'uid' => '2',
		    'name' => 'tongxinyu',
		    'pass' => md5('tongxinyu2016')
		);
		
		$name = $this->input->post('username');
		$pass = md5($this->input->post('password'));
		if(!$name || $name != $info['name'] || $pass != $info['pass']){
		    if(!$name || $name != $xinyu['name'] || $pass != $xinyu['pass']){
		        echo '<script>alert("登录失败...");</script>';
		        echo '<script>window.location.href="'.base_url().'admin.php/login/index"</script>';
		        die;
		    }else{
		        $arr = array(
		            'uid' => $xinyu['uid'],
		            'name' => $xinyu['name'],
		            'pass' => $xinyu['pass'],
		            'logintime' => time()
		        );
		    }
		}else{
		    $arr = array(
		        'uid' => $info['uid'],
		        'name' => $info['name'],
		        'pass' => $info['pass'],
		        'logintime' => time()
		    );
		}

		
		//写入session
		$this->session->set_userdata($arr);
		echo '<script>window.location.href="'.base_url().'admin.php/doctor/index"</script>';
	}
	/*{
		//模拟数据库
		$info = array(
			'uid' => '1',
			'name' => 'admin',
			'pass' => md5('mcmno1')
			);

		$name = $this->input->post('username');
		$pass = md5($this->input->post('password'));
		if(!$name || $name != $info['name'] || $pass != $info['pass']){
			echo '<script>alert("登录失败...");</script>';
			echo '<script>window.location.href="'.base_url().'admin.php/login/index"</script>';
			die;
		}

		$arr = array(
			'uid' => $info['uid'],
			'name' => $info['name'],
			'pass' => $info['pass'],
			'logintime' => time()
			);
		//写入session
		$this->session->set_userdata($arr);
		echo '<script>window.location.href="'.base_url().'admin.php/doctor/index"</script>';
	}*/

	/**
	 * 推出登录
	 */
	public function login_out()
	{
		$this->session->sess_destroy();
		echo '<script>window.location.href="'.base_url().'admin.php/login/index"</script>';
	}


}