<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Newe_jssdk {
	
	private $_appid, $_appsecret, $_cachepath;
	
	public function __construct($appid = '', $appsecret = '') {
		$this->_appid = $appid;
		$this->_appsecret = $appsecret;
		$this->_cachepath = APPPATH . 'cache/';
	}

	public function getSignPackage() {
		$jsapiTicket = $this->getJsApiTicket();
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$timestamp = time();
		$nonceStr = $this->createNonceStr();
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
		$signature = sha1($string);
		$signPackage = array(
			'appId'     => $this->_appid,
			'nonceStr'  => $nonceStr,
			'timestamp' => $timestamp,
			'url'       => $url,
			'signature' => $signature,
			'jsapiTicket' => $jsapiTicket,
			'rawString' => $string
		);
		return $signPackage; 
	}

	private function createNonceStr($length = 16) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$str = '';
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	public function getJsApiTicket() {
		$data = json_decode(file_get_contents($this->_cachepath . 'jsapi_ticket.json'));
		if ($data->expire_time < time() ) {
			$accessToken = $this->getAccessToken();
			$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=' . $accessToken;
			$res = json_decode($this->httpGet($url));
			$ticket = $res->ticket;
			if ($ticket) {
				$data->expire_time = time() + 3600;
				$data->jsapi_ticket = $ticket;
				$fp = fopen($this->_cachepath . 'jsapi_ticket.json', 'w');
				fwrite($fp, json_encode($data));
				fclose($fp);
			}
		} else {
			$ticket = $data->jsapi_ticket;
		}
		return $ticket;
	}
  
	public function getAccessToken() {
		if(file_exists($this->_cachepath . 'access_token.json')) {
			$data = json_decode(file_get_contents($this->_cachepath . 'access_token.json'));
		} else {
			$data = json_decode('{"expire_time":0}');
		}
		if($data->expire_time < time()) {
			$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->_appid . '&secret=' . $this->_appsecret;
			$res = json_decode($this->httpGet($url));
			$access_token = $res->access_token;
			if ($access_token) {
				$data->expire_time = time() + 3600;
				$data->access_token = $access_token;
				$fp = fopen($this->_cachepath . 'access_token.json', 'w');
				fwrite($fp, json_encode($data));
				fclose($fp);
			}
		} else {
			$access_token = $data->access_token;
		}
		return $access_token;
	}

	private function httpGet($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, 500);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		$res = curl_exec($curl);
		curl_close($curl);
		return $res;
	}
	
}