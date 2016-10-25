<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('inc/top.html');
?>
<script type="text/javascript"> 
$(function() {
	$('#submit').click(function() {
		var _btn = $(this);
		// nn_disableButton(_btn, '正在提交...');
		var password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val())
		;
		if(password != password2) {
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
					<li><a href="./index">所有医生</a></li>
					<li><a class="cur" href="javascript:;">修改密码</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">修改医生密码</div>
			<div class="panel-body">
				
				<div id="eidtpwd">
					<div class="userinfo" style="border:1px solid #ccc;background-color:#f6f6f6;padding:15px;margin-bottom:30px;">
						<h4><?php echo $doctor['username']; ?></h4>
						<h5><?php echo $doctor['mobile']; ?></h5>
					</div>
					<form class="form-horizontal" action="./updatepwd" method="post">
						<input type="hidden" name="did" value="<?php echo $doctor['id']; ?>"/>
						<fieldset>
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
$this->load->view('inc/buttom.html');
?>