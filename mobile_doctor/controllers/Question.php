<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends NN_Controller {
	
	protected $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->model('question_model');
	}
	
	function index() {
		$questions = $this->question_model->get_all_page(1, config_item('perpage_question'));
		$this->data['questions'] = $questions;
		$this->load->view('question/index', $this->data);
	}
	
	function show($id = 0) {
		if($id) {
			$question = $this->question_model->get_by_id($id);
			if($question) {
				$this->data['question'] = $question;
				$this->load->view('question/show', $this->data);
			} else {
				exit('问题不存在');
			}
		} else {
			exit('问题不存在');
		}
	}
	
	function play() {
		$this->load->view('question/play', $this->data);
	}
	
	function collect() {
		$this->load->view('question/collect', $this->data);
	}
	


}