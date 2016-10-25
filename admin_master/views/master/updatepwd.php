<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	
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
					<div class="alert alert-success">密码修改成功！</div>
				</div>
				
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>