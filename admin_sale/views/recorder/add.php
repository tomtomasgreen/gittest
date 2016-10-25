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
				<div id="form-add">
					
					<div class="alert alert-success">添加成功！</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>