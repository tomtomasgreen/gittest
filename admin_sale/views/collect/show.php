<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/dy/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/dy/jquery.jqprint-0.3.js"></script>
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

function  a(){

	$("#ddd").jqprint();
}

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
					<form class="form-horizontal" action="./bind" method="post">
						<fieldset>
							<div>
								<?php if (@$data[0]['sn'] != 0): ?>
									<div>
										<a href="down_img?url=<?php echo $data[0]['sn'] ?>" >
											<input type="button" style="width:150px;height:50px;" value="点击下载证书" />
										</a>								
							
										<input type="button" onclick=" a()"  style="width:150px;height:50px;" value="点击打印证书" />
										
										<a href="question_details?sn=<?php echo $data[0]['sn'] ?>" >
											<input type="button" style="width:150px;height:50px;" value="点击查看答题记录" />
										</a>
					
									</div><br>
									
									<div id="ddd" >
										<img width="30%" src="<?php echo base_url(); ?>/public/certificate/<?php echo $data[0]['sn'] ?>.jpg" alt="" />
									</div>
								<?php else: ?>
									<h2>不存在此编号证书</h2>
								<?php endif ?>
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