<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('question_model');
		$this->load->model('answer_model');
	}
	
	function index() {
		$questions = $this->question_model->get_all_page(1, config_item('perpage_question'));
		$myquestions = $this->question_model->get_by_userid($this->_loginuser);
		$this->data['questions'] = $questions;
		$this->data['myquestions'] = $myquestions;
		$this->load->view('question/index', $this->data);
	}
	
	function load_page() {
		$page = $this->input->post('page');
		$questions = $this->question_model->get_all_page($page, config_item('perpage_question'));
		for($i = 0; $i < count($questions); $i++) {
			$questions[$i]['createtimes'] = date('Y-m-d H:i', $questions[$i]['createtime']);
		}
		echo json_encode($questions);
	}
	
	function search() {
		$questions = array();
		$title = '';
		$type = 'all';
		if($_POST) {
			$title = $this->input->post('title');
			$type = $this->input->post('type');
			$questions = $this->question_model->search($title, $type, $this->_loginuser);
			$this->data['title'] = $title;
			$this->data['type'] = $type;
		}
		$this->data['title'] = $title;
		$this->data['type'] = $type;
		$this->data['questions'] = $questions;
		$this->load->view('question/search', $this->data);
	}
	
	function show($id = 0) {
		if($id) {
			$question = $this->question_model->get_by_id($id);
			$answers = $this->answer_model->get_by_questionid($id);
			if($question) {
				$this->data['question'] = $question;
				$this->data['answers'] = $answers;
				$this->load->view('question/show', $this->data);
			} else {
				exit('问题不存在');
			}
		} else {
			exit('问题不存在');
		}
	}
	
	function create() {
		if($_POST) {
			$result = 0;
			$content = $this->input->post('content');
			$has_dirty_word = FALSE;
			$dirty_words = config_item('dirty_words');
			for($i = 0; $i < count($dirty_words); $i++) {
				if(strpos($content, $dirty_words[$i]) !== FALSE) {
					$has_dirty_word = TRUE;
					break;
				}
			}
			if($has_dirty_word) {
				$result = -1;
			} else {
				$data = array(
					'userid' => $this->_loginuser,
					'title' => $this->input->post('title'),
					'photos' => $this->input->post('photos'),
					'content' => $content
				);
				$result = $this->question_model->add($data);
			}
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
			$myquestions = $this->question_model->get_by_userid($this->_loginuser);
			$this->data['myquestions'] = $myquestions;
			$this->load->view('question/create', $this->data);
		}
	}
	


}