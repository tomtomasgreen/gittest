<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="apple-mobile-web-app-title" content=""/>
<meta name="format-detection" content="telephone=no"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<title>诺和关怀</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/js/jquery.mobile-1.4.5/jquery.mobile.flatui.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/m.css">
<script src="<?php echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/m.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
$(function() {
	$('#btn-phonecode').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '请稍等...');
		var mobile = $.trim($('#mobile').val());
		// var ismobile = is_mobile(mobile);
		if(!is_mobile(mobile)) {
			luiji_alert('error', '手机号输入有误！');
			nn_enableButton(_btn, '获取验证码');
			return false;
		} else {
			$.post('./phonecode',
				{
					mobile: mobile
				}, function(data) {
					if(data > 0) {
						luiji_alert('success', '发送成功！');
						var sys_second = 30;
						var timer = setInterval(function(){
							if (sys_second > 0) {
								sys_second -= 1;
								nn_disableButton(_btn, sys_second + '秒后可重新发送！');
							} else {
								clearInterval(timer);
								nn_enableButton(_btn, '获取验证码');
							}
						}, 1000); 
					} else {
						luiji_alert('error', '验证码发送失败，请稍后重试~');
						return false ;
					}
				},
				'text'
			);
		}
	});
	
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var mobile = $.trim($('#mobile').val()),
			phonecode = $.trim($('#phonecode').val()),
			username = $.trim($('#username').val()),
			password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val())
		;
		// var ismobile = is_mobile(mobile);
		if(!is_mobile(mobile)) {
			luiji_alert('error', '手机号输入有误！');
			nn_enableButton(_btn, '注册');
			return false;
		} else if(!is_phonecode(phonecode)) {
			luiji_alert('error', '手机验证码输入有误！');
			nn_enableButton(_btn, '注册');
			return false;
		} else if(username == '') {
			luiji_alert('error', '请输入姓名！');
			nn_enableButton(_btn, '注册');
			return false;
		} else if(password != password2) {
			luiji_alert('error', '两次密码输入不一致！');
			nn_enableButton(_btn, '注册');
			return false;
		} else if(!is_password(password)) {
			luiji_alert('error', '密码格式不正确！');
			nn_enableButton(_btn, '注册');
			return false;
		} else {
			luiji_alert('success', '注册成功！（测试）');
			// $.post('./reg',
				// {
					// mobile: mobile,
					// username: username,
					// password: password,
					// phonecode: phonecode,
					// qrcode: <?php echo isset($qrcode) ? $qrcode : 0; ?>
				// }, function(data) {
					// if(data.result > 0) {
						// luiji_alert('success', '注册成功！');
						// window.setTimeout(function() {
							// window.location = '<?php echo config_item('app_url'); ?>index/index';
						// }, 1000);
					// } else if(data.result == -2) {
						// nn_enableButton(_btn, '注册');
						// luiji_alert('error', '手机验证码不正确！');
					// }  else if(data.result == -1) {
						// nn_enableButton(_btn, '注册');
						// luiji_alert('error', '账号已被注册，请更换其他手机号或邮箱！');
					// } else {
						// nn_enableButton(_btn, '注册');
						// luiji_alert('error', '注册失败，请稍后重试~');
					// }
				// },
				// 'json'
			// );
		}
	});
});
</script>
</head>

<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="用户注册" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>用户注册</h1>
</div>
<div data-role="content" class="gh-center">
	<div class="passport-logo"><img src="<?php echo base_url(); ?>public/images/reg-label.png"/></div>
	<div class="login-form">
		<div class="form-item">
			<label for="mobile">手机号：</label>
			<input type="text" name="mobile" id="mobile" placeholder="注册的手机号" value=""/>
		</div>
		<div class="form-item">
			<label for="password">登录密码：</label>
			<input type="password" name="password" id="password" placeholder="登录密码" value=""/>
		</div>
		<div class="form-item">
			<label for="password2">确认密码：</label>
			<input type="password" name="password2" id="password2" placeholder="确认密码" value=""/>
		</div>
		<div class="form-item">
			<label for="username">姓名：</label>
			<input type="text" name="username" id="username" placeholder="姓名" value=""/>
		</div>
		<div class="form-item">
			
		</div>
		
		<div class="form-item">
			<label for="phonecode">手机验证码：</label>
			<div class="datetime f-cb">
				<div class="datetime-item-1 f-fl" style="width:35%;"><input type="text" name="phonecode" id="phonecode" placeholder="手机验证码" value=""/></div>
				<div class="datetime-item-2 f-fr" style="width:63%;"><button class="btn" id="btn-phonecode">获取验证码</button></div>
			</div>
		</div>
		
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-user ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">注册</button>
		</div>
		<!--<div class="ui-field-contain"><a id="login" href="<?php echo config_item('app_url'); ?>passport/login" data-ajax="false">已有账号，现在登录</a></div>-->
	</div>
	<!-- liweichen change it start on Sep 23 -->
	<div style="width: 100%; color: #6BB2DA; margin-top: 20px;">
		<div style="font-size: 1em;text-align: center;">京ICP备14012503号-1</div>
		<div style="font-size: 1em;text-align: center;">京公网安备11010502025421</div>
	</div>
	<!-- liweichen change it end on Sep 23 -->
</div>

<a href="#popup-box-error" id="popup-link-error" class="popup-link" data-rel="popup" data-position-to="window" data-transition="pop">错误提示</a>
<div id="popup-box-error" class="popup-box" data-role="popup" data-overlay-theme="b"><p></p></div>
<a href="#popup-box-success" id="popup-link-success" class="popup-link" data-rel="popup" data-position-to="window" data-transition="pop">成功提示</a>
<div id="popup-box-success" class="popup-box" data-role="popup" data-overlay-theme="b"><p></p></div>
</body>
</html>