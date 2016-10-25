<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Passport extends CI_Controller {
	
	protected $data = array();
	private $_loginuser, $_timestamp;
   	
	function __construct() {
		parent::__construct();
		// $this->_loginuser = isset($_SESSION['logindoctor']) ? $_SESSION['logindoctor'] : false;
		$this->_loginuser = isset($_COOKIE['logindoctor']) ? $_COOKIE['logindoctor'] : false;
		$this->_timestamp = time();
		$this->data['timestamp'] = $this->_timestamp;
		if($this->_loginuser) {
			$this->data['loginuser'] = $this->_loginuser;
		} else {
			// if($this->router->method != 'login' && $this->router->method != 'reg') {
				// header('Location: /passport/login');
			// }
		}
		$this->load->model('doctor_model');
	}
	function getpiccode(){
	    ob_clean();
	    Header ( "Content-type:image/png" );
	    $this->load->library('PIC');
	    $str = $this->pic->getpic();
	    $_SESSION['piccode'] = $str;
	}
	function reset(){
		$data['name'] = $this->security->get_csrf_token_name();
    	$data['hash'] = $this->security->get_csrf_hash();
			
		$this->load->view('passport/reset',$data);
	}
	function resetdo(){
		$mobile = $_GET['mobile'];
		$data['mobile'] = $mobile ;
		// var_dump($mobile);exit;
		$this->load->view('passport/resetdo', $data);
	}
	
	function resettodo(){
		$data = array(
				'mobile' => $this->input->post('mobile'),
				'password' => $this->input->post('password')
			);
		$result = $this->doctor_model->update_pasword_reset($data);
		if($result == 1){
			echo 1 ;
		}else{
			echo 0;
		}
		// $this->load->view('passport/resetdo', $data);
	}
	function login() {
		if($_POST) {
			$mobile = $this->input->post('mobile');
			$password  = $this->input->post('password');
			$check = false;
			$check = $this->doctor_model->check_login($mobile, $password);
			if($check){
				unset($_POST['password']);
				// $_SESSION['logindoctor'] = $check['id'];
				setcookie ('logindoctor', $check['id'], time() + 60 * 60 * 24 * 365, '/', '.diabetes.com.cn');
				$json = array('result' => $check['id']);
			} else {
				$json = array('result' => -1);
			}
			echo json_encode($json);
		} else {
			// luiji_log(__FILE__, __LINE__, 'this->_loginuser - ' . $this->_loginuser, 'debug');
			// luiji_log(__FILE__, __LINE__, 'logindoctor cookie - ' . $_COOKIE['logindoctor'], 'debug');
			if($this->_loginuser) {
				header('Location: ' . config_item('app_url') . 'my/index');
			} else {
				$this->data['isWeixinBrowser'] = nn_isWeixinBrowser();
				$this->load->view('passport/login', $this->data);
			}
		}
	}
	
	function reg() {
		if($_POST) {
			$data = array(
				'mobile' => $this->input->post('mobile'),
				'password' => $this->input->post('password'),
				'username' => $this->input->post('username'),
				'province' => $this->input->post('province'),
				'city' => $this->input->post('city'),
				'hospital' => $this->input->post('hospital'),
				'department' => $this->input->post('department')
			);
			$result = $this->doctor_model->add($data);
			unset($_POST['password']);
			// $_SESSION['logindoctor'] = $result;
			// setcookie ('logindoctor', $result, time() + 60 * 60 * 24 * 365);
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			if($this->_loginuser) {
				header('Location: ' . config_item('app_url'));
			} else {
				$this->load->view('passport/reg', $this->data);
			}
		}
	}
	function nn_get_ip() {
		static $ip = NULL;
		if ($ip !== NULL) return $ip;
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$pos =  array_search('unknown',$arr);
			if(false !== $pos) unset($arr[$pos]);
			$ip   =  trim($arr[0]);
		}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0';
		return $ip;
	}
	function logout() {
		// unset($_SESSION['logindoctor']);
		setcookie ('logindoctor', '', time() - 60 * 60, '/', '.diabetes.com.cn');
		// $this->_loginuser = false;
		header('Location: ' . config_item('app_url') . 'passport/login');
	}
	function phonewithoutcode() {
	    
	    if(isset($_SESSION["sendtimewithoutcode"]) && $_SESSION['sendtimewithoutcode'] != null && $_SESSION['sendtimewithoutcode'] !=0){
	        $last = $_SESSION['sendtimewithoutcode'];
	        $dif =  time()-$last;
	        if($dif < 150) {
	        	$dif = 150-$dif;
	            echo '-'.$dif;
	            exit();
	        }
	    }
	    $pic = $this->input->post('pic');
	    if(isset($_SESSION["piccode"]) && $_SESSION['piccode'] != null && $_SESSION['piccode'] !=""){
	        $last = $_SESSION['piccode'];
	        if($last != $pic) {
	            echo 5;
	            exit();
	        }
	    }
	    $mobile = $this->input->post('mobile');
	    if(isset($_SESSION["phonewithoutcode"]) && $_SESSION['phonewithoutcode'] != null && $_SESSION['phonewithoutcode'] !=0){
	        $last = $_SESSION['phonewithoutcode'];
	        if($last == $mobile) {
	             
	             
	            if(isset($_SESSION["timeswithoutcode"]) && $_SESSION['timeswithoutcode']!=null){
	                if($_SESSION['timeswithoutcode']>=10) {
	                    echo 3;
	                    exit();
	                }else {
	                    $_SESSION['timeswithoutcode'] = $_SESSION['timeswithoutcode']+1;
	                }
	            }
	        }else{
	            $_SESSION['timeswithoutcode']=0;
	        }
	    }
	    if($mobile==null || $mobile == ""){
	    	echo 4;
	        exit();
	    }
		$this ->security->csrf_verify(); 
	    $this->logdb('err:res_mobile:'.$mobile.'_at:'.time()."_ip:".$this->nn_get_ip()."\r\n");
	    echo 1;
	    ob_flush();
	    flush();
	    $phonecode = $this->input->post('yzm');
	    $sign = sha1($mobile."newnnit@!2O17".$phonecode);
	    file_get_contents('http://wxtnbw.chinacloudsites.cn/guanhuai/message_api_update/sm.php?mobile=' . $mobile . '&yzm=' . $phonecode . '&sign=' . $sign);
	    $_SESSION['phonecodewithoutcode'] = $phonecode;
	    $_SESSION['phonewithoutcode'] = $mobile;
	    $_SESSION['sendtimewithoutcode'] = time();
	    unset($_SESSION['piccode']);
	}
	function refresh(){
		echo $this->security->get_csrf_hash();
	}
	function logdb($m) {
		
		// $context->db->where ( '', '' );
		$createtime = time ();
		$createtimes = date ( 'Y-m-d H:i:s', $createtime );
		$data = array (
				'createip' => "",
				'createtime' => $createtimes,
				'createtimes' => $createtimes,
				'type' => 10,
				'userid' => "",
				'isDoc' => 0,
				'request_post' => $m,
				'request_get' => "",
				'salt' => "",
				'funs' => "" 
		);
		
		$this->db->insert ( 'log', $data );
	}

}