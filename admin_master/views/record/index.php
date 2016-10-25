<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');


?>
<link href="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/css/redmond/jquery-ui.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/areas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/i18n/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript"> 
$(function() {
	$( "#start-date" ).datepicker();
	$( "#end-date" ).datepicker();
	
	var
		cities_default = '<option value="0">市</option>',
		provinces = getAllProvinces(),
		provinces_options = '',
		current_province = '0',
		current_city = '0'
	;
	for(var i = 0; i < provinces.length; i++) {
		provinces_options += '<option value="' + provinces[i][0] + '">' + provinces[i][1] + '</option>';
	}
	$(provinces_options).appendTo($('#province'));
	$('#province').change(function() {
		var province = $(this).val();
		if(province == '0') {
			$('#city').html(cities_default);
		} else {
			var cities = getCitiesByProvince(province);
			cities_options = '';
			for(var i = 0; i < cities.length; i++) {
				cities_options += '<option value="' + cities[i][0] + '">' + cities[i][1] + '</option>';
			}
			$('#city').html(cities_default + cities_options);
		}
		$('#city').trigger('change');
	});
	
	$('.user .control a.detail-link').click(function() {
		var
			userid = $(this).data('userid'),
			detail = $('#detail-' + userid)
		;
	});
	
	$('.btn').click(function() {
		$(" #modal-detail ").attr( "class" , "modal hide fade" ) ;
		$(" #modal-detail ").attr( "aria-hidden" , "true" ) ;
		$(" #modal-detail ").css( "display" , "none" ) ;
		$(" #close_ma ").remove() ;
		$(" .change_c  ").remove() ;

	});
	$('.close').click(function() {
		$(" #modal-detail ").attr( "class" , "modal hide fade" ) ;
		$(" #modal-detail ").attr( "aria-hidden" , "true" ) ;
		$(" #modal-detail ").css( "display" , "none" ) ;
		$(" #close_ma ").remove() ;
		$(" .change_c  ").remove() ;

	});
	
	$('#checkall').click(function() {
		console.log($(this).prop('checked'));
		if($(this).prop('checked')) {
			$('.checkitem').prop('checked', true);
		} else {
			$('.checkitem').prop('checked', false);
		}
	});
	$('.checkitem').change(function() {
		var allchecked = true;
		$('.checkitem').each(function() {
			if(!($(this).prop('checked'))) {
				allchecked = false;
			}
		});
		if(allchecked) {
			$('#checkall').prop('checked', true);
		} else {
			$('#checkall').prop('checked', false);
		}
	});
	$('#export').click(function() {
		var checkeditem = false;
		var exports = {} ;
		$('.checkitem').each(function(i) {
			if($(this).prop('checked')) {
				checkeditem = true;
				exports[i] =  $(this).val() ;
			}
		});
		if(!checkeditem) {
			alert('请勾选需要导出的患者！');
			return false;
		}else{
			exports = JSON.stringify(exports);
			$(" #export_value ").attr("value" , exports ) ;
			// location.href = "export" ;
		}
	});
});
function details_find( user_id , kinds ){
	var aj_url = "<?php echo site_url('admin_master.php/record/details'); ?>" ;
	$.ajax({
		type : "POST",
		url : aj_url ,
		dateType : "JSON",
		data : { 'user_id' : user_id , 'time_star' : '<?php echo isset($aj_detail['time_star']) ? $aj_detail['time_star'] : 0; ?>' , 'time_end' : '<?php echo isset($aj_detail['time_end']) ? $aj_detail['time_end'] : 0; ?>' , 'sugar_star' : '<?php echo isset($aj_detail['sugar_star']) ? $aj_detail['sugar_star'] : 0; ?>' , 'sugar_end' : '<?php echo isset($aj_detail['sugar_end']) ? $aj_detail['sugar_end'] : 0; ?>' , 'kinds' : kinds , 'height_star' : '<?php echo isset($aj_detail['height_star']) ? $aj_detail['height_star'] : 0; ?>' , 'height_end' : '<?php echo isset($aj_detail['height_end']) ? $aj_detail['height_end'] : 0; ?>' , 'low_star' : '<?php echo isset($aj_detail['low_star']) ? $aj_detail['low_star'] : 0; ?>' , 'low_end' : '<?php echo isset($aj_detail['low_end']) ? $aj_detail['low_end'] :0; ?>' ,  'protein_star' : '<?php echo isset($aj_detail['protein_star']) ? $aj_detail['protein_star'] : 0; ?>' , 'protein_end' : '<?php echo isset($aj_detail['protein_end']) ? $aj_detail['protein_end'] : 0; ?>' },
		success : function ( back ){
			var back = jQuery.parseJSON(back) ;
			var trs = "<tbody class='change_c' >";
			if( kinds == 1 ){
				$.each( back , function ( n, value) {
					trs += "<tr><td>" + (n+1) + "</td> <td>" + value.type + "</td> <td>" + value.sugar + "</td> <td>手动录入</td> <td>" + value.measuretimes + "</td> </tr>";
				});
			}else if ( kinds == 2 ){
				$.each( back , function ( n, value) {
					trs += "<tr><td>" + (n+1) + "</td> <td>" + value.high + "</td> <td>" + value.low + "</td> <td>手动录入</td> <td>" + value.measuretimes + "</td> </tr>";
				});
			}else {
				$.each( back , function ( n, value) {
					trs += "<tr><td>" + (n+1) + "</td> <td>糖化</td> <td>" + value.protein + "</td> <td>手动录入</td> <td>" + value.measuretimes + "</td> </tr>";
				});
			}
			trs = trs+"</tbody>"
			 $(" #change_d ").append(trs);

		}
	});
	if( kinds == 1 ){
		$(" .change_a ").html( "血糖" ) ;
		$(" .change_b ").html( "血糖值" ) ;
		$(" .change_b1 ").html( "类型" ) ;
		
	}else if( kinds == 2 ){
		$(" .change_a ").html( "血压" ) ;
		$(" .change_b ").html( "低压值" ) ;
		$(" .change_b1 ").html( "高压值" ) ;
	}else if( kinds == 3 ){
		$(" .change_a ").html( "糖化" ) ;
		$(" .change_b ").html( "糖化值" ) ;
		$(" .change_b1 ").html( "类型" ) ;
	}
	
	$(" #modal-detail ").attr( "class" , "modal hide fade in" ) ;
	$(" #modal-detail ").attr( "aria-hidden" , "false" ) ;
	$(" #modal-detail ").css( "display" , "block" ) ;
	$(document.body).append("<div class='modal-backdrop fade in' id='close_ma'  ></div>");
}
</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">患者数据汇总</div>
			<div class="panel-body">
				<ul>
					<li><a href="../doctor/index">所有医生</a></li>
					<li><a class="cur" href="javascript:;">数据汇总</a></li>
					<li><a href="../noticedoctor/index">医生通知</a></li>
					<li><a href="../noticeuser/index">患者通知</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">患者数据汇总</div>
			<div class="panel-body">
				<div id="record-index">
					<!--<div class="info"><div class="text">当前共有医生 <span>1</span> 名；覆盖患者 <span>3</span> 名；总计血糖数据 <span>8</span> 条；盒子数据 <span>50</span> 条。</div></div>-->
					<div class="search">
						<form action="<?php A_M_U('record/search') ?>" method="post">
							<div class="search-header">数据筛选</div>
							<div class="search-content">
								<div class="search-row">
									血糖范围：
									<input type="text" class="input-small" name="sugar-start"/> ~ <input type="text" class="input-small" name="sugar-end"/> （mmol/L）
									</div>
								<div class="search-row">
									血压范围：
									高压 <input type="text" class="input-small" name="height-start"/> ~ <input type="text" class="input-small" name="height-end"/> （mmHg） /
									低压 <input type="text" class="input-small" name="low-start"/> ~ <input type="text" class="input-small" name="low-end"/> （mmHg）
								</div>
								<div class="search-row">
									糖化范围：
									<input type="text" class="input-small" id="protein-start" name="protein-start" /> ~ <input type="text" class="input-small" id="protein-end" name="protein-end" /> （%）
								</div>
								<div class="search-row">
									患者城市：
									<select name="province" id="province" class="select-medium">
										<option value="0">省</option>
									</select>
									<select name="city" id="city" class="select-medium">
										<option value="0">市</option>
									</select>
								</div>
								<div class="search-row">
									记录时间：
									从 <input type="text" class="input-small" id="start-date" name="start-date" value="" style="width:80px;"/> 日
									<select name="start-hour" id="start-hour" style="width:60px;">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select> 时，到 <input type="text" class="input-small" id="end-date" name="end-date" value="" style="width:80px;"/> 日
									<select name="end-hour" id="end-hour" style="width:60px;">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select> 时
								</div>
							</div>
							<div class="form-buttons">
								<button class="btn btn-default" id="submit">筛选</button>
							</div>
						</form>
					</div>
					
					<div class="search-result">
						<ul class="users">
							<li class="user list-label f-cb">
								<div class="item item-checkbox"><input type="checkbox" id="checkall"/></div>
								<div class="item index">序号</div>
								<div class="item username">姓名</div>
								<div class="item mobile">手机</div>
								<div class="item email">邮箱</div>
								<div class="item city">城市</div>
								<div class="item doctor">主管医生</div>
								<div class="item control">查看数据</div>
							</li> 
							<?php foreach ($user_data as $k => $v){ ?>
								<li class="user f-cb hover">
									<div class="item item-checkbox"><input type="checkbox" id="check-1" class="checkitem" value="<?php echo $v['id'] ?>"/></div>
									<div class="item index"><?php echo $v['id'] ?></div>
									<div class="item username"><?php if($v['username']){ echo $v['username'] ; }else{ echo "未填写" ; } ?></div>
									<div class="item mobile"><?php if($v['mobile']){ echo $v['mobile'] ; }else{ echo "未填写" ; } ?></div>
									<div class="item email"><?php if($v['email']){ echo $v['email'] ; }else{ echo "未填写" ; } ?></div>
									<div class="item city">未填写 </div>
									<div class="item doctor"><?php if($v['doctor'] != 0){echo $v['doctor']['username'];}else{echo '未绑定';} ?></div>
									<div class="item control">

										<a data-userid="1" data-type="sugar" href="" onclick="details_find(<?php echo $v['id']; ?> , 1 )" class="detail-link" role="button" data-toggle="modal">[血糖]</a>


										<a data-userid="1" data-type="pressure" href="" onclick="details_find(<?php echo $v['id']; ?> , 2 )" class="detail-link" role="button" data-toggle="modal">[血压]</a>


										<a data-userid="1" data-type="protein" href="" onclick="details_find(<?php echo $v['id']; ?> , 3 )" class="detail-link" role="button" data-toggle="modal">[糖化]</a>

							
									</div>
								</li>
							<?php } ?>
						</ul>
					</div>
					<form action="export" method="post"  >
						<?php $aa = serialize($aj_detail); ?>
						<input type="text" value="" id="export_value" name="export_value" style="display:none" />
						<input  value='<?php echo $aa; ?>' id="export_search" name="export_search" style="display:none" />
						<div class="export-control"><button class="btn btn-primary" id="export">导出</button></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-detail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel"><span class="change_a" >血糖</span>详细筛选数据</h3>
	</div>
	<div class="modal-body">
		<table class="table table-striped table-hover table-bordered" id="change_d" >
			<thead>
				<tr>
					<th>序号</th>
					<th><span class="change_b1" >类型</span></th>
					<th><span class="change_b" >血糖值</span></th>
					<th>来源</th>
					<th>测量时间</th>
				</tr>
			</thead>
			 
		</table> 
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true" >关闭</button>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>