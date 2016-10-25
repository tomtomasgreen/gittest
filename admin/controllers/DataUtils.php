<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataUtils extends CI_Controller
{
	public function doctors() {
		GLOBAL $AREAS;
		$this->load->model('doctor_model', 'doctor');
		$doctors = $this->doctor->doctors_export();
		$data['users_total'] = 0;
		
		$_areas_sale = array(
			'黑龙江省' => '东北大区',
			'吉林省' => '东北大区',
			'辽宁省' => '东北大区',
			'上海市' => '华东大区',
			'江苏省' => '华东大区',
			'河南省' => '华中大区',
			'山东省' => '华中大区',
			'陕西省' => '华中大区',
			'天津市' => '华北大区',
			'河北省' => '华北大区',
			'山西省' => '华北大区',
			'浙江省' => '东南大区',
			'江西省' => '东南大区',
			'安徽省' => '东南大区',
			'北京市' => '京蒙大区',
			'内蒙古自治区' => '京蒙大区',
			'湖北省' => '中南大区',
			'湖南省' => '中南大区',
			'云南省' => '中南大区',
			'贵州省' => '中南大区',
			'福建省' => '华南大区',
			'广东省' => '华南大区',
			'海南省' => '华南大区',
			'广西壮族自治区' => '华南大区',
			'四川省' => '华西大区',
			'重庆市' => '华西大区',
			'青海省' => '华西大区',
			'宁夏回族自治区' => '华西大区',
			'甘肃省' => '华西大区',
			'新疆维吾尔自治区' => '华西大区'
		);
		
		for($i = 0; $i < count($doctors); $i++) {
			$doctorid = $doctors[$i]['id'];
			$doctors[$i]['users'] = $doctors[$i]['num'];
			$doctors[$i]['province_s'] = $AREAS[$doctors[$i]['province']];
			$doctors[$i]['city_s'] = $AREAS[$doctors[$i]['city']];
			$data['users_total'] += $doctors[$i]['users'];
			$doctors[$i]['area_sale'] = '';
			foreach($_areas_sale as $_p => $_a) {
				if($doctors[$i]['province_s'] == $_p) {
					$doctors[$i]['area_sale'] = $_a;
					break;
				}
			}
		}
		$data['doctors'] = $doctors;
		$this->load->view('doctor/export.html', $data);
	}

	public function certs() {
		GLOBAL $AREAS;
		$this->load->model('doctor_model', 'doctor');
		$data['AREAS'] = $AREAS;
		$data['data'] = $this->doctor->get_all_certs();
		$this->load->view('doctor/certs.html', $data);
	}

	public function certs_count() {
		GLOBAL $AREAS;
		$this->load->model('doctor_model', 'doctor');
		$data['AREAS'] = $AREAS;
		$data['data'] = $this->doctor->get_all_certs_count();
		$this->load->view('doctor/certs_count.html', $data);
	}
	
	

}