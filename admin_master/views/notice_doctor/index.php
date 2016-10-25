<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript">

</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">科室医生</div>
			<div class="panel-body">
				<ul>
					<li><a href="../doctor/index">所有医生</a></li>
					<li><a href="../record/index">数据汇总</a></li>
					<li><a class="cur" href="javascript:;">医生通知</a></li>
					<li><a href="../noticeuser/index">患者通知</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">医生通知<a href="./add" class="btn btn-primary f-fr">+新建通知</a></div>
			<div class="panel-body">
				<div id="notice-list">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th width="5%">序号</th>
								<th width="60%">内容</th>
								<th width="25%">创建时间</th>
								<th width="10%">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php
							for($i = 0; $i < count($notices); $i++) {
							?>
								<tr>
									<td><?php echo $i + 1; ?></td>
									<td><?php echo $notices[$i]['content']; ?></td>
									<td><?php echo date('Y-m-d H:i', $notices[$i]['createtime']); ?></td>
									<td><a href="./del?did=<?php echo $loginmaster; ?>&time=<?php echo $notices[$i]['createtime']; ?>" onclick="return confirm('确定删除该通知？');">删除</a></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>