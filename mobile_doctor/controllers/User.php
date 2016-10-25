<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends NN_Controller {
	
	private $_start, $_end;
	
	function __construct() {
		parent::__construct();
		
		$endStr = date('Y-m-d', $this->_timestamp);
		$this->_end = strtotime($endStr);
		$this->_start = $this->_end - 60 * 60 * 24 * 30;
		$this->_end += 60 * 60 * 24 - 1;
		
		$this->load->model('user_model');
		$this->load->model('dossier_model');
		$this->load->model('recordsugar_model');
		$this->load->model('recordpressure_model');
		$this->load->model('recordfood_model');
		$this->load->model('recorddrug_model');
		$this->load->model('recordbmi_model');
		$this->load->model('recordwhr_model');
		$this->load->model('recordvisit_model');
		$this->load->model('recordbox_model');
		$this->load->model('recordprotein_model');
		$this->load->model('relation_model');
		$this->load->model('chat_model');
		$this->load->model('box_model');
		$this->load->model('doctor_model');
	}
	
	function index() {
		$chats = $this->chat_model->get_chats($this->_loginuser);
		$chats1 = array();
		$chats2 = array();
		for($i = 0; $i < count($chats); $i++) {
			if($chats[$i]['readtime'] || $chats[$i]['from'] == 'doctor') {
				$chats2[] = $chats[$i];
			} else {
				$chats1[] = $chats[$i];
			}
		}
		$this->data['chats1'] = $chats1;
		$this->data['chats2'] = $chats2;
		$users = $this->user_model->get_by_doctorid($this->_loginuser);
		$users_unaccepted = $this->user_model->get_unaccepted_by_doctorid($this->_loginuser);
		$users_unchecked = $this->user_model->get_unchecked_by_doctorid($this->_loginuser);
		$this->data['users'] = $users;
		$this->data['users_unaccepted'] = $users_unaccepted;
		$this->data['users_unchecked'] = $users_unchecked;
		$this->load->view('user/index', $this->data);
	}
	
	function bind_accept() {
		$userid = $this->input->post('userid');
		$result = $this->relation_model->bind_accept($userid, $this->_loginuser);
		$is_bind_before = $this->relation_model->is_bind_before($userid, $this->_loginuser);
		if(!$is_bind_before) {
			$this->doctor_model->receive_money($this->_loginuser, 20, 'RELATION');
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function bind_unaccept() {
		$userid = $this->input->post('userid');
		$result = $this->relation_model->bind_unaccept($userid, $this->_loginuser);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function show($id = 0) {
		if($id) {
			$user = $this->user_model->get_relation($this->_loginuser, $id);
			if($user) {
				$this->data['user'] = $user;
				$dossiers = $this->dossier_model->get_by_userid($id);
				$pressure_records = $this->recordpressure_model->get_by_userid_limit($id, 10);
				$food_records = $this->recordfood_model->get_by_userid($id);
				$drug_records = $this->recorddrug_model->get_by_userid($id);
				$protein_records = $this->recordprotein_model->get_by_userid_limit($id, 10);
				$bmi_records = $this->recordbmi_model->get_by_userid_limit($id, 10);
				$visit_records = $this->recordvisit_model->get_by_userid_and_time($id, $this->_start, $this->_end);
				$whr_records = $this->recordwhr_model->get_by_userid_limit($id, 10);
				$this->data['whr_records'] = $whr_records;
				$this->data['visit_records'] = $visit_records;
				$this->data['bmi_records'] = $bmi_records;
				$this->data['pressure_records'] = $pressure_records;
				$this->data['food_records'] = $food_records;
				$this->data['drug_records'] = $drug_records;
				$this->data['protein_records'] = $protein_records;
				$this->data['dossiers'] = $dossiers;
				$startday = date('Y-m-d', $this->_timestamp - 60 * 60 * 24 * 6);
				
				$start = strtotime($startday);
				$records_1 = $this->recordsugar_model->get_by_userid_and_type_since($id, '空腹', $start);
				$records_2 = $this->recordsugar_model->get_by_userid_and_type_since($id, '早餐后', $start);
				$records_3 = $this->recordsugar_model->get_by_userid_and_type_since($id, '午餐前', $start);
				$records_4 = $this->recordsugar_model->get_by_userid_and_type_since($id, '午餐后', $start);
				$records_5 = $this->recordsugar_model->get_by_userid_and_type_since($id, '晚餐前', $start);
				$records_6 = $this->recordsugar_model->get_by_userid_and_type_since($id, '晚餐后', $start);
				$records_7 = $this->recordsugar_model->get_by_userid_and_type_since($id, '睡前', $start);
				$records_8 = $this->recordsugar_model->get_by_userid_and_type_since($id, '凌晨', $start);
				
				$sugar_empty = config_item('sugar_empty');
				$sugar_full = config_item('sugar_full');
				$low_empty = $sugar_empty[0];
				$high_empty = $sugar_empty[1];
				$low_full = $sugar_full[0];
				$high_full = $sugar_full[1];
				
				$sugar_records = array();
				$yesterday = $start;
				for($i = 0; $i < 7; $i++) {
					$now = $start + 60 * 60 * 24 * $i;
					$day = date('m-d', $now);
					$end = $now + 60 * 60 * 24;
					$sugar_records[$i] = array(
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
					$sugar_records[$i]['data'][0] = $status;
					$sugar_records[$i]['sugar'][0] = $sugar;
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
					$sugar_records[$i]['data'][1] = $status;
					$sugar_records[$i]['sugar'][1] = $sugar;
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
					$sugar_records[$i]['data'][2] = $status;
					$sugar_records[$i]['sugar'][2] = $sugar;
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
					$sugar_records[$i]['data'][3] = $status;
					$sugar_records[$i]['sugar'][3] = $sugar;
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
					$sugar_records[$i]['data'][4] = $status;
					$sugar_records[$i]['sugar'][4] = $sugar;
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
					$sugar_records[$i]['data'][5] = $status;
					$sugar_records[$i]['sugar'][5] = $sugar;
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
					$sugar_records[$i]['data'][6] = $status;
					$sugar_records[$i]['sugar'][6] = $sugar;
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
					$sugar_records[$i]['data'][7] = $status;
					$sugar_records[$i]['sugar'][7] = $sugar;
					$yesterday = $end;
				}
				
				$this->data['sugar_records'] = $sugar_records;
				
				
				
				
				
				
				
				
				$this->load->view('user/show', $this->data);
			} else {
				exit('用户不存在');
			}
		} else {
			exit('用户不存在');
		}
	}
	
	function add() {
		$this->load->view('user/add', $this->data);
	}
	
	function bind() {
		$mobile = $this->input->post('mobile');
		$user = $this->user_model->get_by_mobile_or_email($mobile);
		$result = -1;
		if($user) {
			$relation = $this->relation_model->get_by_userid($this->_loginuser, $user['id']);
			if($relation) {
				$result = -2;
			} else {
				$relation = $this->relation_model->get_unchecked_by_doctorid_and_userid($this->_loginuser, $user['id']);
				if($relation) {
					$result = -3;
				} else {
					$relation = $this->relation_model->get_unaccepted_by_doctorid_and_userid($this->_loginuser, $user['id']);
					if($relation) {
						$result = -4;
					} else {
						$data = array(
							'userid' => $user['id'],
							'doctorid' => $this->_loginuser,
							'username' => $this->input->post('username'),
							'userdes' => $this->input->post('userdes'),
							'chatopen' => 0,
							'healthopen' => 0,
							'bindway' => 'DOCTOR_INPUT_MOBILE'
						);
						$result = $this->relation_model->add($data);
						// $is_bind_before = $this->relation_model->is_bind_before($user['id'], $this->_loginuser);
						// if(!$is_bind_before) {
							// $this->doctor_model->receive_money($this->_loginuser, 20, 'RELATION');
						// }
					}
				}
			}
		}
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function unbind() {
		$userid = $this->input->post('userid');
		$result = $this->relation_model->unbind($userid, $this->_loginuser);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function update_uname() {
		$uname = $this->input->post('uname');
		$userid = $this->input->post('userid');
		$result = $this->relation_model->update_uname_by_userid_and_doctorid($uname, $userid, $this->_loginuser);
		$json = array('result' => $result);
		echo json_encode($json);
	}
	
	function record_sugar($id = 0) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$records = $this->recordsugar_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['records'] = $records;
			$this->data['id'] = $id;
			$this->load->view('user/record_sugar', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	
	function record_pressure($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$records = $this->recordpressure_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['records'] = $records;
			$this->data['id'] = $id;
			$this->load->view('user/record_pressure', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	function record_food($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$food_records = $this->recordfood_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['food_records'] = $food_records;
			$this->data['id'] = $id;
			$this->load->view('user/record_food', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	function record_drug($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$drug_records = $this->recorddrug_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['drug_records'] = $drug_records;
			$this->data['id'] = $id;
			$this->load->view('user/record_drug', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	
	function record_bmi($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$records = $this->recordbmi_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['records'] = $records;
			$this->data['id'] = $id;
			$this->load->view('user/record_bmi', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	function record_visit($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$visit_records = $this->recordvisit_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['visit_records'] = $visit_records;
			$this->data['id'] = $id;
			$this->load->view('user/record_visit', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	function record_whr($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$records = $this->recordwhr_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['records'] = $records;
			$this->data['id'] = $id;
			$this->load->view('user/record_whr', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	function record_protein($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$records = $this->recordprotein_model->get_by_userid_and_time($id, $this->_start, $this->_end);
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['records'] = $records;
				$this->data['id'] = $id;
			$this->load->view('user/record_protein', $this->data);
		} else {
			exit('用户不存在');
		}
	}
	function record_box($id) {
		if($id) {
			if($_POST) {
				$startStr = $this->input->post('start');
				$endStr = $this->input->post('end');
				$this->_start = $startStr ? strtotime($startStr) : 0;
				$this->_end = $endStr ? (strtotime($endStr) + 60 * 60 * 24 - 1) : 2147483647;
			}
			$box = $this->box_model->get_by_userid($id);
			$records = array();
			if($box) {
				$records = $this->recordbox_model->get_by_userid_and_sn_and_time($id, $box['sn'], $this->_start, $this->_end);
			}
			$this->data['box'] = $box;
			$this->data['start'] = $this->_start;
			$this->data['end'] = $this->_end;
			$this->data['records'] = $records;
				$this->data['id'] = $id;
			$this->load->view('user/record_box', $this->data);
		} else {
			exit('用户不存在');
		}
	}


}