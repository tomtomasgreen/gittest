<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	protected $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->model('article_model');
	}
	
	function new_article() {
		$title = $this->input->get('title');
		$thumb = $this->input->get('thumb');
		$url = $this->input->get('url');
		$test = $this->input->get('test');
		$jsoncallback = $this->input->get('jsoncallback');

		$id = 1;
		$result = 'error';
		// luiji_log(__FILE__, __LINE__, $title, 'debug');
		// luiji_log(__FILE__, __LINE__, $thumb, 'debug');
		// luiji_log(__FILE__, __LINE__, $url, 'debug');
		if($test != '1') {
			$data = array(
				'title' => $title,
				'thumb' => $thumb,
				'url' => $url
			);
			$id = $this->article_model->add($data);
		}
		if($id > 0) {
			$result = 'ok';
		}
		$json = array('status' => $result);
		echo $jsoncallback . '(' . json_encode($json) . ')';
	}


}