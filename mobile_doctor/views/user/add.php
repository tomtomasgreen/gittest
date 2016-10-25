<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var mobile = $.trim($('#mobile').val()),
			username = $.trim($('#username').val()),
			userdes = ''
		;
		if(!is_mobile_or_email(mobile)) {
			luiji_alert('error', '请输入正确的手机号或邮箱');
			nn_enableButton(_btn, '添加');
			return false;
		} else {
			$.post('./bind',
				{
					mobile: mobile,
					username: username,
					userdes: userdes
				},
				function(data) {
					if(data.result > 0) {
						luiji_alert('success', '添加成功，等待用户通过！');
						window.setTimeout(function() {
							window.location = './index';
						}, 1000);
					} else if(data.result == -1) {
						luiji_alert('error', '手机号或邮箱不存在');
						nn_enableButton(_btn, '添加');
						return false;
					} else if(data.result == -2) {
						luiji_alert('error', '该患者已被关联，无法添加');
						nn_enableButton(_btn, '添加');
						return false;
					} else if(data.result == -3) {
						luiji_alert('error', '已关联该患者，正等待患者通过');
						nn_enableButton(_btn, '添加');
						return false;
					} else if(data.result == -4) {
						luiji_alert('error', '该患者已添加，正等待我通过申请');
						nn_enableButton(_btn, '添加');
						return false;
					} else {
						luiji_alert('error', '添加失败，待会再试');
						nn_enableButton(_btn, '添加');
						return false;
					}
				},
				'json'
			);
		}
	});
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="添加患者" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>添加患者</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="user-add" class="gh-center">
	
	<div class="form">
		<div class="form-item">
			<label for="mobile">患者手机/邮箱：<!--<a href="javascript:;" id="qrcode-btn" class="ui-btn ui-btn-inline ui-icon-camera ui-btn-icon-left">扫描二维码</a>--></label>
			<input type="text" name="mobile" id="mobile" placeholder="必填"/>
		</div>
		<div class="form-item">
			<label for="username">患者备注：</label>
			<input type="text" name="username" id="username" placeholder="选填"/>
		</div>
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">添加</button>
		</div>
	</div>
	
</div>


<?php
$this->load->view('include/footer');
?>