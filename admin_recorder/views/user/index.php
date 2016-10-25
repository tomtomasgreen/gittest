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
			<div class="panel-heading f-fwb">数据员后台</div>
			<div class="panel-body">
				<ul>
					<li><a class="cur" href="javascript:;">所有患者</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<?php
			if($whitelist) {
			?>
			<div class="panel-heading f-fwb">所有患者<a href="./add"  class="btn btn-primary f-fr">添加患者</a></div>
			<?php
			} else {
			?>
			<div class="panel-heading f-fwb">所有患者<a href="javascript:;"  disabled="disabled" class="btn btn-danger f-fr">添加患者暂时关闭</a></div>
			<?php
			}
			?>
			<div class="panel-body">
				
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th width="5%">序号</th>
							<th width="4%">头像</th>
							<th width="13%">用户名</th>
							<th width="5%">性别</th>
							<th width="13%">出生年月</th>
							<th width="25%">手机号/邮箱</th>
							<th width="15%">地区</th>
							<th width="20%">操作</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for($i = 0; $i < count($users); $i++) {
						?>
						<tr>
							<td><?php echo $i + 1; ?></td>
							<td><img src="<?php echo $users[$i]['thumb'] ? nn_fix_uploadurl($users[$i]['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>" width=""/></td>
							<td><?php echo $users[$i]['username']; ?></td>
							<td><?php echo $users[$i]['sex']; ?></td>
							<td><?php echo $users[$i]['birthyear']; ?> / <?php echo $users[$i]['birthmonth']; ?></td>
							<td><?php echo $users[$i]['mobile']; ?><br/><?php echo $users[$i]['email']; ?></td>
							<td><?php echo $AREAS[$users[$i]['province']]; ?> <?php echo $AREAS[$users[$i]['city']]; ?></td>
							<td><a href="./history/<?php echo $users[$i]['id']; ?>">历史</a> | <a href="../record/create/<?php echo $users[$i]['id']; ?>">添加</a></td>
						</tr>
						<?php
						}
						?>
					<tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>