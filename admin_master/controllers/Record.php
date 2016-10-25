<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends NN_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('doctor_model');
		$this->load->model('user_model','user');
		$this->load->model('recordsugar_model');
		$this->load->model('recordpressure_model');
		$this->load->model('recordfood_model');
		$this->load->model('recorddrug_model');
		$this->load->model('recordbox_model');
		$this->load->model('recordprotein_model');
	}
	
	function record($userid = 0) {
		$sugar_records_1 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '空腹', 20);
		$sugar_records_2 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '早餐后', 20);
		$sugar_records_3 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '午餐前', 20);
		$sugar_records_4 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '午餐后', 20);
		$sugar_records_5 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '晚餐前', 20);
		$sugar_records_6 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '晚餐后', 20);
		$sugar_records_7 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '睡前', 20);
		$sugar_records_8 = $this->recordsugar_model->get_by_userid_and_type_limit($userid, '凌晨', 20);
		$pressure_records = $this->recordpressure_model->get_by_userid_limit($userid, 20);
		$food_records = $this->recordfood_model->get_by_userid($userid);
		$drug_records = $this->recorddrug_model->get_by_userid($userid);
		$protein_records = $this->recordprotein_model->get_by_userid_limit($userid, 20);
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
		$this->load->view('user/record', $this->data);
	}
	
	function index() {
		$doctors = $this->doctor_model->get_by_masterid($this->_loginuser);
		$this->data['doctors'] = $doctors;

		//艾力写的
		// $user_data = $this->user->select('all');
		$user_data = $this->user->get_all_users($this->_loginuser);
		//循环查询主管医生
		$this->load->model('relation_model','relation');
		foreach ($user_data as $k => $v) {
			$user_data[$k]['sugar'] = null ;
			$user_data[$k]['pressure'] = null ;
			$user_data[$k]['protein'] = null ;
			$relation = $this->relation->get_doctor($v['id']);
			if(!empty($relation)){
				$user_data[$k]['doctor'] = $this->doctor_model->get_by_id($relation[0]['doctorid']);
			}else{
				$user_data[$k]['doctor'] = 0;
			}
		}
		// var_dump($user_data[9]);exit;
		$this->data['user_data'] = $user_data;
		$this->data['aj_detail'] = "aa" ;
		$this->load->view('record/index', $this->data);
	}

	public function search()
	{
		// 血糖
		if($this->input->post('sugar-start') != '') {
			$arr['sugar']['start'] = $this->input->post('sugar-start');
			$aj_detail['sugar_star'] = $arr['sugar']['start'] ;
		}else{
			$aj_detail['sugar_star'] = "sugar" ;
		}
		if($this->input->post('sugar-end') != ''){
			$arr['sugar']['end'] = $this->input->post('sugar-end');
			$aj_detail['sugar_end'] = $arr['sugar']['end'] ;
		}else{
			$aj_detail['sugar_end'] = "sugar" ;
		}

		// 高血压
		if($this->input->post('height-start') != ''){
			$arr['height']['start'] = $this->input->post('height-start');
			$aj_detail['height_star'] = $arr['height']['start'] ;
		}else{
			$aj_detail['height_star'] = "height" ;
		}
		if($this->input->post('height-end') != ''){
			$arr['height']['end'] = $this->input->post('height-end');
			$aj_detail['height_end'] = $arr['height']['end'] ;
		}else{
			$aj_detail['height_end'] = "height" ;
		}

		// 低血压
		if($this->input->post('low-start') != ''){
			$arr['low']['start'] = $this->input->post('low-start');
			$aj_detail['low_star'] = $arr['low']['start'] ;
		}else{
			$aj_detail['low_star'] = "low" ;
		}
		if($this->input->post('low-end') != ''){
			$arr['low']['end'] = $this->input->post('low-end');
			$aj_detail['low_end'] = $arr['low']['end'] ;
		}else{
			$aj_detail['low_end'] = "low" ;
		}
 
		//糖化
		if($this->input->post('protein-start') != ''){
			$arr['protein']['start'] = $this->input->post('protein-start');
			$aj_detail['protein_star'] = $arr['protein']['start'] ;
		}else{
			$aj_detail['protein_star'] = "protein" ;
		}
		if($this->input->post('protein-end') != ''){
			$arr['protein']['end'] = $this->input->post('protein-end');
			$aj_detail['protein_end'] = $arr['protein']['end'] ;
		}else{
			$aj_detail['protein_end'] = "protein" ;
		}
		//记录时间start-date
		if($this->input->post('start-date') != '' || $this->input->post('start-date') != 0){
			$arr['hour']['start-date'] = @$this->input->post('start-date');
			$aj_detail['time_star']['date'] = $arr['hour']['start-date'] ;
		}else{
			$aj_detail['time_star']['date'] = "tim" ;
		}
		if($this->input->post('start-hour') != '' || $this->input->post('start-hour') != 0){
			$arr['hour']['start-time'] = @$this->input->post('start-hour');
			$aj_detail['time_star']['time'] = $arr['hour']['start-time'] ;
		}else{
			$aj_detail['time_star']['time'] = "tim" ;
		}
		if($this->input->post('end-date') != '' || $this->input->post('end-date') != 0){
			$arr['hour']['end-date'] = @$this->input->post('end-date');
			$aj_detail['time_end']['date'] = $arr['hour']['end-date'] ;
		}else{
			$aj_detail['time_end']['date'] = "tim" ;
		}
		if($this->input->post('end-hour') != '' || $this->input->post('end-hour') != 0){
			$arr['hour']['end-time'] = @$this->input->post('end-hour');
			$aj_detail['time_end']['time'] = $arr['hour']['end-time'] ;
		}else{
			$aj_detail['time_end']['time'] = "tim" ;
		}
		if( $aj_detail['time_star']['date'] == "tim" ){
			$aj_detail['time_star'] = "tim" ;
		}else{
			$aj_detail['time_star'] = strtotime("{$aj_detail['time_star']['date']} {$aj_detail['time_star']['time']}:00:00");
		}
		if( $aj_detail['time_end']['date'] == "tim" ){
			$aj_detail['time_end'] = "tim" ;
		}else{
			$aj_detail['time_end'] = strtotime("{$aj_detail['time_end']['date']} {$aj_detail['time_end']['time']}:00:00");
		}

		//城市
		if($this->input->post('province') != '' && $this->input->post('province') != 0){
			$arr['location']['province'] = $this->input->post('province');
		}
		if($this->input->post('city') != '' && $this->input->post('city') != 0){
			$arr['location']['city'] = $this->input->post('city');
		}

		$result = array() ;
		$this->load->model('Record_model','record');
		$user_data = $this->record->search($arr, $this->_loginuser);
		if( $user_data == "find_false" ){
			$user_data = $result ;
		}else if( array_key_exists( 'location' , $user_data ) ){
			$user_data = $user_data['location'] ;
			for( $i=0 ; $i<count($user_data) ; $i++ ){
				$user_data[$i]['doctor']['username'] = $user_data[$i]['doctor_name'] ;
				$user_data[$i]['sugar'] = null ;
				$user_data[$i]['pressure'] = null ;
				$user_data[$i]['protein'] = null ;
			}
		}else {
			if( array_key_exists( 'sugar' , $user_data ) && $user_data['sugar'] != null ){
				if( array_key_exists( 'pressure' , $user_data ) && array_key_exists( 'protein' , $user_data ) && $user_data['protein'] != null && $user_data['pressure'] != null ){
					for( $i=0 ; $i<count($user_data['sugar']) ; $i++ ){
						$result[$i] = $user_data['sugar'][$i] ;
						$result[$i]['doctor']['username'] = $user_data['sugar'][$i]['doctor_name'] ;
						$result[$i]['sugar'] = 1 ;
						$result[$i]['pressure'] = null ;
						$result[$i]['protein'] = null ;
						for( $j=0 ; $j<count($user_data['pressure']) ; $j++ ){
							if( $result[$i]['id'] == $user_data['pressure'][$j]['id'] ){
								$result[$i]['pressure'] = 1 ;
							}
						}
						for( $k=0 ; $k<count($user_data['protein']) ; $k++ ){
							if( $result[$i]['id'] == $user_data['protein'][$k]['id'] ){
								$result[$i]['protein'] = 1 ;
							}
						}
						
					}
				}else if (  array_key_exists( 'pressure' , $user_data ) && $user_data['pressure'] != null ){
					for( $i=0 ; $i<count($user_data['sugar']) ; $i++ ){
						$result[$i] = $user_data['sugar'][$i] ;
						$result[$i]['doctor']['username'] = $user_data['sugar'][$i]['doctor_name'] ;
						$result[$i]['sugar'] = 1 ;
						$result[$i]['pressure'] = null ;
						$result[$i]['protein'] = null ;
						for( $j=0 ; $j<count($user_data['pressure']) ; $j++ ){
							if( $result[$i]['id'] == $user_data['pressure'][$j]['id'] ){
								$result[$i]['pressure'] = 1 ;
							}
						}
						
					}
				}else if ( array_key_exists( 'protein' , $user_data ) && $user_data['protein'] != null  ){
					for( $i=0 ; $i<count($user_data['sugar']) ; $i++ ){
						$result[$i] = $user_data['sugar'][$i] ;
						$result[$i]['doctor']['username'] = $user_data['sugar'][$i]['doctor_name'] ;
						$result[$i]['sugar'] = 1 ;
						$result[$i]['pressure'] = null ;
						$result[$i]['protein'] = null ;
						for( $k=0 ; $k<count($user_data['protein']) ; $k++ ){
							if( $result[$i]['id'] == $user_data['protein'][$k]['id'] ){
								$result[$i]['protein'] = 1 ;
							}
						}
						
					}
				}else{	
					for( $i=0 ; $i<count($user_data['sugar']) ; $i++ ){
						$result[$i] = $user_data['sugar'][$i] ;
						$result[$i]['doctor']['username'] = $user_data['sugar'][$i]['doctor_name'] ;
						$result[$i]['sugar'] = 1 ;
						$result[$i]['pressure'] = null ;
						$result[$i]['protein'] = null ;
					}
				}
			}else if ( array_key_exists( 'pressure' , $user_data  ) && $user_data['pressure'] != null ){
				if( array_key_exists( 'protein' , $user_data  ) && $user_data['protein'] != null ){
					for( $i=0 ; $i<count($user_data['pressure']) ; $i++ ){
						$result[$i] = $user_data['pressure'][$i] ;
						$result[$i]['doctor']['username'] = $user_data['pressure'][$i]['doctor_name'] ;
						$result[$i]['pressure'] = 1 ;
						$result[$i]['protein'] = null ;
						$result[$i]['sugar'] = null ;
						for( $k=0 ; $k<count($user_data['protein']) ; $k++ ){
							if( $result[$i]['id'] == $user_data['protein'][$k]['id'] ){
								$result[$i]['protein'] = 1 ;
							}
						}
						
					}
				}else {
					for( $i=0 ; $i<count($user_data['pressure']) ; $i++ ){
						$result[$i] = $user_data['pressure'][$i] ;
						$result[$i]['doctor']['username'] = $user_data['pressure'][$i]['doctor_name'] ;
						$result[$i]['pressure'] = 1 ;
						$result[$i]['protein'] = null ;
						$result[$i]['sugar'] = null ;
						
					}
					
				}
			}else if ( array_key_exists( 'protein' , $user_data  ) && $user_data['protein'] != null ) {
				for( $i=0 ; $i<count($user_data['protein']) ; $i++ ){
						$result[$i] = $user_data['protein'][$i] ;
						$result[$i]['doctor']['username'] = $user_data['protein'][$i]['doctor_name'] ;
						$result[$i]['protein'] = 1 ;
						$result[$i]['pressure'] = null ;
						$result[$i]['sugar'] = null ;
						
					}
			}
			$user_data = $result ;
		}
		
		// var_dump($user_data);die;
		$data['user_data'] = $user_data;
		$data['aj_detail'] = $aj_detail;
		$this->load->view('record/index', $data);
	}

	function details(){
		$condition = $_POST;
		$this->load->model('Record_model','record');		
		$user_data = $this->record->search_details($condition);
		$user_data = json_encode( $user_data ) ;
		echo $user_data ;
		
	} 
	/*
	function export(){
		$export_value = $_POST['export_value'];
		$export_search = $_POST['export_search'];
		$export_value = json_decode( $export_value , true ) ;
		$export_search = unserialize( $export_search  ) ;
		$this->load->model('Record_model','record');
		if( $export_search == "aa" ){
			$export_all = $this->record->export_excends_id( $export_value );
		}else{
			$export_all = $this->record->export_excends( $export_value , $export_search );
		}
		
		// dd($export_all);exit;
		$data['export_all'] = $export_all;
		$this->load->view('record/export' , $data );
	}
	*/
	function export(){
		$export_value = $_POST['export_value'];
		$export_search = $_POST['export_search'];
		luiji_log(__FILE__, __LINE__, $export_search);
		if($export_search == 's:2:"aa";') {
			$export_search = 'a:10:{s:10:"sugar_star";s:1:"0";s:9:"sugar_end";s:3:"500";s:11:"height_star";s:1:"0";s:10:"height_end";s:3:"500";s:8:"low_star";s:1:"0";s:7:"low_end";s:3:"500";s:12:"protein_star";s:1:"0";s:11:"protein_end";s:3:"100";s:9:"time_star";s:3:"tim";s:8:"time_end";s:3:"tim";}';
		}
		luiji_log(__FILE__, __LINE__, $export_search);
		$export_value = json_decode( $export_value , true ) ;
		$export_search = unserialize( $export_search  ) ;
		$this->load->model('Record_model','record');
		if( $export_search == "aa" ){
			$export_all = $this->record->export_excends_id( $export_value );
		}else{
			$export_all = $this->record->export_excends( $export_value , $export_search );
		}
		
		// dd($export_all);exit;
		$data['export_all'] = $export_all;
		$this->load->view('record/export' , $data );
	}
	

}