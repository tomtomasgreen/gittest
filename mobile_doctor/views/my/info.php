<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/js/uploadifive/uploadifive-mobile.css">
<script src="<?php echo base_url(); ?>public/js/uploadifive/jquery.uploadifive-mobile.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/areas.js"></script>
<script type="text/javascript"> 
$(function() {
	var
		cities_default = '<option value="0">市</option>',
		provinces = getAllProvinces(),
		provinces_options = '',
		current_province = '<?php echo $doctor['province']; ?>',
		current_city = '<?php echo $doctor['city']; ?>'
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
	$('#province option').each(function() {
		if($(this).val() == current_province) $(this).prop('selected', true);
	});
	$('#province').trigger('change');
	$('#city option').each(function() {
		if($(this).val() == current_city) $(this).prop('selected', true);
	});
	$('#city').trigger('change');
	
	$('#uploader-thumb').uploadifive({
		'auto'				: true,
		'formData'			: 
							{
								'timestamp'	: '<?php echo $timestamp;?>',
								'token'		: '<?php echo md5('nnguanhuai' . $timestamp);?>',
								'file'		: 'image'
							},
		'buttonText'		: '+ 更 换 头 像',
		'fileSizeLimit'   	: '51200kb',
		'queueID'			: 'uploader-queue-thumb',
		'uploadScript'		: '<?php echo base_url(); ?>public/js/uploadifive/uploadifive.php',
		'removeCompleted'	: true,
		'onUploadComplete'	: function(file, data) {
			data_thumb = data;
			$('#thumb-box img').attr('src', data_thumb);
			$('#thumb-box').css('display', 'inline-block');
			$('#thumb').val(data_thumb);
		}
	});
	
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var thumb = $.trim($('#thumb').val()),
			username = $.trim($('#username').val()),
			sex = $.trim($('.radio-sex:checked').val()),
			birthyear = $.trim($('#birthyear').val()),
			birthmonth = $.trim($('#birthmonth').val()),
			province = $.trim($('#province').val()),
			city = $.trim($('#city').val()),
			hospital = $.trim($('#hospital').val()),
			department = $.trim($('#department').val())
		;
		if(username == '') {
			luiji_alert('error', '请输入姓名');
			nn_enableButton(_btn, '提交');
			return false;
		} else if(sex == '') {
			luiji_alert('error', '请选择性别');
			nn_enableButton(_btn, '提交');
			return false;
		} else if(birthyear == 0 || birthmonth == 0) {
			luiji_alert('error', '请选择出生年月');
			nn_enableButton(_btn, '提交');
			return false;
		} else if(city == 0) {
			luiji_alert('error', '请选择城市');
			nn_enableButton(_btn, '提交');
			return false;
		} else if(hospital == '') {
			luiji_alert('error', '请输入所在医院');
			nn_enableButton(_btn, '提交');
			return false;
		}else if(department == '') {
			luiji_alert('error', '请输入所在科室');
			nn_enableButton(_btn, '提交');
			return false;
		} else {
			$.post('./info_update',
				{
					thumb :thumb,
					username :username,
					sex : sex,
					birthyear : birthyear,
					birthmonth : birthmonth,
					province : province,
					city : city,
					hospital : hospital,
					department : department
				}, function(data) {
					if(data.result >= 0) {
						luiji_alert('success', '个人资料编辑成功！');
						window.setTimeout(function() {
							window.location = './info';
						}, 1000);
					} else {
						nn_enableButton(_btn, '提交');
						luiji_alert('error', '编辑失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="个人资料" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>个人资料</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="editpwd" class="gh-center">
	<div class="login-form">
		<div class="form-item">
			<label for="thumb">头像：</label>
			<?php
			if($doctor['thumb']) {
			?>
			<div class="uploader-preview" id="thumb-box" style="display:inline-block;"><img src="<?php echo nn_fix_uploadurl($doctor['thumb']); ?>" width="100%"/></div>
			<?php
			} else {
			?>
			<div class="uploader-preview" id="thumb-box"><img src="<?php echo base_url(); ?>public/images/pass.png" width="100%"/></div>
			<?php
			}
			?>
			<div class="uploader-box">
				<input type="file" name="uploader-thumb" class="uploader" id="uploader-thumb"/>
				<input type="hidden" id="thumb" name="thumb" value="<?php echo $doctor['thumb']; ?>"/>
			</div>
			<div class="uploader-queue" id="uploader-queue-thumb"></div>
		</div>
		<div class="form-item">
			<label for="username">姓名：</label>
			<input type="text" name="username" id="username" placeholder="输入姓名" value="<?php echo $doctor['username']; ?>"/>
		</div>
		<div class="form-item">
			<label for="sex">性别：</label>
			<fieldset data-role="controlgroup" data-type="horizontal" style="padding-bottom:16px;">
				<input type="radio" name="sex" class="radio-sex" id="radio-sex-male" value="男" <?php echo ($doctor['sex'] == '男') ? 'checked="checked"' : ''; ?>/>
				<label for="radio-sex-male">男</label>
				<input type="radio" name="sex" class="radio-sex" id="radio-sex-female" value="女" <?php echo ($doctor['sex'] == '女') ? 'checked="checked"' : ''; ?>/>
				<label for="radio-sex-female">女</label>
			</fieldset>
		</div>
		<div class="form-item">
			<label for="birth">出生年月：</label>
			<fieldset data-role="controlgroup" data-type="horizontal" style="padding-bottom:16px;">
				<label for="birthyear">年份</label>
				<select name="birthyear" id="birthyear">
					<option value="0">年</option>
					<?php
					for($i = date('Y', time()); $i >= 1900; $i--) {
						if($i == $doctor['birthyear']) echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
						else echo '<option value="' . $i . '">' . $i . '</option>';
					}
					?>
				</select>
				<label for="birthmonth">月份</label>
				<select name="birthmonth" id="birthmonth">
					<option value="0">月</option>
					<?php
					for($i = 1; $i < 13; $i++) {
						if($i == $doctor['birthmonth']) echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
						else echo '<option value="' . $i . '">' . $i . '</option>';
					}
					?>
				</select>
			</fieldset>
		</div>
		<div class="form-item">
			<label for="area">所在城市：</label>
			<fieldset data-role="controlgroup" data-type="horizontal" style="padding-bottom:16px;">
				<label for="province">省</label>
				<select name="province" id="province">
					<option value="0">省</option>
				</select>
				<label for="city">市</label>
				<select name="city" id="city">
					<option value="0">市</option>
				</select>
			</fieldset>
		</div>
		<div class="form-item">
			<label for="hospital">所在医院：</label>
			<input type="text" name="hospital" id="hospital" placeholder="输入所在医院" value="<?php echo $doctor['hospital']; ?>"/>
		</div>
		<div class="form-item">
			<label for="department">所在科室：</label>
			<input type="text" name="department" id="department" placeholder="输入所在科室" value="<?php echo $doctor['department']; ?>"/>
		</div>
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-edit ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline f-br6" id="submit">提交</button>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>