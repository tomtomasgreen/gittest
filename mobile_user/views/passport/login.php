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
<link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>public/js/jquery.mobile-1.4.5/jquery.mobile.flatui.css"/>
<link rel="stylesheet" href="<?php echo site_url(); ?>public/css/m.css">
<script src="<?php echo site_url(); ?>public/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo site_url(); ?>public/js/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script src="<?php echo site_url(); ?>public/js/m.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
$(function() {
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在登录...');
		var mobile = $.trim($('#mobile').val()),
			password = $.trim($('#password').val())
		;
		if(!is_mobile(mobile)) {
			luiji_alert('error', '手机号输入有误！');
			nn_enableButton(_btn, '登录');
			return false;
		} else if(password == '') {
			luiji_alert('error', '请输入登录密码！');
			nn_enableButton(_btn, '注册');
			return false;
		} else {
			$.post('./login',
				{
					mobile: mobile,
					password: password
				}, function(data) {
					if(data.result > 0) {
						window.location = '<?php echo config_item('app_url'); ?>index/index';
					} else {
						nn_enableButton(_btn, '登录');
						luiji_alert('error', '登录失败，账户或密码有误！');
					}
				},
				'json'
			);
		}
	});
});
</script>
</head>

<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="用户登录" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>用户登录</h1>
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
		
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-user ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">登录</button>
			<?php
			if(!$isWeixinBrowser) {
			?>
			<a style="float:right;line-height:4em;" href="<?php echo base_url(); ?>doctor.php/passport/login" id="role-switch" data-ajax="false">点此进入医生入口</a>
			<?php
			}
			?>
		</div>
		<div class="ui-field-contain">
		<?php
		//if(!$isWeixinBrowser) {
		?>
		<a id="reg" href="./reg" data-ajax="false">还未注册？</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
		//}
		?>
		
		<a id="reg" href="./reset" data-ajax="false">重置密码</a></div>
		
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
<div></div>
</body>
</html>