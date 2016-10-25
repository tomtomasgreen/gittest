<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<link rel="stylesheet" href="<?php echo site_url(); ?>public/js/uploadifive/uploadifive-mobile.css">
<script src="<?php echo site_url(); ?>public/js/uploadifive/jquery.uploadifive-mobile.min.js"></script>
<script type="text/javascript"> 
$(function() {
	active_navbar('记录');
	
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
		'uploadScript'		: '<?php echo site_url(); ?>public/js/uploadifive/uploadifive.php',
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
			measuretime = $.trim($('#measuretime_1').val()),
			type = $.trim($('#type_1').val()),
			sugar = $.trim($('#sugar').val())
		;
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写测量时间！');
			nn_enableButton(_btn, '保存血糖');
			return false;
		} else if(!is_sugar(sugar)) {
			luiji_alert('error', '请正确填写血糖值！');
			nn_enableButton(_btn, '保存血糖');
			return false;
		} else {
			$.post('./save',
				{
					record		: 'sugar',
					measuredate	: measuredate,
					measuretime	: measuretime,
					type		: type,
					sugar		: sugar
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存血糖');
						luiji_alert('error', '添加失败，请稍后重试~');
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
			measuretime = $.trim($('#measuretime_2').val()),
			high = $.trim($('#high').val()),
			low = $.trim($('#low').val())
		;
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写测量时间！');
			nn_enableButton(_btn, '保存血糖');
			return false;
		} else if(!(is_pressure(high) && is_pressure(low))) {
			luiji_alert('error', '请正确填写血压值！');
			nn_enableButton(_btn, '保存血压');
			return false;
		} else {
			$.post('./save',
				{
					record		: 'pressure',
					measuredate	: measuredate,
					measuretime	: measuretime,
					high		: high,
					low			: low
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存血压');
						luiji_alert('error', '添加失败，请稍后重试~');
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
			measuretime = $.trim($('#measuretime_3').val()),
			photo = $.trim($('#photo_3').val()),
			type = $.trim($('#type_3').val()),
			content = $.trim($('#content_3').val())
		;
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写用餐时间！');
			nn_enableButton(_btn, '保存用餐');
			return false;
		} else if(!photo && !content) {
			luiji_alert('error', '照片和备注至少填写一项！');
			nn_enableButton(_btn, '保存用餐');
			return false;
		} else {
			$.post('./save',
				{
					record		: 'food',
					measuredate	: measuredate,
					measuretime	: measuretime,
					photo		: photo,
					type		: type,
					content		: content
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存用餐');
						luiji_alert('error', '添加失败，请稍后重试~');
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
			measuretime = $.trim($('#measuretime_4').val()),
			photo = $.trim($('#photo_4').val()),
			type = $.trim($('#type_4').val()),
			content = $.trim($('#content_4').val())
		;
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写用药时间！');
			nn_enableButton(_btn, '保存用药');
			return false;
		} else if(!photo && !content) {
			luiji_alert('error', '照片和备注至少填写一项！');
			nn_enableButton(_btn, '保存用药');
			return false;
		} else {
			$.post('./save',
				{
					record		: 'drug',
					measuredate	: measuredate,
					measuretime	: measuretime,
					photo		: photo,
					type		: type,
					content		: content
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存用药');
						luiji_alert('error', '添加失败，请稍后重试~');
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
			measuretime = $.trim($('#measuretime_5').val()),
			height = $.trim($('#height').val()),
			weight = $.trim($('#weight').val())
		;
		// console.log('is_height - ' + is_height(height));
		// console.log('is_weight - ' + is_weight(weight));
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写测量时间！');
			nn_enableButton(_btn, '保存BMI');
			return false;
		} else if(!(is_height(height) && is_weight(weight))) {
			luiji_alert('error', '请正确填写身高体重值！');
			nn_enableButton(_btn, '保存BMI');
			return false;
		} else {
			// nn_enableButton(_btn, '保存BMI');
			// return false;
			$.post('./save',
				{
					record		: 'bmi',
					measuredate	: measuredate,
					measuretime	: measuretime,
					height		: height,
					weight		: weight
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存BMI');
						luiji_alert('error', '添加失败，请稍后重试~');
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
			measuretime = $.trim($('#measuretime_6').val()),
			photo = $.trim($('#photo_6').val()),
			type = $.trim($('#type_6').val()),
			content = $.trim($('#content_6').val())
		;
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写就诊时间！');
			nn_enableButton(_btn, '保存就诊');
			return false;
		} else if(!photo && !content) {
			luiji_alert('error', '照片和备注至少填写一项！');
			nn_enableButton(_btn, '保存就诊');
			return false;
		} else {
			$.post('./save',
				{
					record		: 'visit',
					measuredate	: measuredate,
					measuretime	: measuretime,
					photo		: photo,
					type		: type,
					content		: content
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存就诊');
						luiji_alert('error', '添加失败，请稍后重试~');
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
			measuretime = $.trim($('#measuretime_7').val()),
			waist = $.trim($('#waist').val()),
			hip = $.trim($('#hip').val())
		;
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写测量时间！');
			nn_enableButton(_btn, '保存腰臀比');
			return false;
		} else if(!(is_waist(waist) && is_hip(hip))) {
			luiji_alert('error', '请正确填写腰围与臀围！');
			nn_enableButton(_btn, '保存腰臀比');
			return false;
		} else {
			$.post('./save',
				{
					record		: 'whr',
					measuredate	: measuredate,
					measuretime	: measuretime,
					waist		: waist,
					hip			: hip
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存腰臀比');
						luiji_alert('error', '添加失败，请稍后重试~');
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
			measuretime = $.trim($('#measuretime_8').val()),
			protein = $.trim($('#protein').val())
		;
		if(measuredate == '' || measuretime == '') {
			luiji_alert('error', '请填写测量时间！');
			nn_enableButton(_btn, '保存');
			return false;
		} else if(!(is_protein(protein))) {
			luiji_alert('error', '请正确填写糖化血红蛋白值！');
			nn_enableButton(_btn, '保存');
			return false;
		} else {
			$.post('./save',
				{
					record		: 'protein',
					measuredate	: measuredate,
					measuretime	: measuretime,
					protein		: protein
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>record/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存');
						luiji_alert('error', '添加失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	
	cal_bmi();
	$('#height').change(function() {
		cal_bmi();
	});
	$('#weight').change(function() {
		cal_bmi();
	});
	function cal_bmi() {
		var height = $('#height').val(), weight = $('#weight').val();
		var bmi = (weight / height / height * 10000).toFixed(1);
		$('#bmi_value').text(bmi);
	}
	cal_whr();
	$('#waist').change(function() {
		cal_whr();
	});
	$('#hip').change(function() {
		cal_whr();
	});
	function cal_whr() {
		var waist = $('#waist').val(), hip = $('#hip').val();
		var whr = (waist / hip * 100).toFixed(1);
		$('#whr_value').text(whr);
	}
	
	// $('#record-edit .ui-collapsible-heading a:first').trigger('click');
});
</script>
<style type="text/css">
.uploader-box{width:100%;border:0;}
.uploader-preview{margin-bottom:8px;padding:5px;border:1px solid #ccc;display:none;}
.uploader-preview img{width:100%;height:auto;}
.uploader-queue{width:100%;}
.uploader-helper{color:#0088cc;}
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="记录" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>记录</h1>
	<a href="javascript:;" data-ajax="false" style="padding:0;margin:0;width:0;height:0;border:0;"></a>
	<a href="./show" data-icon="calendar" data-ajax="false">数据</a>
</div>
<div id="record-edit" class="gh-center">
<div data-role="collapsibleset" data-mini="true" data-iconpos="right" data-collapsed-icon="carat-d" data-expanded-icon="carat-u">
	<div data-role="collapsible" data-active="true">
		<h3 class="record-1">血糖</h3>
		<div id="sugar-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_1">测量时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_1" id="measuredate_1" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_1" id="measuretime_1" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
					</div>
				</div>
				<div class="form-item">
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
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit-sugar">保存血糖</button>
				</div>
			</div>
		</div>
	</div>
	<div data-role="collapsible">
		<h3 class="record-2">血压</h3>
		<div id="pressure-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_2">测量时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_2" id="measuredate_2" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_2" id="measuretime_2" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
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
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline save-btn" id="submit-pressure">保存血压</button>
				</div>
			</div>
		</div>
	</div>
	<div data-role="collapsible">
		<h3 class="record-3">饮食</h3>
		<div id="food-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_3">用餐时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_3" id="measuredate_3" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_3" id="measuretime_3" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
					</div>
				</div>
				<div class="form-item">
					<div class="uploader-preview" id="photo_3-box"><img src="<?php echo site_url(); ?>public/images/pass.png" width="100%"/></div>
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
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit-food">保存用餐</button>
				</div>
			</div>
		</div>
	</div>
	<div data-role="collapsible">
		<h3 class="record-4">用药</h3>
		<div id="drag-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_4">用药时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_4" id="measuredate_4" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_4" id="measuretime_4" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
					</div>
				</div>
				<div class="form-item">
					<div class="uploader-preview" id="photo_4-box"><img src="<?php echo site_url(); ?>public/images/pass.png" width="100%"/></div>
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
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit-drug">保存用药</button>
				</div>
			</div>
		</div>
	</div>
	<div data-role="collapsible">
		<h3 class="record-5">BMI</h3>
		<div id="pressure-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_5">测量时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_5" id="measuredate_5" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_5" id="measuretime_5" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
					</div>
				</div>
				<div class="form-item">
					<label class="cal_label">BMI值（下方计算）：<span class="cal_value" id="bmi_value">0</span></label>
				</div>
				<div class="form-item">
					<label for="height">身高（厘米）：</label>
					<div class="ui-field-contain slider-box-item" id="slider-height">
						<input type="range" name="height" id="height" min="130" max="230" value="175" step="2" data-show-value="false" data-popup-enabled="true" data-highlight="true"/>
					</div>
				</div>
				<div class="form-item">
					<label for="weight">体重（公斤）：</label>
					<div class="ui-field-contain slider-box-item" id="slider-weight">
						<input type="range" name="weight" id="weight" min="40" max="150" value="60" step="2" data-show-value="false" data-popup-enabled="true" data-highlight="true"/>
					</div>
				</div>
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline save-btn" id="submit-bmi">保存BMI</button>
				</div>
			</div>
		</div>
	</div>
	<div data-role="collapsible">
		<h3 class="record-6">就诊</h3>
		<div id="visit-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_6">就诊时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_6" id="measuredate_6" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_6" id="measuretime_6" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
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
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit-visit">保存就诊</button>
				</div>
			</div>
		</div>
	</div>
	<div data-role="collapsible">
		<h3 class="record-7">腰臀比</h3>
		<div id="whr-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_7">测量时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_7" id="measuredate_7" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_7" id="measuretime_7" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
					</div>
				</div>
				<div class="form-item">
					<label class="cal_label">腰臀比（下方计算）：<span class="cal_value" id="whr_value">0</span></label>
				</div>
				<div class="form-item">
					<label for="waist">腰围（厘米）：</label>
					<div class="ui-field-contain slider-box-item" id="slider-waist">
						<input type="range" name="waist" id="waist" min="40" max="150" value="60" step="2" data-show-value="false" data-popup-enabled="true" data-highlight="true"/>
					</div>
				</div>
				<div class="form-item">
					<label for="hip">臀围（厘米）：</label>
					<div class="ui-field-contain slider-box-item" id="slider-hip">
						<input type="range" name="hip" id="hip" min="50" max="150" value="90" step="2" data-show-value="false" data-popup-enabled="true" data-highlight="true"/>
					</div>
				</div>
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline save-btn" id="submit-whr">保存腰臀比</button>
				</div>
			</div>
		</div>
	</div>
	<div data-role="collapsible">
		<h3 class="record-8">糖化血红蛋白</h3>
		<div id="protein-panel">
			<div class="form">
				<div class="form-item">
					<label for="measuredate_8">测量时间：</label>
					<div class="datetime f-cb">
						<div class="datetime-item-1 f-fl"><input type="date" name="measuredate_8" id="measuredate_8" value="<?php echo date('Y-m-d', $timestamp); ?>"/></div>
						<div class="datetime-item-2 f-fr"><input type="time" name="measuretime_8" id="measuretime_8" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
					</div>
				</div>
				<div class="form-item">
					<label for="protein">测量值（%）：</label>
					<input type="text" name="protein" id="protein"/>
				</div>
				<div class="ui-field-contain">
					<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit-protein">保存</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>