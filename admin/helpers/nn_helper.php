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
	function nn_password($password) {
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


/**
	$currentPage 		= $_GET['page'];
	$path 				= 'page.php';
	$params 			= array(
		'uid'			=> '20',
		'action'		=> 'search',
		'order'			=> 'time'
	);
	$config 			= array(
		'totalCount' 	=> 521,
		'perPage'		=> 10,
		'showPages'		=> 10
	);
	echo luiji_pages($path, $params, $currentPage, $config);
	echo luiji_pages($path, null, $currentPage, $config);
 	
	// ============================================================
	.luiji-pages{border-bottom:1px solid #ccc;padding:20px 0;}
	.luiji-pages .pages-ul{}
	.luiji-pages .pages-ul .pages-li{float:left;margin-right:4px;min-width:16px;}
	.luiji-pages .pages-ul .pages-li.nolink{padding:4px 6px;text-align:center;color:#ccc;border:1px solid #ccc;}
	.luiji-pages .pages-ul .pages-li.current{background-color:#278EAC;color:#FFF;font-weight:bold;padding:5px 6px;border:0;}
	.luiji-pages .pages-ul .pages-li.info{line-height:28px;color:#999;padding:0 4px;}
	.luiji-pages .pages-ul .pages-li a{display:block;border:1px solid #BBB;padding:4px 6px;color:#999;text-align:center;}
	.luiji-pages .pages-ul .pages-li a.page{display:block;border:1px solid #BBB;padding:4px 6px;color:#999;text-align:center;min-width:16px;}
	.luiji-pages .pages-ul .pages-li a:hover{border:1px solid #ccc;background-color:#eee;text-decoration:none;}
*/
if ( ! function_exists('nn_pages'))
{
	function nn_pages($path, $params, $currentPage, $config) {
		$_DEFAULTS 	= array(
			'LABEL_PRE' 	=> '上一页',
			'LABEL_NEXT' 	=> '下一页',
			'LABEL_FIRST' 	=> '第一页',
			'LABEL_LAST' 	=> '最后一页',
			'PERPAGE' 		=> 10,
			'SHOWPAGES' 	=> 10
		);
		
		// 获得配置参数
		$totalCount = $config['totalCount'];
		$perPage 	= $config['perPage'] 			? $config['perPage'] 	: $_DEFAULTS['PERPAGE'];
		$showPages 	= $config['showPages'] 			? $config['showPages'] 	: $_DEFAULTS['SHOWPAGES'];
		$labelPre 	= isset($config['labelPre']) 	? $config['labelPre'] 	: $_DEFAULTS['LABEL_PRE'];
		$labelNext 	= isset($config['labelNext'])	? $config['labelNext'] 	: $_DEFAULTS['LABEL_NEXT'];
		$labelFirst = isset($config['labelFirst'])	? $config['labelFirst'] : $_DEFAULTS['LABEL_FIRST'];
		$labelLast 	= isset($config['labelLast'])	? $config['labelLast'] 	: $_DEFAULTS['LABEL_LAST'];
		
		// 总共页数
		$totalPages = ($totalCount % $perPage > 0) ? (intval($totalCount / $perPage) + 1) : ($totalCount / $perPage);
		if($totalPages == 0) $totalPages = 1;
		// p('总页数', $totalPages);
		// 检测当前页
		if($currentPage < 1) $currentPage = 1;
		else if($currentPage > $totalPages) $currentPage = $totalPages;
		// 保证每次显示偶数个按钮
		if($showPages % 2 > 0) $showPages++;
		// 当前显示的第一页
		$first 		= 1;
		$first 		= $currentPage - $showPages / 2 + 1;
		if($first < 1) $first = 1;
		else if($first > ($totalPages - $showPages + 1)) $first = $totalPages - $showPages + 1;
		if($first < 1) $first = 1;
		// 当前显示的最后一页
		$last = $first + $showPages - 1;
		
		if($last > $totalPages) $last = $totalPages;
		
		$url = $path . '?'; 
		$_paramStr = '';
		if($params)
		{
			$i = 0;
			foreach($params as $param => $val)
			{
				if($i == 0)
					$_paramStr .= '' . 	$param . '=' . $val;
				else
					$_paramStr .= '&' . $param . '=' . $val;
				$i++;
			}
			$url .= $_paramStr;
		}
		
		// page参数
		$pageParam = 'per=' . $perPage . '&page=';
		if($params) $pageParam = '&' . $pageParam;
		// 根据当前页生成导航按钮
		$html = '<div class="luiji-pages"><ul class="f-cb pages-ul">';
		if($currentPage == 1)
			$html .= '<li class="pages-li nolink">' . $labelFirst . '</li><li class="pages-li nolink">' . $labelPre . '</li>';
		else
			$html .= 
				'<li class="pages-li">' .
					'<a class="pages-nav" href="' . $url . $pageParam . '1">' . $labelFirst . '</a>' .
				'</li>' .
				'<li class="pages-li">' .
					'<a class="pages-nav" href="' . $url . $pageParam . ($currentPage - 1) . '">' . $labelPre . '</a>' .
				'</li>';
					
		for($i = $first; $i <= $last; $i++)
		{
			if($i == $currentPage)
				$html .= '<li class="pages-li nolink current">' . $i . '</li>';
			else
				$html .= '<li class="pages-li"><a class="page" href="' . $url . $pageParam . $i . '">' . $i . '</a></li>';
		}
		
		if($currentPage == $totalPages)
			$html .= '<li class="pages-li nolink">' . $labelNext . '</li><li class="pages-li nolink">' . $labelLast . '</li>';
		else
			$html .= 
				'<li class="pages-li">' .
					'<a class="pages-nav" href="' . $url . $pageParam . ($currentPage + 1) . '">' . $labelNext . '</a>' .
				'</li>' .
				'<li class="pages-li">' .
					'<a class="pages-nav" href="' . $url . $pageParam . $totalPages . '">' . $labelLast . '</a>' .
				'</li>';
		$html .= '<li class="pages-li info">当前在 ' . $currentPage . '/' . $totalPages . ' 页，共 ' . $totalCount . ' 条记录</li>';
		$html .= '</ul></div>';
		
		return $html;
	}
}