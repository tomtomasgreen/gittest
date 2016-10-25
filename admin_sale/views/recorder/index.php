<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript">
$(function() {
	$('#next').click(function() {
		var master_mobile = $('#master_mobile').val();
		if(!is_mobile(master_mobile)) {
			alert('请输入有效的手机号！');
			return false;
		} else {
			$.post('./get_master',
				{
					master_mobile : master_mobile
				}, function(data) {
					if(data == '-1') {
						alert('不存在该手机号医生~');
					} else {
						$('#masterid').val(data.id);
						$('.department-info .hospital').text(data.hospital);
						$('.department-info .department').text(data.department);
						$('.step-1').hide();
						$('.step-2').show();
					}
				},
				'json'
			);
		}
	});
	$('#prev').click(function() {
		$('.step-2').hide();
		$('.step-1').show();
	});
	
	$('#submit').click(function() {
		var
			_btn = $(this),
			masterid = $.trim($('#masterid').val()),
			mobile = $.trim($('#mobile').val()),
			password = $.trim($('#password').val()),
			password2 = $.trim($('#password2').val()),
			username = $.trim($('#username').val())
		;
		if(!masterid) {
			alert('请先确定数据员所属的医院科室！');
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
		$.post('./add_recorder',
			{
				masterid : masterid,
				mobile : mobile,
				password : password,
				password2 : password2,
				username : username
			}, function(data) {
				if(data.result > 0) {
					alert('数据员添加成功！');
					window.location.reload();
				} else if(data.result == '-1') {
					nn_enableButton(_btn, '保存');
					alert('该手机号数据员已存在~');
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
<style type="text/css">
.step-2{display:none;}
.department-info{padding:10px;}
</style>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb"></div>
			<div class="panel-body">
				<ul>
					<li><a href="../doctor/index">添加医生</a></li>
					<li><a href="../master/index">添加科室管理员</a></li>
					<li><a class="cur" href="javascript:;">添加数据员</a></li>
					<li><a href="../collect/index">答疑证书</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">添加数据员</div>
			<div class="panel-body">
				<div id="form-add" class="form-horizontal">
					<input type="hidden" id="masterid" name="masterid" value="0"/>
					<fieldset class="step-1">
						<div class="control-group">
							<label class="control-label" for="master_mobile">科室主任手机：</label>
							<div class="controls">
								<input type="text" placeholder="请输入科室主任手机号" id="master_mobile" name="master_mobile" class="input-xlarge">
								<p class="help" id="help-master_mobile">必填</p>
							</div>
						</div>
						<hr />
						<div class="form-buttons">
							<button class="btn" id="next">下一步</button>
						</div>
					</fieldset>
					
					<fieldset class="step-2">
						<div class="department-info alert alert-success">
							<h4><span class="hospital"></span> - <span class="department"></span></h4>
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
								<input type="text" placeholder="请输入主任姓名" id="username" name="username" class="input-xlarge">
								<p class="help" id="help-username">必填</p>
							</div>
						</div>
						<hr />
						<div class="form-buttons">
							<button class="btn" id="prev">上一步</button>
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