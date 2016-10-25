<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<link href="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/css/redmond/jquery-ui.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/uploadifive/uploadifive.css">
<script src="<?php echo base_url(); ?>public/js/uploadifive/jquery.uploadifive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/i18n/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript"> 
$(function() {
	$('.measuredate').datepicker();
	
	$('.item-sugar').show();
	$('.records-nav li').click(function (){
		var
			tab = $(this),
			item_label = tab.data('item'),
			item = $('.item-' + item_label)
		;
		$('.records-nav li').removeClass('active');
		tab.addClass('active');
		$('.records .item').hide();
		item.show();
	});
	
	$('#slider-height').slider({
		range: 'min',
		value: 175,
		min: 130,
		max: 230,
		slide: function(event, ui) {
			$('#val-height').text(ui.value);
			cal_bmi();
		}
	});
	$('#slider-weight').slider({
		range: 'min',
		value: 60,
		min: 40,
		max: 150,
		slide: function(event, ui) {
			$('#val-weight').text(ui.value);
			cal_bmi();
		}
	});
	$('#slider-waist').slider({
		range: 'min',
		value: 60,
		min: 40,
		max: 150,
		slide: function(event, ui) {
			$('#val-waist').text(ui.value);
			cal_whr();
		}
	});
	$('#slider-hip').slider({
		range: 'min',
		value: 90,
		min: 50,
		max: 150,
		slide: function(event, ui) {
			$('#val-hip').text(ui.value);
			cal_whr();
		}
	});
	
	cal_bmi();
	cal_whr();
	function cal_bmi() {
		var height = $('#val-height').text(), weight = $('#val-weight').text();
		var bmi = (weight / height / height * 10000).toFixed(1);
		$('#bmi_value').text(bmi);
	}
	function cal_whr() {
		var waist = $('#val-waist').text(), hip = $('#val-hip').text();
		var whr = (waist / hip * 100).toFixed(1);
		$('#whr_value').text(whr);
	}
	
	var data_photo_3 = false, data_photo_4 = false, data_photo_6 = false;
	$('#uploader-photo_3').uploadifive({
		'auto'				: true,
		'formData'			: 
							{
								'timestamp'	: '<?php echo $timestamp;?>',
								'token'		: '<?php echo md5('nnguanhuai' . $timestamp);?>',
								'file'		: 'image'
							},
		'buttonText'		: '+ 选 择 照 片',
		'fileSizeLimit'   	: '51200kb',
		'queueID'			: 'uploader-queue-photo_3',
		'uploadScript'		: '<?php echo base_url(); ?>public/js/uploadifive/uploadifive.php',
		'removeCompleted'	: true,
		'onUploadComplete'	: function(file, data) {
			data_photo_3 = data;
			$('#photo_3-box img').attr('src', data_photo_3);
			$('#photo_3-box').css('display', 'inline-block');
			$('#photo_3').val(data_photo_3);
		}
	});
	$('#uploader-photo_4').uploadifive({
		'auto'				: true,
		'formData'			: 
							{
								'timestamp'	: '<?php echo $timestamp;?>',
								'token'		: '<?php echo md5('nnguanhuai' . $timestamp);?>',
								'file'		: 'image'
							},
		'buttonText'		: '+ 选 择 照 片',
		'fileSizeLimit'   	: '51200kb',
		'queueID'			: 'uploader-queue-photo_4',
		'uploadScript'		: '<?php echo site_url(); ?>public/js/uploadifive/uploadifive.php',
		'removeCompleted'	: true,
		'onUploadComplete'	: function(file, data) {
			data_photo_4 = data;
			$('#photo_4-box img').attr('src', data_photo_4);
			$('#photo_4-box').css('display', 'inline-block');
			$('#photo_4').val(data_photo_4);
		}
	});
	$('#uploader-photo_6').uploadifive({
		'auto'				: true,
		'formData'			: 
							{
								'timestamp'	: '<?php echo $timestamp;?>',
								'token'		: '<?php echo md5('nnguanhuai' . $timestamp);?>',
								'file'		: 'image'
							},
		'buttonText'		: '+ 选 择 照 片',
		'fileSizeLimit'   	: '51200kb',
		'queueID'			: 'uploader-queue-photo_6',
		'uploadScript'		: '<?php echo site_url(); ?>public/js/uploadifive/uploadifive.php',
		'removeCompleted'	: true,
		'onUploadComplete'	: function(file, data) {
			data_photo_6 = data;
			$('#photo_6-box img').attr('src', data_photo_6);
			$('#photo_6-box').css('display', 'inline-block');
			$('#photo_6').val(data_photo_6);
		}
	});
	
	$('#submit-sugar').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_1').val()),
			measuretime_hour = $.trim($('#measuretime_1_hour').val()),
			measuretime_minute = $.trim($('#measuretime_1_minute').val()),
			type = $.trim($('#type_1').val()),
			sugar = $.trim($('#sugar').val())
		;
		if(measuredate == '') {
			alert('请填写测量时间！');
			nn_enableButton(_btn, '保存血糖');
			return false;
		} else if(!is_sugar(sugar)) {
			alert('请正确填写血糖值！');
			nn_enableButton(_btn, '保存血糖');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'sugar',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					type		: type,
					sugar		: sugar
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存血糖');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	$('#submit-pressure').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_2').val()),
			measuretime_hour = $.trim($('#measuretime_2_hour').val()),
			measuretime_minute = $.trim($('#measuretime_2_minute').val()),
			high = $.trim($('#high').val()),
			low = $.trim($('#low').val())
		;
		if(measuredate == '') {
			alert('请填写测量时间！');
			nn_enableButton(_btn, '保存血糖');
			return false;
		} else if(!(is_pressure(high) && is_pressure(low))) {
			alert('请正确填写血压值！');
			nn_enableButton(_btn, '保存血压');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'pressure',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					high		: high,
					low			: low
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存血压');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	$('#submit-food').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_3').val()),
			measuretime_hour = $.trim($('#measuretime_3_hour').val()),
			measuretime_minute = $.trim($('#measuretime_3_minute').val()),
			photo = $.trim($('#photo_3').val()),
			type = $.trim($('#type_3').val()),
			content = $.trim($('#content_3').val())
		;
		if(measuredate == '') {
			alert('请填写用餐时间！');
			nn_enableButton(_btn, '保存用餐');
			return false;
		} else if(!photo && !content) {
			alert('照片和备注至少填写一项！');
			nn_enableButton(_btn, '保存用餐');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'food',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					photo		: photo,
					type		: type,
					content		: content
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存用餐');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	$('#submit-drug').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_4').val()),
			measuretime_hour = $.trim($('#measuretime_4_hour').val()),
			measuretime_minute = $.trim($('#measuretime_4_minute').val()),
			photo = $.trim($('#photo_4').val()),
			type = $.trim($('#type_4').val()),
			content = $.trim($('#content_4').val())
		;
		if(measuredate == '') {
			alert('请填写用药时间！');
			nn_enableButton(_btn, '保存用药');
			return false;
		} else if(!photo && !content) {
			alert('照片和备注至少填写一项！');
			nn_enableButton(_btn, '保存用药');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'drug',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					photo		: photo,
					type		: type,
					content		: content
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存用药');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	$('#submit-bmi').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_5').val()),
			measuretime_hour = $.trim($('#measuretime_5_hour').val()),
			measuretime_minute = $.trim($('#measuretime_5_minute').val()),
			height = $('#val-height').text(),
			weight = $('#val-weight').text()
		;
		if(measuredate == '') {
			alert('请填写测量时间！');
			nn_enableButton(_btn, '保存BMI');
			return false;
		} else if(!(is_height(height) && is_weight(weight))) {
			alert('请正确填写身高体重值！');
			nn_enableButton(_btn, '保存BMI');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'bmi',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					height		: height,
					weight		: weight
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存BMI');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	$('#submit-visit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_6').val()),
			measuretime_hour = $.trim($('#measuretime_6_hour').val()),
			measuretime_minute = $.trim($('#measuretime_6_minute').val()),
			photo = $.trim($('#photo_6').val()),
			type = $.trim($('#type_6').val()),
			content = $.trim($('#content_6').val())
		;
		if(measuredate == '') {
			alert('请填写就诊时间！');
			nn_enableButton(_btn, '保存就诊');
			return false;
		} else if(!photo && !content) {
			alert('照片和备注至少填写一项！');
			nn_enableButton(_btn, '保存就诊');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'visit',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					photo		: photo,
					type		: type,
					content		: content
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存就诊');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	$('#submit-whr').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_7').val()),
			measuretime_hour = $.trim($('#measuretime_7_hour').val()),
			measuretime_minute = $.trim($('#measuretime_7_minute').val()),
			waist = $('#val-waist').text(),
			hip = $('#val-hip').text()
		;
		if(measuredate == '') {
			alert('请填写测量时间！');
			nn_enableButton(_btn, '保存腰臀比');
			return false;
		} else if(!(is_waist(waist) && is_hip(hip))) {
			alert('请正确填写腰围与臀围！');
			nn_enableButton(_btn, '保存腰臀比');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'whr',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					waist		: waist,
					hip			: hip
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存腰臀比');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	$('#submit-protein').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在保存...');
		var measuredate = $.trim($('#measuredate_8').val()),
			measuretime_hour = $.trim($('#measuretime_8_hour').val()),
			measuretime_minute = $.trim($('#measuretime_8_minute').val()),
			protein = $.trim($('#protein').val())
		;
		if(measuredate == '') {
			alert('请填写测量时间！');
			nn_enableButton(_btn, '保存');
			return false;
		} else if(!(is_protein(protein))) {
			alert('请正确填写糖化血红蛋白值！');
			nn_enableButton(_btn, '保存');
			return false;
		} else {
			$.post('../save',
				{
					record		: 'protein',
					userid		: <?php echo $user['id']; ?>,
					measuredate	: measuredate,
					measuretime_hour	: measuretime_hour,
					measuretime_minute	: measuretime_minute,
					protein		: protein
				}, function(data) {
					if(data.result > 0) {
						alert('保存成功！');
						window.location.reload();
					} else {
						nn_enableButton(_btn, '保存');
						alert('添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
});
</script>
<style type="text/css">
.uploader-box{width:100%;border:0;margin-bottom:20px;}
.uploader-preview{margin-bottom:8px;padding:5px;border:1px solid #ccc;display:none;}
.uploader-preview img{width:100%;height:auto;}
.uploader-queue{width:100%;}
.uploader-helper{color:#0088cc;}
</style>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">数据员后台</div>
			<div class="panel-body">
				<ul>
					<li><a href="../../user/index">所有患者</a></li>
					<li><a class="cur" href="javascript:;">添加记录</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">添加记录<a href="../../user/history/<?php echo $user['id']; ?>" class="btn btn-primary f-fr">历史记录</a></div>
			<div class="panel-body">
				<div class="user-detail">
					<div class="f-cb">
						<div class="thumb f-fl"><img src="<?php echo $user['thumb'] ? nn_fix_uploadurl($user['thumb']) : (base_url() . 'public/images/user-nophoto.jpg'); ?>" width="200"/></div>
						<div class="detail f-fl">
							<div class="ud-item">用户名：<?php echo $user['username']; ?></div>
							<div class="ud-item">性别：<?php echo $user['sex']; ?></div>
							<div class="ud-item">出生年月：<?php echo $user['birthyear']; ?> / <?php echo $user ['birthmonth']; ?></div>
							<div class="ud-item">手机号/邮箱：<?php echo $user['mobile']; ?> / <?php echo $user['email']; ?></div>
							<div class="ud-item">地区：<?php echo $AREAS[$user['province']]; ?> <?php echo $AREAS[$user['city']]; ?></div>
						</div>
					</div>
				</div>
				<div id="user-record">
					<ul class="nav nav-pills records-nav">
						<li role="presentation" data-item="sugar" class="active"><a href="javascript:;">血糖</a></li>
						<li role="presentation" data-item="pressure"><a href="javascript:;">血压</a></li>
						<li role="presentation" data-item="food"><a href="javascript:;">饮食</a></li>
						<li role="presentation" data-item="drug"><a href="javascript:;">用药</a></li>
						<li role="presentation" data-item="bmi"><a href="javascript:;">BMI</a></li>
						<li role="presentation" data-item="visit"><a href="javascript:;">就诊</a></li>
						<li role="presentation" data-item="stature"><a href="javascript:;">腰臀比</a></li>
						<li role="presentation" data-item="protein"><a href="javascript:;">糖化血红蛋白</a></li>
					</ul>
					<div class="records">
						<div class="item item-sugar">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_1">测量时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_1" id="measuredate_1" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_1_hour" id="measuretime_1_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_1_minute" id="measuretime_1_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item">
									<label for="type_1">类型：</label>
									<select name="type_1" id="type_1">
										<option value="空腹">空腹</option>
										<option value="早餐后">早餐后</option>
										<option value="午餐前">午餐前</option>
										<option value="午餐后">午餐后</option>
										<option value="晚餐前">晚餐前</option>
										<option value="晚餐后">晚餐后</option>
										<option value="睡前">睡前</option>
										<option value="凌晨">凌晨</option>
									</select>
								</div>
								<div class="form-item">
									<label for="sugar">血糖值（mmol/L）：</label>
									<input type="text" name="sugar" id="sugar"/>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-sugar">保存血糖</button>
								</div>
							</div>
						</div>
						<div class="item item-pressure">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_2">测量时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_2" id="measuredate_2" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_2_hour" id="measuretime_2_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_2_minute" id="measuretime_2_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item">
									<label for="high">高压值（mmHg）：</label>
									<input type="number" name="high" id="high"/>
								</div>
								<div class="form-item">
									<label for="low">低压值（mmHg）：</label>
									<input type="number" name="low" id="low"/>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-pressure">保存血压</button>
								</div>
							</div>
						</div>
						<div class="item item-food">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_3">用餐时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_3" id="measuredate_3" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_3_hour" id="measuretime_3_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_3_minute" id="measuretime_3_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item">
									<div class="uploader-preview" id="photo_3-box"><img src="<?php echo base_url(); ?>public/images/pass.png" width="100%"/></div>
									<div class="uploader-box">
										<input type="file" name="uploader-photo_3" class="uploader" id="uploader-photo_3"/>
										<input type="hidden" id="photo_3" name="photo_3" value=""/>
									</div>
									<div class="uploader-queue" id="uploader-queue-photo_3"></div>
								</div>
								<div class="form-item">
									<select name="type_3" id="type_3">
										<option value="早餐">早餐</option>
										<option value="午餐">午餐</option>
										<option value="晚餐">晚餐</option>
										<option value="加餐">加餐</option>
									</select>
								</div>
								<div class="form-item">
									<textarea name="content_3" id="content_3" placeholder="备注信息"></textarea>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-food">保存用餐</button>
								</div>
							</div>
						</div>
						<div class="item item-drug">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_4">用药时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_4" id="measuredate_4" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_4_hour" id="measuretime_4_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_4_minute" id="measuretime_4_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item">
									<div class="uploader-preview" id="photo_4-box"><img src="<?php echo base_url(); ?>public/images/pass.png" width="100%"/></div>
									<div class="uploader-box">
										<input type="file" name="uploader-photo_4" class="uploader" id="uploader-photo_4"/>
										<input type="hidden" id="photo_4" name="photo_4" value=""/>
									</div>
									<div class="uploader-queue" id="uploader-queue-photo_4"></div>
								</div>
								<div class="form-item">
									<select name="type_4" id="type_4">
										<option value="早餐">早餐</option>
										<option value="午餐">午餐</option>
										<option value="晚餐">晚餐</option>
										<option value="其他">其他</option>
									</select>
								</div>
								<div class="form-item">
									<textarea name="content_4" id="content_4" placeholder="备注信息"></textarea>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-drug">保存用药</button>
								</div>
							</div>
						</div>
						<div class="item item-bmi">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_5">测量时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_5" id="measuredate_5" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_5_hour" id="measuretime_5_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_5_minute" id="measuretime_5_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item" style="padding:15px 0;">
									<label class="cal_label" style="font-size:24px;">BMI值（下方计算）：<span class="cal_value" id="bmi_value" style="font-size:36px;color:#f33;font-weight:bold;">0</span></label>
								</div>
								<div class="form-item" style="padding:15px 0;">
									<label for="height">身高（<span class="slider-val" id="val-height">175</span> 厘米）：</label>
									<div class="ui-field-contain slider-box-item">
										<div id="slider-height"></div>
									</div>
								</div>
								<div class="form-item" style="padding:15px 0;">
									<label for="weight">体重（<span class="slider-val" id="val-weight">60</span> 公斤）：</label>
									<div class="ui-field-contain slider-box-item">
										<div id="slider-weight"></div>
									</div>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-bmi">保存BMI</button>
								</div>
							</div>
						</div>
						<div class="item item-visit">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_6">就诊时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_6" id="measuredate_6" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_6_hour" id="measuretime_6_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_6_minute" id="measuretime_6_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item">
									<div class="uploader-preview" id="photo_6-box"><img src="<?php echo site_url(); ?>public/images/pass.png" width="100%"/></div>
									<div class="uploader-box">
										<input type="file" name="uploader-photo_6" class="uploader" id="uploader-photo_6"/>
										<input type="hidden" id="photo_6" name="photo_6" value=""/>
									</div>
									<div class="uploader-queue" id="uploader-queue-photo_6"></div>
								</div>
								<div class="form-item">
									<select name="type_6" id="type_6">
										<option value="取药">取药</option>
										<option value="化验">化验</option>
										<option value="复查">复查</option>
										<option value="新患者就诊">新患者就诊</option>
										<option value="其他">其他</option>
									</select>
								</div>
								<div class="form-item">
									<textarea name="content_6" id="content_6" placeholder="备注信息"></textarea>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-visit">保存就诊</button>
								</div>
							</div>
						</div>
						<div class="item item-stature">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_7">测量时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_7" id="measuredate_7" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_7_hour" id="measuretime_7_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_7_minute" id="measuretime_7_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item" style="padding:15px 0;">
									<label class="cal_label" style="font-size:24px;">腰臀比（下方计算）：<span class="cal_value" id="whr_value" style="font-size:36px;color:#f33;font-weight:bold;">0</span></label>
								</div>
								<div class="form-item" style="padding:15px 0;">
									<label for="waist">腰围（<span class="slider-val" id="val-waist">60</span> 厘米）：</label>
									<div class="ui-field-contain slider-box-item">
										<div id="slider-waist"></div>
									</div>
								</div>
								<div class="form-item" style="padding:15px 0;">
									<label for="hip">臀围（<span class="slider-val" id="val-hip">90</span> 厘米）：</label>
									<div class="ui-field-contain slider-box-item">
										<div id="slider-hip"></div>
									</div>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-whr">保存腰臀比</button>
								</div>
							</div>
						</div>
						<div class="item item-protein">
							<div class="form">
								<div class="form-item">
									<label for="measuredate_8">测量时间：</label>
									<div class="datetime f-cb">
										<input type="text" name="measuredate_8" id="measuredate_8" class="measuredate" value="<?php echo date('Y-m-d', $timestamp); ?>" style="width:100px;"/> 日
										<select name="measuretime_8_hour" id="measuretime_8_hour" style="width:60px;">
											<?php
											for($i = 0; $i < 24; $i++) {
											?>
											<option value="<?php echo $i; ?>" <?php if(date('H', $timestamp) == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 时
										<select name="measuretime_8_minute" id="measuretime_8_minute" style="width:60px;">
											<?php
											for($i = 0; $i < 60; $i++) {
											?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php
											}
											?>
										</select> 分
									</div>
								</div>
								<div class="form-item">
									<label for="protein">测量值（%）：</label>
									<input type="text" name="protein" id="protein"/>
								</div>
								<hr />
								<div class="ui-field-contain">
									<button class="btn btn-primary" id="submit-protein">保存</button>
								</div>
							</div>
						</div>
					</div>
				</div>
					
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>