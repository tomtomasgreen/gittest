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
		var
			_btn = $(this),
			doctorid = $.trim($('#doctorid').val()),
			mobile = $.trim($('#mobile').val()),
			password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val()),
			username = $.trim($('#username').val())
		;
		if(!doctorid) {
			alert('请选择该患者的主管医生！');
			return false;
		} else if(!is_mobile(mobile)) {
			alert('请正确输入登录手机！');
			return false;
		} else {
			if(password == '' || password2 == '' || username == '') {
				alert('请正确输入必填信息！');
				return false;
			} else {
				if(password != password2) {
					alert('两次密码输入不一致！');
					return false;
				}
			}
		}
		nn_disableButton(_btn, '正在保存...');
		$.post('./add',
			{
				doctorid : doctorid,
				mobile : mobile,
				password : password,
				password2 : password2,
				username : username
			}, function(data) {
				if(data.result > 0) {
					alert('患者添加成功！');
					window.location = './index';
				} else if(data.result == '-1') {
					nn_enableButton(_btn, '保存');
					alert('该手机号患者已存在~');
				} else {
					nn_enableButton(_btn, '保存');
					alert('保存失败，请稍后再试~');
				}
			},
			'json'
		);
	});
});
</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">数据员后台</div>
			<div class="panel-body">
				<ul>
					<li><a href="./index">所有患者</a></li>
					<li><a class="cur" href="javascript:;">添加患者</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">添加患者</div>
			<div class="panel-body">
				<div id="form-add" class="form-horizontal">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="doctorid">主管医生：</label>
							<div class="controls">
								<select name="doctorid" id="doctorid">
									<?php
									for($i = 0; $i < count($doctors); $i++) {
										echo '<option value="' . $doctors[$i]['id'] . '">' . $doctors[$i]['username'] . ' - ' . $doctors[$i]['mobile'] . '</option>';
									}
									?>
								</select>
								<p class="help" id="help-mobile">必选</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="mobile">登录手机：</label>
							<div class="controls">
								<input type="text" placeholder="请输入登录手机号" id="mobile" name="mobile" class="input-xlarge">
								<p class="help" id="help-mobile">必填</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password">登录密码：</label>
							<div class="controls">
								<input type="password" placeholder="请输入登录密码" id="password" name="password" class="input-xlarge">
								<p class="help" id="help-password">必填</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password2">确认密码：</label>
							<div class="controls">
								<input type="password" placeholder="请再次输入登录密码" id="password2" name="password2" class="input-xlarge">
								<p class="help" id="help-password2">必填</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="username">姓名：</label>
							<div class="controls">
								<input type="text" placeholder="请输入患者姓名" id="username" name="username" class="input-xlarge">
								<p class="help" id="help-username">必填</p>
							</div>
						</div>
						<hr />
						<div class="form-buttons">
							<button class="btn btn-primary" id="submit">保存</button>
						</div>
					</fieldset>
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>