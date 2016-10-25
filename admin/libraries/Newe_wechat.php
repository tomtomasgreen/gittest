<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Newe_wechat {

	private $_appid, $_appsecret, $_token, $_jssdk, $_cache, $_config, $_accesstoken;

	public function __construct($appid = '', $appsecret = '') {
		$this->_appid 		= $appid;
		$this->_appsecret 	= $appsecret;
		$this->_token		= 'newe';
		$this->_cache 		= new Newe_cache();
		$this->_config 		= $this->_cache->read('config_pub');
		$this->_jssdk 		= new Newe_jssdk($this->_config['appid'], $this->_config['appsecret']);
		$this->_accesstoken = $this->_jssdk->getAccessToken();
	}

	// + ------------------------------------------------------------
	// | 微信接口对接验证，只在设置接口时被调用
	// + ------------------------------------------------------------
	public function checkSignature() {
		$echoStr = newe_get_param('echostr');
		$signature = newe_get_param('signature');
		$timestamp = newe_get_param('timestamp');
		$nonce = newe_get_param('nonce');
		$tmpArr = array($this->_token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		if( $tmpStr == $signature ) {
			return $echoStr;
		} else {
			return '';
		}
	}

	// + ------------------------------------------------------------
	// | 判断是否当前为微信内置浏览器
	// + ------------------------------------------------------------
	public function isWeixinBrowser() {
		$agent = $_SERVER ['HTTP_USER_AGENT'];
		if (!strpos ( $agent, 'icroMessenger' )) {
			return false;
		}
		return true;
	}

	// + ------------------------------------------------------------
	// | php获取当前访问的完整url地址
	// + ------------------------------------------------------------
	public function getCurrentUrl() {
		$url = 'http://';
		if (isset ( $_SERVER ['HTTPS'] ) && $_SERVER ['HTTPS'] == 'on') {
			$url = 'https://';
		}
		if ($_SERVER ['SERVER_PORT'] != '80') {
			$url .= $_SERVER ['HTTP_HOST'] . ':' . $_SERVER ['SERVER_PORT'] . $_SERVER ['REQUEST_URI'];
		} else {
			$url .= $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		}
		if (stripos ( $url, '?' ) === false) {
			$url .= '?t=' . time ();
		}
		return $url;
	}

	// + ------------------------------------------------------------
	// | 公众号向用户返回文本消息
	// + ------------------------------------------------------------
	public function sendText($fromUsername, $toUsername, $content) {
		$time = time();
		$msgType = 'text';
		$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
					</xml>"
		;
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $content);
		return $resultStr;
	}

	// + ------------------------------------------------------------
	// | 公众号向用户返回图文消息
	// + ------------------------------------------------------------
	public function sendImageText($fromUsername, $toUsername, $title, $description, $picUrl, $url) {
		$time = time();
		$msgType = 'news';
		$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>1</ArticleCount>
					<Articles>
						<item>
							<Title><![CDATA[%s]]></Title> 
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
						</item>
					</Articles>
				</xml>";
		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $title, $description, $picUrl, $url);
		return $resultStr;
	}
	
	public function generateMenu($menus_obj) {
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $this->_accesstoken;
		$sendmenu = newe_encode_json($menus_obj);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode($sendmenu) );
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
}
