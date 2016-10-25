<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('article_model');
	}
	
	function index() {
		$articles = $this->article_model->get_all_page(1, config_item('perpage_article'));
		$this->data['articles'] = $articles;
		$this->load->view('article/index', $this->data);
	}
	
	function show($id = 0) {
		if($id) {
			$article = $this->article_model->get_by_id($id);
			if($article) {
				$this->data['article'] = $article;
				$this->load->view('article/show', $this->data);
			} else {
				exit('文章不存在');
			}
		} else {
			exit('文章不存在');
		}
	}
	
	function url() {
		$url = $this->input->get('url');
		if($url) {
			$this->data['url'] = $url;
			$this->load->view('article/url', $this->data);
		} else {
			exit('文章不存在');
		}
	}


}