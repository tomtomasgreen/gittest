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
			<div class="panel-heading f-fwb"></div>
			<div class="panel-body">
				<ul>
					<li><a href="../doctor/index">添加医生</a></li>
					<li><a href="../master/index">添加科室管理员</a></li>
					<li><a href="../recorder/index">添加数据员</a></li>
					<li><a class="cur" href="index">答疑证书</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">答题记录</div>
			<div class="panel-body">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th >序号</th>
								<th >问题</th>
								<th >答案</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data as $key => $value){ ?>
								<tr>
									<td><?php echo $key+1 ; ?></td>
									<td><?php echo $value['question'] ?></td>
									<td><?php echo $value['answer'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>