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
		var num = $.trim($('#num').val());
		if(!is_mobile(num)) {
			alert('请输入有效的SN码！');
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
					<li><a href="../doctor/index">添加医生</a></li>
					<li><a href="../master/index">添加科室管理员</a></li>
					<li><a href="../recorder/index">添加数据员</a></li>
					<li><a class="cur" href="javascript:;">答疑证书</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">答疑证书</div>
			<div class="panel-body">
				
				<div id="doctor-add">
					<form class="form-horizontal" action="./show" method="post">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="num">证书编号：</label>
								<div class="controls">
									<input type="text" placeholder="输入证书编号" class="input-xlarge" name="num" id="num" maxlength="20">
									<p class="help-block" id="help-num"></p>
								</div>
							</div>
							<hr />
							<div class="form-buttons">
								<button class="btn btn-primary" id="submit">查看</button>
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