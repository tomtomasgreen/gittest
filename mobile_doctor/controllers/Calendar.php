<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('calendar_model');
	}
	
	function edit() {
		$cur_day = date('w');
		if($cur_day == 0) $cur_day = 7;
		// echo $cur_day;exit;
		$today = date('Y-m-d', $this->_timestamp);
		$start = strtotime($today);
		$week_start = $start - ($cur_day - 1) * 60 * 60 * 24;
		$week_end = $week_start + 60 * 60 * 24 * 7 - 1;
		
		if($_POST) {
			$week_start = $this->input->post('week_start');
			$job_1_1 = $this->input->post('job_1_1');
			$job_1_2 = $this->input->post('job_1_2');
			$job_2_1 = $this->input->post('job_2_1');
			$job_2_2 = $this->input->post('job_2_2');
			$job_3_1 = $this->input->post('job_3_1');
			$job_3_2 = $this->input->post('job_3_2');
			$job_4_1 = $this->input->post('job_4_1');
			$job_4_2 = $this->input->post('job_4_2');
			$job_5_1 = $this->input->post('job_5_1');
			$job_5_2 = $this->input->post('job_5_2');
			$job_6_1 = $this->input->post('job_6_1');
			$job_6_2 = $this->input->post('job_6_2');
			$job_7_1 = $this->input->post('job_7_1');
			$job_7_2 = $this->input->post('job_7_2');
			$jobs = array(
				'job_1_1' => $job_1_1,
				'job_1_2' => $job_1_2,
				'job_2_1' => $job_2_1,
				'job_2_2' => $job_2_2,
				'job_3_1' => $job_3_1,
				'job_3_2' => $job_3_2,
				'job_4_1' => $job_4_1,
				'job_4_2' => $job_4_2,
				'job_5_1' => $job_5_1,
				'job_5_2' => $job_5_2,
				'job_6_1' => $job_6_1,
				'job_6_2' => $job_6_2,
				'job_7_1' => $job_7_1,
				'job_7_2' => $job_7_2
			);
			$jobs = json_encode($jobs);
			$data = array(
				'doctorid' => $this->_loginuser,
				'weekstart' => $week_start,
				'weekstarts' => date('Y-m-d', $week_start),
				'jobs' => $jobs
			);
			$result = $this->calendar_model->update($data);
			$json = array('result' => $result);
			echo json_encode($json);
		} else {
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
			$this->data['week_start'] = $week_start;
			$this->data['jobs'] = $jobs;
			$this->load->view('calendar/edit', $this->data);
		}
	}
	


}