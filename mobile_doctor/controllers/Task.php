<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('mission_model');
		$this->load->model('calendar_model');
	}
	
	function index() {
		$missions = $this->mission_model->get_valid_by_doctorid($this->_loginuser, $this->_timestamp);
		$cur_day = date('w');
		if($cur_day == 0) $cur_day = 7;
		$today = date('Y-m-d', $this->_timestamp);
		$start = strtotime($today);
		$week_start = $start - ($cur_day - 1) * 60 * 60 * 24;
		$week_end = $week_start + 60 * 60 * 24 * 7 - 1;
		
		$calendar = $this->calendar_model->get_by_doctorid_and_time($this->_loginuser, $week_start);
		$jobs = array();
		if($calendar) {
			$_jobs = json_decode($calendar['jobs']);
			$jobs = array(
				array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * 0),
					'am' => $_jobs->job_1_1,
					'pm' => $_jobs->job_1_2
				),
				array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * 1),
					'am' => $_jobs->job_2_1,
					'pm' => $_jobs->job_2_2
				),
				array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * 2),
					'am' => $_jobs->job_3_1,
					'pm' => $_jobs->job_3_2
				),
				array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * 3),
					'am' => $_jobs->job_4_1,
					'pm' => $_jobs->job_4_2
				),
				array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * 4),
					'am' => $_jobs->job_5_1,
					'pm' => $_jobs->job_5_2
				),
				array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * 5),
					'am' => $_jobs->job_6_1,
					'pm' => $_jobs->job_6_2
				),
				array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * 6),
					'am' => $_jobs->job_7_1,
					'pm' => $_jobs->job_7_2
				)
			);
		} else {
			for($i = 0; $i < 7; $i++) {
				$jobs_day = array(
					'day' => date('m-d', $week_start + 60 * 60 * 24 * $i),
					'am' => '',
					'pm' => ''
				);
				$jobs[] = $jobs_day;
			}
		}
		
		$this->data['jobs'] = $jobs;
		$this->data['week_start'] = $week_start;
		$this->data['week_end'] = $week_end;
		$this->data['missions'] = $missions;
		$this->load->view('task/index', $this->data);
	}

}