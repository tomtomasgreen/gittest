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
function changing(){
    document.getElementById('checkpic').src="<?php echo base_url('index.php/passport/getpiccode'); ?>?"+Math.random();
}
$(function() {
	var yzm ;
	// var i = 20;
	$('#yanzhengma').click(function() {

		var _btn = $(this);
		nn_disableButton(_btn, '请稍等...');
		var mobile = $.trim($('#mobile').val());
		var pic = $.trim($('#piccode').val());
		// var ismobile = is_mobile(mobile);
		if(!is_mobile(mobile)) {
			luiji_alert('error', '手机号输入有误！');
			nn_enableButton(_btn, '获取验证码');
			return false;
		} else {
			yzm = Math.floor(Math.random()*10) +""+ Math.floor(Math.random()*10) +""+ Math.floor(Math.random()*10)+""+ Math.floor(Math.random()*10);
			$.post('./phonewithoutcode',
				{
					mobile: mobile,
					yzm: yzm,
					pic:pic,
					"<?php echo $name;?>": "<?php echo $hash;?>"
				}, function(data) {
					if(data == 1) {
						luiji_alert('success', '发送成功！');
						var sys_second = 200;
						var timer = setInterval(function(){ 
							if (sys_second > 0) { 
							sys_second -= 1; 
							nn_disableButton($('#yanzhengma'), sys_second+'S后可重新发送！');
							} else { 
							clearInterval(timer); 
							nn_enableButton(_btn, '获取验证码');
							} 
						}, 1000); 

					}else if(data == 5) {
						luiji_alert('error', '图片验证码不正确！');
						nn_enableButton(_btn, '获取验证码');
					}else if(data < 0) {
						luiji_alert('error', '验证码不能频繁发送'+data+'秒后重试！');
						nn_enableButton(_btn, '获取验证码');
					}else {
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
		var mobile = $.trim($('#mobile').val());
		nn_disableButton(_btn, '请稍等...');
		var yzmaa = $.trim($('#yzmaa').val());
		// var ismobile = is_mobile(mobile);
		if(yzmaa == "" ) {
			luiji_alert('error', '请输入验证码！');
			nn_enableButton(_btn, '验证');
			return false;
		} else {
			if(yzmaa == yzm){
				//luiji_alert('success', '验证码正确！');
				window.setTimeout(function() {
					window.location = './resetdo?mobile='+mobile;
				}, 1000);
			}else{
				luiji_alert('error', '您输入的验证码不正确！');
				nn_enableButton(_btn, '验证');
				return false;
			}
		}
	});

});
</script>
</head>

<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="医生注册" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>医生密码重置</h1>
</div>
<div data-role="content" class="gh-center">
	<div class="passport-logo"><img src="<?php echo base_url(); ?>public/images/reg-label.png"/></div>
	<div class="login-form">
		<div class="form-item">
			<label for="mobile">手机号：</label>
			<input type="text" name="mobile" id="mobile" placeholder="注册的手机号" value=""/>
		</div>
		<div class="ui-field-contain">
			<label for="piccode">图片验证码：</label>
			<div class="datetime f-cb">
			<div class="f-fl" style="width:80%;"><input type="text" name="piccode" id="piccode" placeholder="图片验证码" value=""/></div>
			<div class="f-fl" style="width:20%;height:100%;margin-top: 0.5em;"><img id="checkpic" style= "width: 100%;height: 100%;" onclick="changing();" src="<?php echo base_url('index.php/passport/getpiccode'); ?>" ></img></div>
			</div>
		</div>
		<div class="ui-field-contain">
			<button class="" id="yanzhengma">获取验证码</button>
		</div>
		<div class="form-item">
			<label for="yzmaa">验证码：</label>
			<input type="text" name="yzmaa" id="yzmaa" placeholder="请输入验证码" value=""/>
		</div>
		
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-user ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">验证</button>
		</div>
		<div class="ui-field-contain"><a id="login" href="<?php echo config_item('app_url'); ?>passport/login" data-ajax="false">已有账号，现在登录</a></div>
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