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
			mobile = $.trim($('#mobile').val()),
			password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val()),
			username = $.trim($('#username').val()),
			hospital = $.trim($('#hospital').val()),
			department = $.trim($('#department').val()),
			job = $.trim($('#job').val()),
			address = $.trim($('#address').val())
		;
		if(!is_mobile(mobile)) {
			alert('请正确输入登录手机！');
			return false;
		} else {
			if(password == '' || password2 == '' || username == '' || hospital == '' || job == '') {
				alert('请正确输入必填信息！');
				return false;
			} else {
				if(password != password2) {
					alert('两次密码输入不一致！');
					return false;
				}
			}
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
					<li><a href="../doctor/index">添加医生</a></li>
					<li><a class="cur" href="javascript:;">添加科室管理员</a></li>
					<li><a href="../recorder/index">添加数据员</a></li>
					<li><a href="../collect/index">答疑证书</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">添加科室管理员</div>
			<div class="panel-body">
				<div id="form-add">
					
					<form class="form-horizontal" action="./add" method="post">
						<fieldset>
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
									<input type="text" placeholder="请输入主任姓名" id="username" name="username" class="input-xlarge">
									<p class="help" id="help-username">必填</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="hospital">医院名称：</label>
								<div class="controls">
									<input type="text" placeholder="请输入医院名称" id="hospital" name="hospital" class="input-xlarge">
									<p class="help" id="help-hospital"></p>
									<p class="help" id="help-password">必填</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="department">科室：</label>
								<div class="controls">
									<input type="text" placeholder="请输入主任科室" id="department" name="department" class="input-xlarge">
									<p class="help" id="help-department"></p>
									<p class="help" id="help-password">必填</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="job">职称：</label>
								<div class="controls">
									<input type="text" placeholder="请输入主任职称" id="job" name="job" class="input-xlarge">
									<p class="help" id="help-job">必填</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="address">医院地址：</label>
								<div class="controls">
									<input type="text" placeholder="请输入医院地址" id="address" name="address" class="input-xlarge">
									<p class="help" id="help-address"></p>
								</div>
							</div>
							<hr />
							<div class="form-buttons">
								<button class="btn btn-primary" id="submit">保存</button>
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