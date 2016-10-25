<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	
	$('.item-sugar').show();
	$('.records-nav li').click(function (){
		var
			tab = $(this),
			item_label = tab.data('item'),
			item = $('.item-' + item_label)
		;
		$('.records-nav li').removeClass('active');
		tab.addClass('active');
		$('.records .item').hide();
		item.show();
	});
	
});
</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">数据员后台</div>
			<div class="panel-body">
				<ul>
					<li><a href="../../user/index">所有患者</a></li>
					<li><a class="cur" href="javascript:;">历史记录</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">历史记录<a href="../../record/create/<?php echo $user['id']; ?>" class="btn btn-primary f-fr">添加记录</a></div>
			<div class="panel-body">
				<div class="user-detail">
					<div class="f-cb">
						<div class="thumb f-fl"><img src="<?php echo $user['thumb'] ? nn_fix_uploadurl($user['thumb']) : (base_url() . 'public/images/user-nophoto.jpg'); ?>" width="200"/></div>
						<div class="detail f-fl">
							<div class="ud-item">用户名：<?php echo $user['username']; ?></div>
							<div class="ud-item">性别：<?php echo $user['sex']; ?></div>
							<div class="ud-item">出生年月：<?php echo $user['birthyear']; ?> / <?php echo $user ['birthmonth']; ?></div>
							<div class="ud-item">手机号/邮箱：<?php echo $user['mobile']; ?> / <?php echo $user['email']; ?></div>
							<div class="ud-item">地区：<?php echo $AREAS[$user['province']]; ?> <?php echo $AREAS[$user['city']]; ?></div>
						</div>
					</div>
				</div>
				<div id="user-record">
					<ul class="nav nav-pills records-nav">
						<li role="presentation" data-item="sugar" class="active"><a href="javascript:;">血糖</a></li>
						<li role="presentation" data-item="pressure"><a href="javascript:;">血压</a></li>
						<li role="presentation" data-item="food"><a href="javascript:;">饮食</a></li>
						<li role="presentation" data-item="drug"><a href="javascript:;">用药</a></li>
						<li role="presentation" data-item="bmi"><a href="javascript:;">BMI</a></li>
						<li role="presentation" data-item="visit"><a href="javascript:;">就诊</a></li>
						<li role="presentation" data-item="stature"><a href="javascript:;">腰臀比</a></li>
						<li role="presentation" data-item="protein"><a href="javascript:;">糖化血红蛋白</a></li>
					</ul>
					<div class="records">
						<div class="item item-sugar">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="24%">类型</th>
										<th width="24%">血糖值（mmol/L）</th>
										<th width="22%">测量时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($sugar_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $sugar_records[$i]['type']; ?></td>
										<td><?php echo $sugar_records[$i]['sugar']; ?></td>
										<td><?php echo $sugar_records[$i]['measuretimes']; ?></td>
										<td><?php echo $sugar_records[$i]['createtimes']; ?></td>
									</tr>
									<?php
									}
									?>
								<tbody>
							</table>
						</div>
						<div class="item item-pressure">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="24%">高压值（mmHg）</th>
										<th width="24%">低压值（mmHg）</th>
										<th width="22%">测量时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($pressure_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $pressure_records[$i]['high']; ?></td>
										<td><?php echo $pressure_records[$i]['low']; ?></td>
										<td><?php echo $pressure_records[$i]['measuretimes']; ?></td>
										<td><?php echo $pressure_records[$i]['createtimes']; ?></td>
									</tr>
									<?php
									}
									?>
								<tbody>
							</table>
						</div>
						<div class="item item-food">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="12%">类型</th>
										<th width="16%">照片</th>
										<th width="20%">备注</th>
										<th width="22%">用餐时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($food_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $food_records[$i]['type']; ?></td>
										<td><img src="<?php echo $food_records[$i]['photo'] ? $food_records[$i]['photo'] : (base_url() . 'public/images/nophoto.jpg'); ?>"/></td>
										<td><?php echo $food_records[$i]['content']; ?></td>
										<td><?php echo $food_records[$i]['measuretimes']; ?></td>
										<td><?php echo $food_records[$i]['createtimes']; ?></td>
									</tr>
									<?php
									}
									?>
								<tbody>
							</table>
						</div>
						<div class="item item-drug">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="12%">类型</th>
										<th width="16%">照片</th>
										<th width="20%">备注</th>
										<th width="22%">用餐时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($drug_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $drug_records[$i]['type']; ?></td>
										<td><img src="<?php echo $drug_records[$i]['photo'] ? $drug_records[$i]['photo'] : (base_url() . 'public/images/nophoto.jpg'); ?>"/></td>
										<td><?php echo $drug_records[$i]['content']; ?></td>
										<td><?php echo $drug_records[$i]['measuretimes']; ?></td>
										<td><?php echo $drug_records[$i]['createtimes']; ?></td>
									</tr>
									<?php
									}
									?>
								<tbody>
							</table>
						</div>
						<div class="item item-bmi">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="16%">身高（厘米）</th>
										<th width="16%">体重（公斤）</th>
										<th width="16%">BMI</th>
										<th width="22%">测量时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($bmi_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $bmi_records[$i]['height']; ?></td>
										<td><?php echo $bmi_records[$i]['weight']; ?></td>
										<td><?php echo $bmi_records[$i]['bmi']; ?></td>
										<td><?php echo $bmi_records[$i]['measuretimes']; ?></td>
										<td><?php echo $bmi_records[$i]['createtimes']; ?></td>
									</tr>
									<?php
									}
									?>
								<tbody>
							</table>
						</div>
						<div class="item item-visit">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="12%">类型</th>
										<th width="16%">照片</th>
										<th width="20%">备注</th>
										<th width="22%">用餐时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($visit_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $visit_records[$i]['type']; ?></td>
										<td><img src="<?php echo $visit_records[$i]['photo'] ? $drug_records[$i]['photo'] : (base_url() . 'public/images/nophoto.jpg'); ?>"/></td>
										<td><?php echo $visit_records[$i]['content']; ?></td>
										<td><?php echo $visit_records[$i]['measuretimes']; ?></td>
										<td><?php echo $visit_records[$i]['createtimes']; ?></td>
									</tr>
									<?php
									}
									?>
								<tbody>
							</table>
						</div>
						<div class="item item-stature">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="16%">腰围（厘米）</th>
										<th width="16%">臀围（厘米）</th>
										<th width="16%">腰臀比（%）</th>
										<th width="22%">测量时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($whr_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $whr_records[$i]['waist']; ?></td>
										<td><?php echo $whr_records[$i]['hip']; ?></td>
										<td><?php echo $whr_records[$i]['whr']; ?></td>
										<td><?php echo $whr_records[$i]['measuretimes']; ?></td>
										<td><?php echo $whr_records[$i]['createtimes']; ?></td>
									</tr>
									<?php
									}
									?>
								<tbody>
							</table>
						</div>
						<div class="item item-protein">
							<table class="table table-striped table-hover table-bordered">
								<thead>
									<tr>
										<th width="8%">序号</th>
										<th width="48%">糖化血红蛋白（%）</th>
										<th width="22%">测量时间</th>
										<th width="22%">记录时间</th>
									</tr>
								</thead>
								<tbody>
									<?php
									for($i = 0; $i < count($protein_records); $i++) {
									?>
									<tr>
										<td><?php echo $i + 1; ?></td>
										<td><?php echo $protein_records[$i]['protein']; ?></td>
										<td><?php echo $protein_records[$i]['measuretimes']; ?></td>
										<td><?php echo $protein_records[$i]['createtimes']; ?></td>
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
		</div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>