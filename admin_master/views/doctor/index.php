<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"  >
function del(id){
	var del = confirm("您确定要删除吗？");
	if(del){
		location.href = "del?id="+id ;
	}
}
</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">科室医生</div>
			<div class="panel-body">
				<ul>
					<li><a class="cur" href="javascript:;">所有医生</a></li>
					<li><a href="../record/index">数据汇总</a></li>
					<li><a href="../noticedoctor/index">医生通知</a></li>
					<li><a href="../noticeuser/index">患者通知</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">本科室内所有医生<a href="./add" class="btn btn-primary f-fr">+添加医生</a></div>
			<div class="panel-body">
				<div id="doctor-list">
					<ul class="f-cb">
						<?php
						for($i = 0; $i < count($doctors); $i++) {
						?>
						<li>
							<div class="thumb"><img src="<?php echo $doctors[$i]['thumb'] ? nn_fix_uploadurl($doctors[$i]['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
							<div class="info">
								<div class="doctorname">姓名：<?php echo $doctors[$i]['username']; ?></div>
								<div class="account">手机号：<?php echo $doctors[$i]['mobile']; ?></div>
								<div class="time">添加时间：<?php echo date('Y-m-d H:i', $doctors[$i]['bindtime']); ?></div>
							</div>
							<div class="controls">
								<!--<a class="btn btn-primary" href="./edit/<?php echo $doctors[$i]['id']; ?>">编辑信息</a>-->
								<a class="btn btn-primary" href="./users/<?php echo $doctors[$i]['id']; ?>">患者明细</a>
								<a class="btn btn-primary" href="#" onClick="del(<?php echo $doctors[$i]['id']; ?>)">删除医生</a>
							</div>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>