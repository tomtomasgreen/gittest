<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Collect extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('collect_model');
		$this->load->model('collectanswer_model');
		$this->load->model('collectcard_model');
		$this->load->model('question_model');
		$this->load->model('answer_model');
		$this->load->model('package_model');
	}
	
	function index() {
		$collect_not_finished = $this->collect_model->get_not_finished($this->_loginuser);
		$doctor = $this->doctor_model->get_by_id($this->_loginuser);
		$card = $this->collectcard_model->get_by_doctorid($this->_loginuser);
		if($collect_not_finished) {
			$validtime = $collect_not_finished['createtime'] + 60 * 60 * 24 * 30 + $collect_not_finished['delay'];
			if($validtime < $this->_timestamp) {
				$this->collect_model->invalid_collect($collect_not_finished['id']);
				$collect_not_finished = false;
			}
		}
		
		$this->data['collect_not_finished'] = $collect_not_finished;
		$this->data['card'] = $card;
		$this->data['doctor'] = $doctor;
		$this->load->view('collect/index', $this->data);
	}
	
	function history() {
		$collects1 = $this->collect_model->get_history_collects($this->_loginuser);
		$collects2 = $this->collect_model->get_invalid_collects($this->_loginuser);
		$this->data['collects1'] = $collects1;
		$this->data['collects2'] = $collects2;
		$this->load->view('collect/history', $this->data);
	}
	
	function card() {
		$cards = $this->collectcard_model->get_by_doctorid($this->_loginuser);
		$doctor = $this->doctor_model->get_by_id($this->_loginuser);
		$this->data['cards'] = $cards;
		$this->data['doctor'] = $doctor;
		$this->load->view('collect/card', $this->data);
	}
	
	function detail($id = 0) {
		if($id) {
			$collect = $this->collect_model->get_by_id($id);
			$questions = $this->collectanswer_model->get_by_collectid($id);
			if($collect) {
				$this->data['collect'] = $collect;
				$this->data['questions'] = $questions;
				$this->load->view('collect/detail', $this->data);
			} else {
				exit('题集不存在');
			}
		} else {
			exit('题集不存在');
		}
	}
	
	function play($id = 0) {
		if($id) {
			$collect = $this->collect_model->get_by_id($id);
			$questions = $this->collectanswer_model->get_by_collectid($id);
			if($collect) {
				$this->data['collect'] = $collect;
				$this->data['questions'] = $questions;
				$this->load->view('collect/play', $this->data);
			} else {
				exit('题集不存在');
			}
		} else {
			exit('题集不存在');
		}
	}
	
	function result($id = 0) {
		luiji_log(__FILE__, __LINE__, 'Start - ' . $id, 'certificate');
		if($id) {
			$collect = $this->collect_model->get_by_id($id);
			if($collect) {
				luiji_log(__FILE__, __LINE__, 'collect exist', 'certificate');
				luiji_log(__FILE__, __LINE__, '$this->_loginuser - ' . $this->_loginuser, 'certificate');
				$doctor = $this->doctor_model->get_by_id($this->_loginuser);
				$certificate = $_SERVER['DOCUMENT_ROOT'] . '/guanhuai/public/certificate/' . $collect['sn'] . '.jpg';
				luiji_log(__FILE__, __LINE__, 'certificate - ' . $certificate, 'certificate');
				if(!file_exists($certificate)) {
					luiji_log(__FILE__, __LINE__, 'certificate not exist', 'certificate');
					$_certificate = new NN_Certificate();
					$_certificate->generate_certificate($_SERVER['DOCUMENT_ROOT'] . '/guanhuai/public/', $doctor['username'], date('Y年m月d日', $this->_timestamp), $collect['sn']);
					luiji_log(__FILE__, __LINE__, 'certificate generated', 'certificate');
				} else {
					luiji_log(__FILE__, __LINE__, 'certificate already exist', 'certificate');
				}
				$this->data['collect'] = $collect;
				$this->load->view('collect/result', $this->data);
			} else {
				exit('题集不存在');
			}
		} else {
			exit('题集不存在');
		}
	}
	
	function repair_cert($collectid) {
		$collect = $this->collect_model->get_by_id($collectid);
		if($collect) {
			$doctor = $this->doctor_model->get_by_id($collect['doctorid']);
			$_certificate = new NN_Certificate();
			$_certificate->generate_certificate($_SERVER['DOCUMENT_ROOT'] . '/guanhuai/public/', $doctor['username'], date('Y年m月d日', $collect['submittime']), $collect['sn']);
			//echo '修复成功！';
		} else {
			exit('题集不存在');
		}
	}
	
	function load_collect() {
		$id = $this->input->post('id');
		$questions = $this->collectanswer_model->get_by_collectid($id);
		echo json_encode($questions);
	}
	
	function submit_answer() {
		$result = 0;
		$id = $this->input->post('id');
		$answer = $this->input->post('answer');
		$has_dirty_word = FALSE;
		if($answer) {
			$dirty_words = config_item('dirty_words');
			for($i = 0; $i < count($dirty_words); $i++) {
				if(strpos($answer, $dirty_words[$i]) !== FALSE) {
					$has_dirty_word = TRUE;
					break;
				}
			}
		}
		if($has_dirty_word) {
			$result = -1;
		} else {
			$data = array(
				'content' => $answer
			);
			$result = $this->collectanswer_model->update_by_id($id, $data);
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function submit_collect() {
		$collectid = $this->input->post('collectid');
		$questions = $this->collectanswer_model->get_by_collectid($collectid);
		$answers = array();
		for($i = 0; $i < count($questions); $i++) {
			$answers[$i] = array(
				'questionid' => $questions[$i]['qid'],
				'doctorid' => $this->_loginuser,
				'content' => $questions[$i]['answer']
			);
		}
		$this->answer_model->add_collect($answers);
		$result = $this->collect_model->submit_collect($collectid);
		$this->repair_cert($collectid);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function generate() {
		luiji_log(__FILE__, __LINE__, 'User：' . $this->_loginuser, 'generate');
		$result = 0;
		$lastest_collect = $this->collect_model->get_lastest_collect($this->_loginuser);
		if($lastest_collect) {
			if(($this->_timestamp - $lastest_collect['createtime']) < 60 * 60 * 24 * 30) {
				$result = -2;
			} else {
				$collects_year = $this->collect_model->get_collects_year($this->_loginuser, $this->_timestamp);
				if(count($collects_year) >= 4) {
					$result = -3;
				}
			}
		}
		if($result == 0) {
			$type = 40;
			$cardid = $this->input->post('cardid');
			$questions_all = $this->question_model->get_new_questions($this->_loginuser);
			if($type > count($questions_all)) {
				$result = -1;
			} else {
				shuffle($questions_all);
				$questions = '';
				$answers = array();
				for($i = 0; $i < $type; $i++) {
					if($i == 0) $questions .= $questions_all[$i]['id'];
					else $questions .= ',' . $questions_all[$i]['id'];
					$answers[$i] = array(
						'doctorid' => $this->_loginuser,
						'questionid' => $questions_all[$i]['id']
					);
				}
				$data = array(
					'doctorid' => $this->_loginuser,
					'type' => $type,
					'questions' => $questions
				);
				$result = $this->collect_model->add($data);
				$this->collect_model->sn_collect($result);
				for($i = 0; $i < count($answers); $i++) {
					$answers[$i]['collectid'] = $result;
				}
				$this->collectanswer_model->add_collect($answers);
				$this->collectcard_model->use_card($cardid);
			}
		}
		luiji_log(__FILE__, __LINE__, 'Result：' . $result, 'generate');
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function generate_card() {
		$result = 0;
		$cards = $this->collectcard_model->get_by_doctorid($this->_loginuser);
		if($cards) {
			$result = -1;
		} else {
			$data = array(
				'doctorid' => $this->_loginuser
			);
			$result = $this->collectcard_model->add($data);
			$this->collectcard_model->sn($result);
			$this->doctor_model->cost_money($this->_loginuser, config_item('collect_cost'), 'NEW_COLLECT');
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function package_buy() {
		$result = 0;
		$data = array(
			'doctorid' => $this->_loginuser
		);
		$result = $this->package_model->add($data);
		$this->package_model->sn($result);
		$this->doctor_model->cost_money($this->_loginuser, config_item('package_cost'), 'BUY_PACKAGE');
		$json = array('result' => $result);
		echo json_encode($json);
	}
	


}