<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>

<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">科室医生</div>
			<div class="panel-body">
				<ul>
					<li><a href="../index">所有医生</a></li>
					<li><a href="../../record/index">数据汇总</a></li>
					<li><a href="../noticedoctor/index">医生通知</a></li>
					<li><a href="../noticeuser/index">患者通知</a></li>
					<li><a class="cur" href="javascript:;">患者明细</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">所有患者信息</div>
			<div class="panel-body">
				<div id="users-list">
					<ul class="f-cb">
						<?php
						for($i = 0; $i < count($users); $i++) {
						?>
						<li>
							<?php
							if($users[$i]['thumb']) {
							?>
							<div class="thumb"><img src="<?php echo nn_fix_uploadurl($users[$i]['thumb']); ?>"/></div>
							<?php
							} else {
							?>
							<div class="thumb"><img src="<?php echo base_url(); ?>public/images/user-nophoto.jpg"/></div>
							<?php
							}
							?>
							<div class="info">
								<div class="doctorname">姓名：<?php echo $users[$i]['username']; ?></div>
								<div class="account">手机号：<?php echo $users[$i]['mobile']; ?></div>
								<div class="account">邮箱：<?php echo $users[$i]['email']; ?></div>
								<div class="time">添加时间：<?php echo date('Y-m-d H:i', $users[$i]['bindtime']); ?></div>
							</div>
							<div class="controls">
								<a class="btn btn-primary" href="../../user/record/<?php echo $users[$i]['id']; ?>">数据详情</a>
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