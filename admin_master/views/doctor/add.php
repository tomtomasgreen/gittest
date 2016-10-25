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
		var mobile = $.trim($('#mobile').val());
		if(!is_mobile(mobile)) {
			alert('请输入有效的手机号！');
			return false;
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
					<li><a href="../doctor/index">所有医生</a></li>
					<li><a href="../record/index">数据汇总</a></li>
					<li><a href="../noticedoctor/index">医生通知</a></li>
					<li><a href="../noticeuser/index">患者通知</a></li>
					<li><a class="cur" href="javascript:;">添加医生</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">添加医生</div>
			<div class="panel-body">
				
				<div id="doctor-add">
					<form class="form-horizontal" action="./bind" method="post">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="mobile">手机号：</label>
								<div class="controls">
									<input type="text" placeholder="输入医生手机号" class="input-xlarge" name="mobile" id="mobile" maxlength="20">
									<p class="help-block" id="help-mobile"></p>
								</div>
							</div>
							<hr />
							<div class="form-buttons">
								<button class="btn btn-primary" id="submit">添加</button>
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