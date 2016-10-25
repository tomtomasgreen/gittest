<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Record_model extends CI_Model
{
	public function search($arr, $masterid)
	{
		$sugar = null ;
		$location = null ;
		$time = null ;
		$height = null ;
		$low = null ;
		$protein = null ;
		//血糖
		if(array_key_exists('sugar',$arr)){
			if(array_key_exists('start',$arr['sugar']) || array_key_exists('end',$arr['sugar'])){
				$sugar = " record_sugar.sugar > {$arr['sugar']['start']} AND record_sugar.sugar < {$arr['sugar']['end']} ";
			}elseif(array_key_exists('start',$arr['sugar']) && !array_key_exists('end',$arr['sugar'])){
				$sugar = " sugar > {$arr['sugar']['start']} ";
			}elseif(!array_key_exists('start',$arr['sugar']) && array_key_exists('end',$arr['sugar'])){
				$sugar = " sugar < {$arr['sugar']['end']} ";
			}
		}
		
		//高血压
		if(array_key_exists('height',$arr)){
			if( array_key_exists('start',$arr['height']) && array_key_exists('end',$arr['height'])){
				$height = " record_pressure.high > {$arr['height']['start']} AND record_pressure.high < {$arr['height']['end']} ";
			}else if( array_key_exists('start',$arr['height']) && !array_key_exists('end',$arr['height'])){
				$height = " record_pressure.high > {$arr['height']['start']} ";
			}else if( !array_key_exists('start',$arr['height']) && array_key_exists('end',$arr['height'])){
				$height = " record_pressure.high < {$arr['height']['end']} ";
			}
		}
		
		//低血压
		if(array_key_exists('low', $arr)){
			if( array_key_exists('start',$arr['low']) && array_key_exists('end',$arr['low'])){
				$low = " record_pressure.low > {$arr['low']['start']} AND record_pressure.low < {$arr['low']['end']} ";
			}else if( array_key_exists('start',$arr['low']) && !array_key_exists('end',$arr['low'])){
				$low = " record_pressure.low > {$arr['low']['start']} ";
			}else if( !array_key_exists('start',$arr['low']) && array_key_exists('end',$arr['low'])){
				$low = " record_pressure.low < {$arr['low']['end']} ";
			} 
		}
		
		//糖化
		if(array_key_exists('protein',$arr)){
			if( array_key_exists('start',$arr['protein']) && array_key_exists('end',$arr['protein'])){
				$protein = " record_protein.protein > {$arr['protein']['start']} AND record_protein.protein < {$arr['protein']['end']} ";
			}else if( array_key_exists('start',$arr['protein']) && !array_key_exists('end',$arr['protein'])){
				$protein = " record_protein.protein > {$arr['protein']['start']} ";
			}else if( !array_key_exists('start',$arr['protein']) && array_key_exists('end',$arr['protein'])){
				$protein = " record_protein.protein < {$arr['protein']['end']} ";
			}
		}
		
		//位置
		if(array_key_exists('location',$arr)){
			if(array_key_exists('province',$arr['location']) && array_key_exists('city',$arr['location'])){
				$location = " user.province = {$arr['location']['province']} AND user.city = {$arr['location']['city']} ";
			}else if(array_key_exists('province',$arr['location']) && !array_key_exists('city',$arr['location'])){
				$location = " user.province = {$arr['location']['province']} ";
			}
		}

		//时间
		if(array_key_exists('end-date',$arr['hour']) || array_key_exists('start-date', $arr['hour'])){
			if(array_key_exists('start-date', $arr['hour']) && array_key_exists('end-date',$arr['hour'])){
				if($arr['hour']['start-time'] == 0 || $arr['hour']['start-time'] == ''){
					$arr['hour']['start-time'] = '00';
				}
				if($arr['hour']['end-time'] == 0 || $arr['hour']['end-time'] == ''){
					$arr['hour']['end-time'] = '00';
				}
				$time_start = strtotime("{$arr['hour']['start-date']} {$arr['hour']['start-time']}:00:00");
				$time_end = strtotime("{$arr['hour']['end-date']} {$arr['hour']['end-time']}:00:00");
				$time = " measuretime > {$time_start} AND measuretime < {$time_end} ";
			}
			if(array_key_exists('start-date', $arr['hour']) && !array_key_exists('end-date',$arr['hour'])){
				if($arr['hour']['start-time'] == 0 || $arr['hour']['start-time'] == ''){
					$arr['hour']['start-time'] = '00';
				}
				$time_start = strtotime("{$arr['hour']['start-date']} {$arr['hour']['start-time']}:00:00");
				$time = " measuretime > {$time_start} ";
			}
			if(!array_key_exists('start-date', $arr['hour']) && array_key_exists('end-date',$arr['hour'])){
				if($arr['hour']['end-time'] == 0 || $arr['hour']['end-time'] == ''){
					$arr['hour']['end-time'] = '00';
				}
				$time_end = strtotime("{$arr['hour']['end-date']} {$arr['hour']['end-time']}:00:00");
				$time = " measuretime < {$time_end} ";
			}
		}
		
		if( $sugar != null ){
			$this->db->where( $sugar );
		
			if( $location != null ){
				$this->db->where( $location );
			}
			if( $time != null ){
				$this->db->where( $time );
			}
			// $this->db->where( " relation.status = 1 " );
			$this->db->where( " department.masterid='{$masterid}' AND relation.status='1' AND relation.status = 1 " );
			$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
			$this->db->from("record_sugar");
			$this->db->join('user', 'record_sugar.userid = user.id');
			$this->db->join('relation', 'relation.userid = user.id');
			$this->db->join('doctor', 'doctor.id = relation.doctorid');
			$this->db->join('department', 'relation.doctorid = department.doctorid');
			$this->db->group_by( 'user.id' , 'desc' );
			$query_sugar = $this->db->get();
			$result['sugar'] = $query_sugar->result_array() ;
		}
		
		if( $height != null || $low != null ){

			if( $height != null ){
				$this->db->where( $height );
			}
			if( $low != null ){
				$this->db->where( $low );
			}
			if( $location != null ){
				$this->db->where( $location );
			}
			if( $time != null ){
				$this->db->where( $time );
			}
			// $this->db->where( " relation.status = 1 " );
			$this->db->where( " department.masterid='{$masterid}' AND relation.status='1' AND relation.status = 1 " );
			$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
			$this->db->from("record_pressure");
			$this->db->join('user', 'record_pressure.userid = user.id');
			$this->db->join('relation', 'relation.userid = user.id');
			$this->db->join('doctor', 'doctor.id = relation.doctorid');
			$this->db->join('department', 'relation.doctorid = department.doctorid');
			$this->db->group_by( 'user.id' , 'desc' );
			$query_pressure = $this->db->get();
			$result['pressure'] = $query_pressure->result_array() ;
		}
		
		if( $protein != null ){

			$this->db->where( $protein );
			if( $location != null ){
				$this->db->where( $location );
			}
			if( $time != null ){
				$this->db->where( $time );
			}
			// $this->db->where( " relation.status = 1 " );
			$this->db->where( " department.masterid='{$masterid}' AND relation.status='1' AND relation.status = 1 " );
			$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
			$this->db->from("record_protein");
			$this->db->join('user', 'record_protein.userid = user.id');
			$this->db->join('relation', 'relation.userid = user.id');
			$this->db->join('doctor', 'doctor.id = relation.doctorid');
			$this->db->join('department', 'relation.doctorid = department.doctorid');
			$this->db->group_by( 'user.id' , 'desc' );
			$query_protein = $this->db->get();
			$result['protein'] = $query_protein->result_array() ;
		}
		
		if( $sugar == null && $protein == null && $height == null && $low == null ){
			
			if( $location == null && $time == null ){
				return "find_false" ;
			}else if( $location != null && $time == null ){
				$this->db->where( $location );
				$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
				// $this->db->where( " relation.status = 1 " );
				$this->db->where( " department.masterid='{$masterid}' AND relation.status='1' AND relation.status = 1 " );
				$this->db->from("relation");
				$this->db->join('user', ' user.id = relation.userid ');
				$this->db->join('doctor', ' doctor.id = relation.doctorid ');
			$this->db->join('department', 'relation.doctorid = department.doctorid');
				$this->db->group_by( 'user.id' , 'desc' );
				$query_location = $this->db->get();
				$result['location'] = $query_location->result_array() ;
			}else {
				
				if( $location != null ){
					$this->db->where( $location );
				}
				$this->db->where( $time );
				// $this->db->where( " relation.status = 1 " );
				$this->db->where( " department.masterid='{$masterid}' AND relation.status='1' AND relation.status = 1 " );
				$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
				$this->db->from("record_protein");
				$this->db->join('user', 'record_protein.userid = user.id');
				$this->db->join('relation', 'relation.userid = user.id');
				$this->db->join('doctor', 'doctor.id = relation.doctorid');
			$this->db->join('department', 'relation.doctorid = department.doctorid');
				$this->db->group_by( 'user.id' , 'desc' );
				$query_protein = $this->db->get();
				$result['protein'] = $query_protein->result_array() ;
				
				if( $location != null ){
					$this->db->where( $location );
				}
				$this->db->where( $time );
				// $this->db->where( " relation.status = 1 " );
				$this->db->where( " department.masterid='{$masterid}' AND relation.status='1' AND relation.status = 1 " );
				$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
				$this->db->from("record_pressure");
				$this->db->join('user', 'record_pressure.userid = user.id');
				$this->db->join('relation', 'relation.userid = user.id');
				$this->db->join('doctor', 'doctor.id = relation.doctorid');
			$this->db->join('department', 'relation.doctorid = department.doctorid');
				$this->db->group_by( 'user.id' , 'desc' );
				$query_pressure = $this->db->get();
				$result['pressure'] = $query_pressure->result_array() ;
				
				if( $location != null ){
					$this->db->where( $location );
				}
				$this->db->where( $time );
				// $this->db->where( " relation.status = 1 " );
				$this->db->where( " department.masterid='{$masterid}' AND relation.status='1' AND relation.status = 1 " );
				$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
				$this->db->from("record_sugar");
				$this->db->join('user', 'record_sugar.userid = user.id');
				$this->db->join('relation', 'relation.userid = user.id');
				$this->db->join('doctor', 'doctor.id = relation.doctorid');
			$this->db->join('department', 'relation.doctorid = department.doctorid');
				$this->db->group_by( 'user.id' , 'desc' );
				$query_sugar = $this->db->get();
				$result['sugar'] = $query_sugar->result_array() ;
				
			}
			
			
			
		}
		return $result ;
		
		

	}


	public function search_details($condition){
		if( $condition['kinds'] == 1 ){
			if( $condition['sugar_star'] != "sugar" ){
				$this->db->where( " sugar > {$condition['sugar_star']}  " );
			}
			if( $condition['sugar_end'] != "sugar" ){
				$this->db->where( " sugar < {$condition['sugar_end']}  " );
			}
			if( $condition['time_star'] != "tim" ){
				$this->db->where( " measuretime > {$condition['time_star']}  " );
			}
			if( $condition['time_end'] != "tim" ){
				$this->db->where( " measuretime < {$condition['time_end']}  " );
			}
			$this->db->where( " userid = {$condition['user_id']}  " );
			$this->db->from("record_sugar");
			$query = $this->db->get();
			return $query->result_array() ;
		}else if( $condition['kinds'] == 2 ){
			if( $condition['height_star'] != "height" ){
				$this->db->where( " high > {$condition['height_star']}  " );
			}
			if( $condition['height_end'] != "height" ){
				$this->db->where( " high < {$condition['height_end']}  " );
			}
			if( $condition['low_star'] != "low" ){
				$this->db->where( " low > {$condition['low_star']}  " );
			}
			if( $condition['low_end'] != "low" ){
				$this->db->where( " low < {$condition['low_end']}  " );
			}
			if( $condition['time_star'] != "tim" ){
				$this->db->where( " measuretime > {$condition['time_star']}  " );
			}
			if( $condition['time_end'] != "tim" ){
				$this->db->where( " measuretime < {$condition['time_end']}  " );
			}
			$this->db->where( " userid = {$condition['user_id']}  " );
			$this->db->from("record_pressure");
			$query = $this->db->get();
			return $query->result_array() ;
		}else if( $condition['kinds'] == 3 ){
			if( $condition['protein_star'] != "protein" ){
				$this->db->where( " protein > {$condition['protein_star']}  " );
			}
			if( $condition['protein_end'] != "protein" ){
				$this->db->where( " protein < {$condition['protein_end']}  " );
			}
			if( $condition['time_star'] != "tim" ){
				$this->db->where( " measuretime > {$condition['time_star']}  " );
			}
			if( $condition['time_end'] != "tim" ){
				$this->db->where( " measuretime < {$condition['time_end']}  " );
			}
			$this->db->where( " userid = {$condition['user_id']}  " );
			$this->db->from("record_protein");
			$query = $this->db->get();
			// var_dump("asf");exit;
			return $query->result_array() ;
		}
	}
 
	public function export_excends( $user_ids , $search ){
		$result = null ;
		foreach ( $user_ids as $k => $v ){
			$this->db->where( " user.id = {$v} " );
			$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
			$this->db->where( " relation.status = 1 " );
			$this->db->from("relation");
			$this->db->join('user', ' user.id = relation.userid ');
			$this->db->join('doctor', ' doctor.id = relation.doctorid ');
			$this->db->group_by( 'user.id' , 'desc' );
			$query_location = $this->db->get();
			$result[$k] = $query_location->result_array() ;
			for( $i=1 ; $i<4 ; $i++ ){
				if($i == 1 && ($search['sugar_star']== "sugar" && $search['sugar_end']== "sugar" ) ){
					continue ;
				}else if($i == 2 && ($search['height_star']== "height" && $search['height_end']== "height" && $search['low_star']== "low" && $search['low_end']== "low" ) ){
					continue ;
				}else if($i == 3 && ($search['protein_star']== "protein" && $search['protein_end']== "protein") ) {
					continue ;
				}
				$search['kinds'] = $i ;
				$search['user_id'] = $v ;
				$result[$k]['sj'][$i] = $this->search_details($search) ;
			}
		}
		return $result ;
	}
	
	public function export_excends_id( $user_ids  ){
		$result = null ;
		foreach ( $user_ids as $k => $v ){
			$this->db->where( " user.id = {$v} " );
			$this->db->select(" user.id , user.username , user.mobile , user.email , user.city , doctor.username as doctor_name ") ;
			$this->db->where( " relation.status = 1 " );
			$this->db->from("relation");
			$this->db->join('user', ' user.id = relation.userid ');
			$this->db->join('doctor', ' doctor.id = relation.doctorid ');
			$this->db->group_by( 'user.id' , 'desc' );
			$query_location = $this->db->get();
			$result[$k] = $query_location->result_array() ;
			if($result[$k] == null ){
				$this->db->where( " id = {$v} " );
				$this->db->select(" id , username , mobile , email , city   ") ;
				$this->db->from("user");
				$this->db->group_by( 'id' , 'desc' );
				$query_location = $this->db->get();
				$result[$k] = $query_location->result_array() ;
				$result[$k][0]['doctor_name'] = "未绑定" ; 
			}

		}
		return $result ;
	}


}