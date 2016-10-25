<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends NN_Controller {
	
	private $_start, $_end;
	
	function __construct() {
		parent::__construct();
		
		$endStr = date('Y-m-d', $this->_timestamp);
		$this->_end = strtotime($endStr);
		$this->_start = $this->_end - 60 * 60 * 24 * 7;
		$this->_end += 60 * 60 * 24 - 1;
		
		$this->load->model('recordsugar_model');
		$this->load->model('recordpressure_model');
		$this->load->model('recordfood_model');
		$this->load->model('recorddrug_model');
		$this->load->model('recordbmi_model');
		$this->load->model('recordwhr_model');
		$this->load->model('recordvisit_model');
		$this->load->model('recordbox_model');
		$this->load->model('recordprotein_model');
		$this->load->model('box_model');
		$this->load->model('user_model');
		$this->load->model('scorelog_model');
	}
	
	function index() {
		$this->load->view('record/index', $this->data);
	}
	
	// function show() {
		// $sugar_records_1 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '空腹', 10);
		// $sugar_records_2 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '早餐后', 10);
		// $sugar_records_3 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '午餐前', 10);
		// $sugar_records_4 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '午餐后', 10);
		// $sugar_records_5 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '晚餐前', 10);
		// $sugar_records_6 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '晚餐后', 10);
		// $sugar_records_7 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '睡前', 10);
		// $sugar_records_8 = $this->recordsugar_model->get_by_userid_and_type_limit($this->_loginuser, '凌晨', 10);
		// $this->data['sugar_records_1'] = $sugar_records_1;
		// $this->data['sugar_records_2'] = $sugar_records_2;
		// $this->data['sugar_records_3'] = $sugar_records_3;
		// $this->data['sugar_records_4'] = $sugar_records_4;
		// $this->data['sugar_records_5'] = $sugar_records_5;
		// $this->data['sugar_records_6'] = $sugar_records_6;
		// $this->data['sugar_records_7'] = $sugar_records_7;
		// $this->data['sugar_records_8'] = $sugar_records_8;
		// $this->load->view('record/show', $this->data);
	// }
	
	function show() {
		$startday = date('Y-m-d', $this->_timestamp - 60 * 60 * 24 * 6);
		$start = strtotime($startday);
		$records_1 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '空腹', $start);
		$records_2 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '早餐后', $start);
		$records_3 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '午餐前', $start);
		$records_4 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '午餐后', $start);
		$records_5 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '晚餐前', $start);
		$records_6 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '晚餐后', $start);
		$records_7 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '睡前', $start);
		$records_8 = $this->recordsugar_model->get_by_userid_and_type_since($this->_loginuser, '凌晨', $start);
		
		$sugar_empty = config_item('sugar_empty');
		$sugar_full = config_item('sugar_full');
		$low_empty = $sugar_empty[0];
		$high_empty = $sugar_empty[1];
		$low_full = $sugar_full[0];
		$high_full = $sugar_full[1];
		
		$records = array();
		$yesterday = $start;
		for($i = 0; $i < 7; $i++) {
			$now = $start + 60 * 60 * 24 * $i;
			$day = date('m-d', $now);
			$end = $now + 60 * 60 * 24;
			$records[$i] = array(
				'time' => $day,
				'data' => array(
					'', '', '', '', '', '', '', ''
				),
				'sugar' => array(
					'', '', '', '', '', '', '', ''
				)
			);
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_1); $j++) {
				if($records_1[$j]['measuretime'] >= $yesterday && $records_1[$j]['measuretime'] < $end) {
					$sugar = $records_1[$j]['sugar'];
					if($records_1[$j]['sugar'] < $low_empty) {
						$status = 'low';
					} else if($records_1[$j]['sugar'] < $high_empty) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][0] = $status;
			$records[$i]['sugar'][0] = $sugar;
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_2); $j++) {
				if($records_2[$j]['measuretime'] >= $yesterday && $records_2[$j]['measuretime'] < $end) {
					$sugar = $records_2[$j]['sugar'];
					$status = '';
					if($records_2[$j]['sugar'] < $low_full) {
						$status = 'low';
					} else if($records_2[$j]['sugar'] < $high_full) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][1] = $status;
			$records[$i]['sugar'][1] = $sugar;
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_3); $j++) {
				if($records_3[$j]['measuretime'] >= $yesterday && $records_3[$j]['measuretime'] < $end) {
					$sugar = $records_3[$j]['sugar'];
					$status = '';
					if($records_3[$j]['sugar'] < $low_empty) {
						$status = 'low';
					} else if($records_3[$j]['sugar'] < $high_empty) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][2] = $status;
			$records[$i]['sugar'][2] = $sugar;
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_4); $j++) {
				if($records_4[$j]['measuretime'] >= $yesterday && $records_4[$j]['measuretime'] < $end) {
					$sugar = $records_4[$j]['sugar'];
					$status = '';
					if($records_4[$j]['sugar'] < $low_full) {
						$status = 'low';
					} else if($records_4[$j]['sugar'] < $high_full) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][3] = $status;
			$records[$i]['sugar'][3] = $sugar;
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_5); $j++) {
				if($records_5[$j]['measuretime'] >= $yesterday && $records_5[$j]['measuretime'] < $end) {
					$sugar = $records_5[$j]['sugar'];
					$status = '';
					if($records_5[$j]['sugar'] < $low_empty) {
						$status = 'low';
					} else if($records_5[$j]['sugar'] < $high_empty) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][4] = $status;
			$records[$i]['sugar'][4] = $sugar;
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_6); $j++) {
				if($records_6[$j]['measuretime'] >= $yesterday && $records_6[$j]['measuretime'] < $end) {
					$sugar = $records_6[$j]['sugar'];
					$status = '';
					if($records_6[$j]['sugar'] < $low_full) {
						$status = 'low';
					} else if($records_6[$j]['sugar'] < $high_full) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][5] = $status;
			$records[$i]['sugar'][5] = $sugar;
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_7); $j++) {
				if($records_7[$j]['measuretime'] >= $yesterday && $records_7[$j]['measuretime'] < $end) {
					$sugar = $records_7[$j]['sugar'];
					$status = '';
					if($records_7[$j]['sugar'] < $low_empty) {
						$status = 'low';
					} else if($records_7[$j]['sugar'] < $high_empty) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][6] = $status;
			$records[$i]['sugar'][6] = $sugar;
			$status = '';
			$sugar = '';
			for($j = 0; $j < count($records_8); $j++) {
				if($records_8[$j]['measuretime'] >= $yesterday && $records_8[$j]['measuretime'] < $end) {
					$sugar = $records_8[$j]['sugar'];
					$status = '';
					if($records_8[$j]['sugar'] < $low_full) {
						$status = 'low';
					} else if($records_8[$j]['sugar'] < $high_full) {
						$status = 'ok';
					} else {
						$status = 'high';
					}
					break;
				}
			}
			$records[$i]['data'][7] = $status;
			$records[$i]['sugar'][7] = $sugar;
			$yesterday = $end;
		}
		
		$this->data['records'] = $records;
		$this->load->view('record/show', $this->data);
	}
	function show_pressure() {
		$pressure_records = $this->recordpressure_model->get_by_userid_limit($this->_loginuser, 10);
		$this->data['pressure_records'] = $pressure_records;
		$this->load->view('record/show_pressure', $this->data);
	}
	function show_food() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$food_records = $this->recordfood_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['food_records'] = $food_records;
		$this->load->view('record/show_food', $this->data);
	}
	function show_drug() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$drug_records = $this->recorddrug_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['drug_records'] = $drug_records;
		$this->load->view('record/show_drug', $this->data);
	}
	function show_bmi() {
		$bmi_records = $this->recordbmi_model->get_by_userid_limit($this->_loginuser, 10);
		$this->data['bmi_records'] = $bmi_records;
		$this->load->view('record/show_bmi', $this->data);
	}
	function show_visit() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$visit_records = $this->recordvisit_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['visit_records'] = $visit_records;
		$this->load->view('record/show_visit', $this->data);
	}
	function show_whr() {
		$whr_records = $this->recordwhr_model->get_by_userid_limit($this->_loginuser, 10);
		$this->data['whr_records'] = $whr_records;
		$this->load->view('record/show_whr', $this->data);
	}
	function show_protein() {
		$protein_records = $this->recordprotein_model->get_by_userid_limit($this->_loginuser, 10);
		$this->data['protein_records'] = $protein_records;
		$this->load->view('record/show_protein', $this->data);
	}
	
	function more() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$records = $this->recordsugar_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['records'] = $records;
		$this->load->view('record/more', $this->data);
	}
	
	function more_pressure() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$records = $this->recordpressure_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['records'] = $records;
		$this->load->view('record/more_pressure', $this->data);
	}
	
	function more_bmi() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$records = $this->recordbmi_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['records'] = $records;
		$this->load->view('record/more_bmi', $this->data);
	}
	
	function more_whr() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$records = $this->recordwhr_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['records'] = $records;
		$this->load->view('record/more_whr', $this->data);
	}
	
	function more_protein() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$records = $this->recordprotein_model->get_by_userid_and_time($this->_loginuser, $this->_start, $this->_end);
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['records'] = $records;
		$this->load->view('record/more_protein', $this->data);
	}
	
	function box() {
		if($_POST) {
			$startStr = $this->input->post('start');
			$endStr = $this->input->post('end');
			$this->_start = $startStr ? strtotime($startStr) : 0;
			$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
		}
		$box = $this->box_model->get_by_userid($this->_loginuser);
		$records = array();
		if($box) {
			$records = $this->recordbox_model->get_by_userid_and_sn_and_time($this->_loginuser, $box['sn'], $this->_start, $this->_end);
		}
		$this->data['box'] = $box;
		$this->data['start'] = $this->_start;
		$this->data['end'] = $this->_end;
		$this->data['records'] = $records;
		$this->load->view('record/box', $this->data);
	}
	
	function save() {
		$record = $this->input->post('record');
		$measuredate = $this->input->post('measuredate');
		$measuretime = $this->input->post('measuretime');
		$measuretimes = $measuredate . ' ' . $measuretime;
		$measuretime = strtotime($measuretimes);
		$data = array(
			'userid' => $this->_loginuser,
			'measuretime' => $measuretime,
			'measuretimes' => $measuretimes
		);
		$result = -1;
		$start = date('Y-m-d 00:00:00', $this->_timestamp);
		$start = strtotime($start) - 1;
		if($record == 'sugar') {
			$typeid_arr = array(
				'凌晨' => 1,
				'空腹' => 2,
				'早餐后' => 3,
				'午餐前' => 4,
				'午餐后' => 5,
				'晚餐前' => 6,
				'晚餐后' => 7,
				'睡前' => 8
			);
			$data['type'] = $this->input->post('type');
			$data['typeid'] = $typeid_arr[$data['type']];
			$data['sugar'] = $this->input->post('sugar');
			$result = $this->recordsugar_model->add($data);
			$scorelogs = $this->scorelog_model->get_record_by_userid_and_time($this->_loginuser, $start, 'SUGAR');
			if(count($scorelogs) < 1) {
				$this->user_model->receive_money($this->_loginuser, 3, 'RECORD_SUGAR');
			}
		} else if($record == 'pressure') {
			$data['high'] = $this->input->post('high');
			$data['low'] = $this->input->post('low');
			$result = $this->recordpressure_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		} else if($record == 'food') {
			$data['photo'] = $this->input->post('photo');
			$typeid_arr = array(
				'早餐' => 1,
				'午餐' => 2,
				'晚餐' => 3,
				'加餐' => 4
			);
			$data['type'] = $this->input->post('type');
			$data['typeid'] = $typeid_arr[$data['type']];
			$data['content'] = $this->input->post('content');
			$result = $this->recordfood_model->add($data);
			$scorelogs = $this->scorelog_model->get_record_by_userid_and_time($this->_loginuser, $start, 'FOOD');
			if(count($scorelogs) < 1) {
				$this->user_model->receive_money($this->_loginuser, 1, 'RECORD_FOOD');
			}
		} else if($record == 'drug') {
			$data['photo'] = $this->input->post('photo');
			$typeid_arr = array(
				'早餐' => 1,
				'午餐' => 2,
				'晚餐' => 3,
				'其他' => 4
			);
			$data['type'] = $this->input->post('type');
			$data['typeid'] = $typeid_arr[$data['type']];
			$data['content'] = $this->input->post('content');
			$result = $this->recorddrug_model->add($data);
			$scorelogs = $this->scorelog_model->get_record_by_userid_and_time($this->_loginuser, $start, 'DRUG');
			if(count($scorelogs) < 1) {
				$this->user_model->receive_money($this->_loginuser, 3, 'RECORD_DRUG');
			}
		} else if($record == 'visit') {
			$data['photo'] = $this->input->post('photo');
			$typeid_arr = array(
				'取药' => 1,
				'化验' => 2,
				'复查' => 3,
				'新患者就诊' => 4,
				'其他' => 5
			);
			$data['type'] = $this->input->post('type');
			$data['typeid'] = $typeid_arr[$data['type']];
			$data['content'] = $this->input->post('content');
			$result = $this->recordvisit_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 5, 'RECORD');
		} else if($record == 'bmi') {
			$data['height'] = $this->input->post('height');
			$data['weight'] = $this->input->post('weight');
			$data['bmi'] = round($data['weight'] / $data['height'] / $data['height'] * 10000, 1);
			$result = $this->recordbmi_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		} else if($record == 'whr') {
			$data['waist'] = $this->input->post('waist');
			$data['hip'] = $this->input->post('hip');
			$data['whr'] = round($data['waist'] / $data['hip'] * 100, 1);
			$result = $this->recordwhr_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		} else if($record == 'protein') {
			$data['protein'] = $this->input->post('protein');
			$result = $this->recordprotein_model->add($data);
			// $this->user_model->receive_money($this->_loginuser, 2, 'RECORD');
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	


}