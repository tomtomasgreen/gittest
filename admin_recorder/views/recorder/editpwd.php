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
		// nn_disableButton(_btn, '正在提交...');
		var oldpassword = $.trim($('#oldpassword').val()),
			password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val())
		;
		if(oldpassword == '') {
			alert('请输入当前登录密码！');
			// nn_enableButton(_btn, '更改');
			return false;
		} else if(password != password2) {
			alert('两次密码输入不一致！');
			// nn_enableButton(_btn, '更改');
			return false;
		} else if(!is_password(password)) {
			alert('新密码输入有误！');
			// nn_enableButton(_btn, '更改');
			return false;
		} else {
			// $('form').submit();
		}
	});
});
</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb"></div>
			<div class="panel-body">
				<ul>
					<li><a href="../user/index">所有患者</a></li>
					<li><a class="cur" href="javascript:;">修改密码</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">修改登录密码</div>
			<div class="panel-body">
				
				<div id="eidtpwd">
					<form class="form-horizontal" action="./updatepwd" method="post">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="oldpassword">原密码：</label>
								<div class="controls">
									<input type="password" placeholder="输入原登录密码" class="input-xlarge" name="oldpassword" id="oldpassword" maxlength="20">
									<p class="help-block" id="help-oldpassword"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">新密码：</label>
								<div class="controls">
									<input type="password" placeholder="输入新登录密码" class="input-xlarge" name="password" id="password" maxlength="20">
									<p class="help-block" id="help-password"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password2">确认密码：</label>
								<div class="controls">
									<input type="password" placeholder="再次输入新密码" class="input-xlarge" name="password2" id="password2" maxlength="20">
									<p class="help-block" id="help-password2"></p>
								</div>
							</div>
							<hr />
							<div class="form-buttons">
								<button class="btn btn-primary" id="submit">更改</button>
							</div>
						</fieldset>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>