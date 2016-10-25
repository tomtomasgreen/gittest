<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

// + ------------------------------------------------------------
// | 密码加密规则
// + ------------------------------------------------------------
if ( ! function_exists('nn_password'))
{
	function nn_password($password)
	{
		return md5($password);
	}
}

if ( ! function_exists('nn_password2'))
{
	function nn_password2($password) {
		return password_hash ( md5($password), PASSWORD_BCRYPT, [ 
				'cost' => 10
		] );
		// return md5($password);
	}
}
if ( ! function_exists('nn_check_password'))
{
	function nn_check_password($password, $bcrypt) {
		return password_verify(md5($password), $bcrypt);
	}
}

// + ------------------------------------------------------------
// | 解决图片路劲兼容
// + ------------------------------------------------------------

if ( ! function_exists('nn_fix_uploadurl'))
{
	function nn_fix_uploadurl($url) {
		if(strpos($url, '/guanhuai/') !== 0) {
			return '/guanhuai_app' . $url;
		}
		return $url;
	}
}

// + ------------------------------------------------------------
// | 判断手机号或邮箱
// + ------------------------------------------------------------
if ( ! function_exists('nn_is_mobile_or_email'))
{
	function nn_is_mobile_or_email($mobile)
	{
		$reg_email = "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/";
		$reg_mobile = "/^1\d{10}$/";
		if(preg_match($reg_mobile, $mobile)) return 'mobile';
		if(preg_match($reg_email, $mobile)) return 'email';
		return '';
	}
}

// + ------------------------------------------------------------
// | 获得默认配置
// + ------------------------------------------------------------
if ( ! function_exists('nn_config'))
{
	function nn_config($config, $item)
	{
		if(!$config) return '';
		return isset($config[$item]) ? $config[$item] : '';
	}
}

// + ------------------------------------------------------------
// | 打印调试变量
// + ------------------------------------------------------------
if ( ! function_exists('nn_dump'))
{
	function nn_dump($arr) {
		echo '<pre style="border:2px solid #d33;background-color:#fff;padding:20px;margin:20px;">';
		var_dump($arr);
		echo '</pre>';
	}
}

// + ------------------------------------------------------------
// | 过滤输入，防止SQL注入
// + ------------------------------------------------------------
if ( ! function_exists('nn_sql_escape'))
{
	function nn_sql_escape($str) {
		return mysql_real_escape_string($str);
	}
}

// + ------------------------------------------------------------
// | 获得提交参数
// + ------------------------------------------------------------
if ( ! function_exists('nn_get_param'))
{
	function nn_get_param($_param, $_default = false) {
		$param = ($_POST && isset($_POST[$_param])) ? $_POST[$_param] : ($_default ? $_default : '');
		$param = ($_GET && isset($_GET[$_param])) ? $_GET[$_param] : $param;
		return $param;
	}
}

// + ------------------------------------------------------------
// | 将json_encode之后的字符串转义，不进行Unicode转码
// + ------------------------------------------------------------
if ( ! function_exists('nn_url_decode'))
{
	function nn_url_decode($str) {  
		if(is_array($str)) {  
			foreach($str as $key=>$value) {  
				$str[urlencode($key)] = nn_url_decode($value);  
			}  
		} else {  
			$str = urlencode($str);  
		}  
		return $str;
	}
}

// + ------------------------------------------------------------
// | 将json_encode之后的字符串转义，不进行Unicode转码
// + ------------------------------------------------------------
if ( ! function_exists('nn_encode_json'))
{
	function nn_encode_json($str) {  
		return urldecode(json_encode(nn_url_decode($str)));      
	}
}

// + ------------------------------------------------------------
// | 获取客户端IP地址
// + ------------------------------------------------------------
if ( ! function_exists('nn_get_ip'))
{
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
}

// + ------------------------------------------------------------
// | 发送HTTPS请求
// + ------------------------------------------------------------
if ( ! function_exists('nn_https_request'))
{
	function nn_https_request($url, $data = null) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}
}

// + ------------------------------------------------------------
// | URL重定向
// + ------------------------------------------------------------
if ( ! function_exists('nn_redirect'))
{
	function nn_redirect($url, $time = 0, $msg = '') {
		$url = str_replace(array("\n", "\r"), '', $url);
		if (empty($msg))
			$msg = '系统将在' . $time . '秒之后自动跳转到' . $url . '！';
		if (!headers_sent()) {
			if (0 === $time) {
				header('Location: ' . $url);
			} else {
				header("refresh:{$time};url={$url}");
				echo($msg);
			}
			exit();
		} else {
			$str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
			if ($time != 0)
				$str .= $msg;
			exit($str);
		}
	}
}

// + ------------------------------------------------------------
// | 将textarea中的换行去除
// + ------------------------------------------------------------
if ( ! function_exists('nn_textareaclearbr'))
{
	function nn_textareaclearbr($text) {
		return str_replace("\n", ' ', $text);
	}
}

// + ------------------------------------------------------------
// | 将textarea中的换行转换为br换行符
// + ------------------------------------------------------------
if ( ! function_exists('nn_textarea2br'))
{
	function nn_textarea2br($text) {
		return str_replace("\n", '<br/>', $text);
	}
}

// + ------------------------------------------------------------
// | 获取字符串绝对长度
// + ------------------------------------------------------------
if ( ! function_exists('nn_abslength'))
{
	function nn_abslength($str) {
		if(empty($str)){
			return 0;
		}
		if(function_exists('mb_strlen')){
			return mb_strlen($str, 'utf-8');
		} else {
			preg_match_all("/./u", $str, $ar);
			return count($ar[0]);
		}
	}
}

// + ------------------------------------------------------------
// | 转码
// + ------------------------------------------------------------
if ( ! function_exists('nn_unescape'))
{
	function nn_unescape($str) {
		$str = rawurldecode($str);
		preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U", $str, $r);
		$ar = $r[0];
		foreach($ar as $k=>$v) {
			if(substr($v,0,2) == "%u"){
				$ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,-4)));
			}
			elseif(substr($v,0,3) == "&#x"){
				$ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,3,-1)));
			}
			elseif(substr($v,0,2) == "&#") {

				$ar[$k] = iconv("UCS-2BE","UTF-8",pack("n",substr($v,2,-1)));
			}
		}
		return join("", $ar);
	}
}