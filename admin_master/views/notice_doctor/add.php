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
		var content = $.trim($('#content').val());
		if(!content) {
			alert('请输入通知内容！');
			return false;
		}
	});
});
</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">科室医生</div>
			<div class="panel-body">
				<ul>
					<li><a href="../doctor/index">所有医生</a></li>
					<li><a href="../record/index">数据汇总</a></li>
					<li><a href="../noticedoctor/index">医生通知</a></li>
					<li><a href="../noticeuser/index">患者通知</a></li>
					<li><a class="cur" href="javascript:;">新建医生通知</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">新建医生通知</div>
			<div class="panel-body">
				<div id="notice-list">
					
					<form class="form-horizontal" action="./doadd" method="post">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="content">内容：</label>
								<div class="controls">
									<textarea name="content" id="content" rows="4" placeholder="输入通知内容"></textarea>
									<p class="help-block" id="help-content"></p>
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