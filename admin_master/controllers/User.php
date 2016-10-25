<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('recordsugar_model');
		$this->load->model('recordpressure_model');
		$this->load->model('recordfood_model');
		$this->load->model('recorddrug_model');
		$this->load->model('recordbox_model');
		$this->load->model('recordprotein_model');
		$this->load->model('recordbmi_model');
		$this->load->model('recordvisit_model');
		$this->load->model('recordwhr_model');
	}
	
	function record($userid = 0) {
		$sugar_records_1 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '空腹', 'time');
		$sugar_records_2 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '早餐后', 'time');
		$sugar_records_3 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '午餐前', 'time');
		$sugar_records_4 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '午餐后', 'time');
		$sugar_records_5 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '晚餐前', 'time');
		$sugar_records_6 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '晚餐后', 'time');
		$sugar_records_7 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '睡前', 'time');
		$sugar_records_8 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '凌晨', 'time');
		$pressure_records = $this->recordpressure_model->get_by_userid_limit($userid, 'time');
		$food_records = $this->recordfood_model->get_by_userid($userid, 'time');
		$drug_records = $this->recorddrug_model->get_by_userid($userid, 'time' );
		$visit_records = $this->recordvisit_model->get_by_userid($userid, 'time' );
		$protein_records = $this->recordprotein_model->get_by_userid_limit($userid, 'time');
		$bmi_records = $this->recordbmi_model->get_by_userid_bmi($userid, 'time');
		$whr_records = $this->recordwhr_model->get_by_userid_whr($userid, 'time');
		$this->data['sugar_records_1'] = $sugar_records_1;
		$this->data['sugar_records_2'] = $sugar_records_2;
		$this->data['sugar_records_3'] = $sugar_records_3;
		$this->data['sugar_records_4'] = $sugar_records_4;
		$this->data['sugar_records_5'] = $sugar_records_5;
		$this->data['sugar_records_6'] = $sugar_records_6;
		$this->data['sugar_records_7'] = $sugar_records_7;
		$this->data['sugar_records_8'] = $sugar_records_8;
		$this->data['pressure_records'] = $pressure_records;
		$this->data['food_records'] = $food_records;
		$this->data['drug_records'] = $drug_records;
		$this->data['protein_records'] = $protein_records;
		$this->data['bmi_records'] = $bmi_records;
		$this->data['whr_records'] = $whr_records;
		$this->data['visit_records'] = $visit_records;
		$this->data['status'] = "一个月内" ;
		$this->data['userid'] = $userid ;
		$start_d = mktime(0,0,0,date('m'),date('d')-30,date('Y'));
		$end_d = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		$start_d = date('Y-m-d ',$start_d);
		$end_d = date('Y-m-d ',$end_d);
		$this->data['start_d'] = $start_d ;
		$this->data['end_d'] = $end_d ;
		$this->load->view('user/record', $this->data);
	}
	
	function search() {
		$userid = $this->input->get('userid') ;
		$start_date = $this->input->post('start-date') ;
		$start_hour = $this->input->post('start-hour') ;
		$end_date = $this->input->post('end-date') ;
		$end_hour = $this->input->post('end-hour') ;
		if($start_date == "" || $start_date == "最早"){
			$time_s = "time" ;
		}else{
			$time_s = strtotime("{$start_date} {$start_hour}:00:00");
		}
		if($end_date == "" || $end_date == "至今" ){
			$time_e = "time" ;
		}else{
			$time_e = strtotime("{$end_date} {$end_hour}:00:00");
		}

		$sugar_records_1 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '空腹', $time_s , $time_e );
		$sugar_records_2 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '早餐后', $time_s , $time_e );
		$sugar_records_3 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '午餐前', $time_s , $time_e );
		$sugar_records_4 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '午餐后', $time_s , $time_e );
		$sugar_records_5 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '晚餐前', $time_s , $time_e );
		$sugar_records_6 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '晚餐后', $time_s , $time_e );
		$sugar_records_7 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '睡前', $time_s , $time_e );
		$sugar_records_8 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '凌晨', $time_s , $time_e );
		$pressure_records = $this->recordpressure_model->get_by_userid_limit($userid, $time_s , $time_e );
		$food_records = $this->recordfood_model->get_by_userid($userid , $time_s , $time_e );
		$drug_records = $this->recorddrug_model->get_by_userid($userid , $time_s , $time_e );
		$bmi_records = $this->recordbmi_model->get_by_userid_bmi($userid, $time_s , $time_e );
		$whr_records = $this->recordwhr_model->get_by_userid_whr($userid, $time_s , $time_e );
		$visit_records = $this->recordvisit_model->get_by_userid($userid, $time_s , $time_e );
		$protein_records = $this->recordprotein_model->get_by_userid_limit($userid, $time_s , $time_e );
		$this->data['sugar_records_1'] = $sugar_records_1;
		$this->data['sugar_records_2'] = $sugar_records_2;
		$this->data['sugar_records_3'] = $sugar_records_3;
		$this->data['sugar_records_4'] = $sugar_records_4;
		$this->data['sugar_records_5'] = $sugar_records_5;
		$this->data['sugar_records_6'] = $sugar_records_6;
		$this->data['sugar_records_7'] = $sugar_records_7;
		$this->data['sugar_records_8'] = $sugar_records_8;
		$this->data['pressure_records'] = $pressure_records;
		$this->data['food_records'] = $food_records;
		$this->data['drug_records'] = $drug_records;
		$this->data['bmi_records'] = $bmi_records;
		$this->data['whr_records'] = $whr_records;
		$this->data['visit_records'] = $visit_records;
		$this->data['protein_records'] = $protein_records;
		if($time_s == 'time'){
			$start_date = "最早" ;
		}
		if($time_e == 'time'){
			$end_date = "至今" ;
		}
		$this->data['status'] = $start_date." 到 ".$end_date." " ;
		$this->data['userid'] = $userid ;
		$this->data['start_d'] = $start_date ;
		$this->data['end_d'] = $end_date ;
		$this->load->view('user/record', $this->data);
	}
	
	function export() {
		$userid = $this->input->get('userid') ;
		$start_date = $this->input->post('start-date') ;
		$start_hour = $this->input->post('start-hour') ;
		$end_date = $this->input->post('end-date') ;
		$end_hour = $this->input->post('end-hour') ;
		if($start_date == "" || $start_date == "最早"){
			$time_s = "time" ;
		}else{
			$time_s = strtotime("{$start_date} {$start_hour}:00:00");
		}
		if($end_date == "" || $end_date == "至今" ){
			$time_e = "time" ;
		}else{
			$time_e = strtotime("{$end_date} {$end_hour}:00:00");
		}

		$sugar_records = $this->recordsugar_model->get_by_userid_and_type_sugar($userid , $time_s , $time_e );
		$pressure_records = $this->recordpressure_model->get_by_userid_limit($userid, $time_s , $time_e );
		$protein_records = $this->recordprotein_model->get_by_userid_limit($userid, $time_s , $time_e );
		$this->data['sugar_records'] = $sugar_records;
		$this->data['pressure_records'] = $pressure_records;
		$this->data['protein_records'] = $protein_records;
		
		if($time_s == 'time'){
			$start_date = "最早" ;
		}
		if($time_e == 'time'){
			$end_date = "至今" ;
		}
		$this->data['status'] = $start_date." 到 ".$end_date." " ;
		$this->data['userid'] = $userid ;
		$this->data['start_d'] = $start_date ;
		$this->data['end_d'] = $end_date ;
		$this->load->view('user/export', $this->data);
	}


}