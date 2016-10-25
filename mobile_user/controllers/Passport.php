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
		// $this->_loginuser = isset($_SESSION['loginuser']) ? $_SESSION['loginuser'] : false;
		$this->_loginuser = isset($_COOKIE['loginuser']) ? $_COOKIE['loginuser'] : false;
		$this->_timestamp = time();
		$this->data['timestamp'] = $this->_timestamp;
		if($this->_loginuser) {
			$this->data['loginuser'] = $this->_loginuser;
		} else {
			// if($this->router->method != 'login' && $this->router->method != 'reg') {
				// header('Location: /passport/login');
			// }
		}
		$this->load->model('user_model');
		$this->load->model('relation_model');
		$this->load->model('doctor_model');
		$this->load->helper('url');
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
		$result = $this->user_model->update_pasword_reset($data);
		if($result == 1){
			echo 1 ;
		}else{
			echo 0;
		}
		// $this->load->view('passport/resetdo', $data);
	}
	
	function reg($qrcode = '') {
	
		if($_POST) {
			
			
			$qrcode = $this->input->post('qrcode');
			$phonecode = $this->input->post('phonecode');
			$phonecode_session = isset($_SESSION['phonecode']) ? $_SESSION['phonecode'] : '';
			$pic = $this->input->post('pic');
			$last = isset($_SESSION['piccode']) ? $_SESSION['piccode'] : '';
			if($last != $pic) {
			        $result = -5;
			}else if($phonecode == null || $phonecode == "" || $phonecode != $phonecode_session) {
				 $result = -2;
			 } else {
			 	$this ->security->csrf_verify(); 
				$data = array(
					'mobile' => $this->input->post('mobile'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$result = $this->user_model->add($data);
				if($result > 0) {
					if($qrcode) {
						$doctorid = $qrcode - config_item('qrcode_start');
						// luiji_log(__FILE__, __LINE__, $doctorid);
						$doctor = $this->doctor_model->get_by_id($doctorid);
						if($doctor) {
							$data = array(
								'userid' => $result,
								'doctorid' => $doctorid,
								'doctorname' => '',
								'doctordes' => '',
								'chatopen' => 1,
								'healthopen' => 1,
								'bindway' => 'USER_SCAN_QRCODE'
							);
							$this->relation_model->add($data);
							// $this->doctor_model->receive_money($doctorid, 20, 'RELATION');
							$this->user_model->receive_money($result, 150, 'REGISTER');
						}
					}
					// $result = 2;
					unset($_POST['password']);
					unset($_SESSION['piccode']);
					unset($_SESSION['phonecode']);
					// $_SESSION['loginuser'] = $result;
					setcookie ('loginuser', $result, time() + 60 * 60 * 24 * 365, '/', '.diabetes.com.cn');
				}
			}
			
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			
		    $this->data['name'] = $this->security->get_csrf_token_name();
    		$this->data['hash'] = $this->security->get_csrf_hash();
			setcookie ( $this->data['name'], $this->data['hash'], time() + 60 * 60 * 24 * 365, '/', '.diabetes.com.cn');
			if($qrcode) {
				if($this->_loginuser) {
					header('Location: ' . config_item('app_url'));
				} else {
					$this->data['qrcode'] = $qrcode;
					
				}
				/*
				$user = $this->user_model->get_by_openid($this->_openid);
				if($user) {
					$_SESSION['loginuser'] = $user['id'];
					$_SESSION['loginuserlevel'] = $user['level'];
					header('Location: ' . config_item('app_url'));
				} else {
					$data = array(
						'openid' => $this->_openid
					);
					$userid = $this->user_model->add($data);
					$_SESSION['loginuser'] = $userid;
					$doctor = $this->doctor_model->get_by_qrcode($qrcode);
					$data = array(
						'userid' => $userid,
						'doctorid' => $doctor['id']
					);
					$this->relation_model->add($data);
					header('Location: ' . config_item('app_url'));
				}
				*/
				$this->load->view('passport/regscan', $this->data);
			}else{
				$this->load->view('passport/reg', $this->data);
			}
		}
	}
	/*
	function regg($qrcode = '') {
		if($_POST) {
			$qrcode = $this->input->post('qrcode');
			$phonecode = $this->input->post('phonecode');
			$phonecode_session = isset($_SESSION['phonecode']) ? $_SESSION['phonecode'] : '';
			 if($phonecode == null || $phonecode == "" || $phonecode != $phonecode_session) {
				 $result = -2;
			 } else {
				$data = array(
					'mobile' => $this->input->post('mobile'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				$result = $this->user_model->add($data);
				if($result > 0) {
					if($qrcode) {
						$doctorid = $qrcode - config_item('qrcode_start');
						// luiji_log(__FILE__, __LINE__, $doctorid);
						$doctor = $this->doctor_model->get_by_id($doctorid);
						if($doctor) {
							$data = array(
								'userid' => $result,
								'doctorid' => $doctorid,
								'doctorname' => '',
								'doctordes' => '',
								'chatopen' => 1,
								'healthopen' => 1,
								'bindway' => 'USER_SCAN_QRCODE'
							);
							$this->relation_model->add($data);
							// $this->doctor_model->receive_money($doctorid, 20, 'RELATION');
							$this->user_model->receive_money($result, 150, 'REGISTER');
						}
					}
				}
			}
			// $result = 2;
			unset($_POST['password']);
			// $_SESSION['loginuser'] = $result;
			setcookie ('loginuser', $result, time() + 60 * 60 * 24 * 365, '/', '.diabetes.com.cn');
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			if($qrcode) {
				if($this->_loginuser) {
					header('Location: ' . config_item('app_url'));
				} else {
					$this->data['qrcode'] = $qrcode;
					
				}
				
			}
			$this->load->view('passport/regg', $this->data);
		}
	}*/
	function reg_mobile() {
		$this->load->view('passport/reg_mobile', $this->data);
	}
	
	function login() {
		if($_POST) {
			$mobile = $this->input->post('mobile');
			$password  = $this->input->post('password');
			$check = false;
			$check = $this->user_model->check_login($mobile, $password);
			if($check){
				unset($_POST['password']);
				// $_SESSION['loginuser'] = $check['id'];
				setcookie('loginuser', $check['id'], time() + 60 * 60 * 24 * 365, '/', '.diabetes.com.cn');
				// luiji_log(__FILE__, __LINE__, 'loginuser - ' . $_COOKIE['loginuser'], 'debug');
				$json = array('result' => $check['id']);
			} else {
				$json = array('result' => -1);
			}
			echo json_encode($json);
		} else {
			if($this->_loginuser) {
				header('Location: ' . config_item('app_url') . 'index/index');
			} else {
				$this->data['isWeixinBrowser'] = nn_isWeixinBrowser();
				$this->load->view('passport/login', $this->data);
			}
		}
	}
	
	/*function phonecode() {
		$mobile = $this->input->post('mobile');
		$this->logdb('err:une_mobile:'.$mobile.'_at:'.time()."\r\n");
		echo 1;
		ob_flush();
   		flush();
		$phonecode = nn_phonecode();
		file_get_contents('http://wxtnbw.chinacloudsites.cn/guanhuai/message_api_update/demo.php?mobile=' . $mobile . '&yzm=' . $phonecode);
		$_SESSION['phonecode'] = $phonecode;
		
	}*/
	function phonecode() {
	    
	    if(isset($_SESSION["sendtime"]) && $_SESSION['sendtime'] != null && $_SESSION['sendtime'] !=0){
	        $last = $_SESSION['sendtime'];
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
	    if(isset($_SESSION["phone"]) && $_SESSION['phone'] != null && $_SESSION['phone'] !=0){
	        $last = $_SESSION['phone'];
	        if($last == $mobile) {
	            
	            
	            if(isset($_SESSION["times"]) && $_SESSION['times']!=null){
	                if($_SESSION['times']>=10) {
	                    echo 3;
	                    exit();
	                }else {
	                   $_SESSION['times'] = $_SESSION['times']+1;
	                }
	            }
	        }else{
	            $_SESSION['times']=0;
	        }
	    }
	    if($mobile==null || $mobile == ""){
	    	echo 4;
	        exit();
	    }
		$this ->security->csrf_verify(); 
		$this->logdb('err:une_mobile:'.$mobile.'_at:'.time()."_ip:".$this->nn_get_ip()."\r\n");
		echo 1;
		ob_flush();
   		flush();
		$phonecode = nn_phonecode();
		$sign = sha1($mobile."newnnit@!2O17".$phonecode);
		file_get_contents('http://wxtnbw.chinacloudsites.cn/guanhuai/message_api_update/sm.php?mobile=' . $mobile . '&yzm=' . $phonecode . '&sign=' . $sign);
		$_SESSION['phonecode'] = $phonecode;
		$_SESSION['phone'] = $mobile;
		$_SESSION['sendtime'] = time();
		
	}
	function refresh(){
		echo $this->security->get_csrf_hash();
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
	    if($phonecode==null || $phonecode == ""){
	    	echo 5;
	        exit();
	    }
	    $sign = sha1($mobile."newnnit@!2O17".$phonecode);
	    file_get_contents('http://wxtnbw.chinacloudsites.cn/guanhuai/message_api_update/sm.php?mobile=' . $mobile . '&yzm=' . $phonecode . '&sign=' . $sign);
	    $_SESSION['phonecodewithoutcode'] = $phonecode;
	    $_SESSION['phonewithoutcode'] = $mobile;
	    $_SESSION['sendtimewithoutcode'] = time();
	    unset($_SESSION['piccode']);
	
	}
	function logsms() {
	    $err = $this->input->post('err');
	    $mobile = $this->input->post('mobile');
	    $iserr = $this->input->post('iserr');
	    if($iserr == 1){
	    	$this->logdb('err:yes_mobile:'.$mobile.'_err:'.$err.'_at:'.time()."\r\n");
	    }else if($iserr == 0){
	    	$this->logdb('err:no _mobile:'.$mobile.'_err:'.$err.'_at:'.time()."\r\n");
	    }else if($iserr == 2) {
	    	$this->logdb('err:inp_mobile:'.$mobile.'_err:'.$err.'_at:'.time()."\r\n");
	    }
	    echo "ok";
	    
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
	function logout() {
		// unset($_SESSION['loginuser']);
		setcookie ('loginuser', '', time() - 60 * 60, '/', '.diabetes.com.cn');
		header('Location: ' . config_item('app_url') . 'passport/login');
	}


}