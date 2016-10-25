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
		var oldpassword = $.trim($('#oldpassword').val()),
			password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val())
		;
		if(oldpassword == '') {
			luiji_alert('error', '请输入当前登录密码！');
			nn_enableButton(_btn, '提交');
			return false;
		} else if(password != password2) {
			luiji_alert('error', '两次密码输入不一致！');
			nn_enableButton(_btn, '提交');
			return false;
		} else if(!is_password(password)) {
			luiji_alert('error', '新密码输入有误！');
			nn_enableButton(_btn, '提交');
			return false;
		} else {
			$.post('./editpwd',
				{
					oldpassword: oldpassword,
					password: password
				}, function(data) {
					if(data.result >= 0) {
						luiji_alert('success', '密码修改成功！');
						window.setTimeout(function() {
							window.location = './index';
						}, 1000);
					} else if(data.result == -1) {
						nn_enableButton(_btn, '提交');
						luiji_alert('error', '密码修改失败，原密码错误！');
					} else {
						nn_enableButton(_btn, '提交');
						luiji_alert('error', '修改失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="修改密码" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>修改密码</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="editpwd" class="gh-center">
	<div class="login-form">
		<div class="form-item">
			<label for="oldpassword">原密码：</label>
			<input type="password" name="oldpassword" id="oldpassword" placeholder="当前登录密码" value=""/>
		</div>
		<div class="form-item">
			<label for="password">新密码：</label>
			<input type="password" name="password" id="password" placeholder="新的登录密码" value=""/>
		</div>
		<div class="form-item">
			<label for="password2">确认密码：</label>
			<input type="password" name="password2" id="password2" placeholder="确认密码" value=""/>
		</div>
		
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-edit ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">提交</button>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>