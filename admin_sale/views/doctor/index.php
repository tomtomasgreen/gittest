<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script src="/guanhuai/public/js/areas.js"></script>
<script type="text/javascript">
$(function() {
	var
		cities_default = '<option value="0">市</option>',
		provinces = getAllProvinces(),
		provinces_options = ''
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
	
	$('#submit').click(function() {
		var
			mobile = $.trim($('#mobile').val()),
			password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val()),
			username = $.trim($('#username').val()),
			city = $.trim($('#city').val()),
			hospital = $.trim($('#hospital').val()),
			department = $.trim($('#department').val()),
			job = $.trim($('#job').val())
		;
		if(!is_mobile(mobile)) {
			alert('请正确输入登录手机！');
			return false;
		} else {
			if(password == '' || password2 == '' || username == '' || city == '0' || hospital == '' || department == '' || job == '') {
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
<style type="text/css">
.select-medium{width:140px;}
</style>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb"></div>
			<div class="panel-body">
				<ul>
					<li><a class="cur" href="javascript:;">添加医生</a></li>
					<li><a href="../master/index">添加科室管理员</a></li>
					<li><a href="../recorder/index">添加数据员</a></li>
					<li><a href="../collect/index">答疑证书</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">添加医生</div>
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
									<input type="text" placeholder="请输入医生姓名" id="username" name="username" class="input-xlarge">
									<p class="help" id="help-username">必填</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="city">所在城市：</label>
								<div class="controls">
									<select name="province" id="province" class="select-medium">
										<option value="0">省</option>
									</select>
									<select name="city" id="city" class="select-medium">
										<option value="0">市</option>
									</select>
									<p class="help" id="help-city">必选</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="hospital">医院名称：</label>
								<div class="controls">
									<input type="text" placeholder="请输入医院名称" id="hospital" name="hospital" class="input-xlarge">
									<p class="help" id="help-hospital">必填</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="department">科室：</label>
								<div class="controls">
									<input type="text" placeholder="请输入主任科室" id="department" name="department" class="input-xlarge">
									<p class="help" id="help-department">必填</p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="job">职称：</label>
								<div class="controls">
									<input type="text" placeholder="请输入主任职称" id="job" name="job" class="input-xlarge">
									<p class="help" id="help-job">必填</p>
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