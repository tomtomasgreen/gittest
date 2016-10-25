<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<link href="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/css/redmond/jquery-ui.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/highcharts-4.1.3/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/i18n/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript"> 
$(function() {
	$( "#start-date" ).datepicker();
	$( "#start-date2" ).datepicker();
	$( "#end-date" ).datepicker();
	$( "#end-date2" ).datepicker();
	
	$('.item-sugar').show();
	init_sugar();
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
		if(item_label == 'sugar') {
			init_sugar();
		} else if(item_label == 'pressure') {
			init_pressure();
		} else if(item_label == 'protein') {
			init_protein();
		}else if(item_label == 'bmi') {
			init_bmi();
		}else if(item_label == 'stature') {
			init_whr();
		}
	});
	
	function init_sugar() {
		$('#chart-sugar-1').highcharts({
			chart: {type: 'line'},
			title: {text: '空腹血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_1); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_1[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_1[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '空腹血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_1); $i++) {
					if($i == 0) {
						echo $sugar_records_1[$i]['sugar'];
					} else {
						echo "," . $sugar_records_1[$i]['sugar'];
					}
				}
				?>
			]}]
		});
		$('#chart-sugar-2').highcharts({
			chart: {type: 'line'},
			title: {text: '早餐后血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_2); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_2[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_2[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '早餐后血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_2); $i++) {
					if($i == 0) {
						echo $sugar_records_2[$i]['sugar'];
					} else {
						echo "," . $sugar_records_2[$i]['sugar'];
					}
				}
				?>
			]}]
		});
		$('#chart-sugar-3').highcharts({
			chart: {type: 'line'},
			title: {text: '午餐前血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_3); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_3[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_3[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '午餐前血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_3); $i++) {
					if($i == 0) {
						echo $sugar_records_3[$i]['sugar'];
					} else {
						echo "," . $sugar_records_3[$i]['sugar'];
					}
				}
				?>
			]}]
		});
		$('#chart-sugar-4').highcharts({
			chart: {type: 'line'},
			title: {text: '午餐后血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_4); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_4[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_4[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '午餐后血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_4); $i++) {
					if($i == 0) {
						echo $sugar_records_4[$i]['sugar'];
					} else {
						echo "," . $sugar_records_4[$i]['sugar'];
					}
				}
				?>
			]}]
		});
		$('#chart-sugar-5').highcharts({
			chart: {type: 'line'},
			title: {text: '晚餐前血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_5); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_5[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_5[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '晚餐前血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_5); $i++) {
					if($i == 0) {
						echo $sugar_records_5[$i]['sugar'];
					} else {
						echo "," . $sugar_records_5[$i]['sugar'];
					}
				}
				?>
			]}]
		});
		$('#chart-sugar-6').highcharts({
			chart: {type: 'line'},
			title: {text: '晚餐后血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_6); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_6[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_6[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '晚餐后血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_6); $i++) {
					if($i == 0) {
						echo $sugar_records_6[$i]['sugar'];
					} else {
						echo "," . $sugar_records_6[$i]['sugar'];
					}
				}
				?>
			]}]
		});
		$('#chart-sugar-7').highcharts({
			chart: {type: 'line'},
			title: {text: '睡前血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_7); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_7[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_7[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '睡前血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_7); $i++) {
					if($i == 0) {
						echo $sugar_records_7[$i]['sugar'];
					} else {
						echo "," . $sugar_records_7[$i]['sugar'];
					}
				}
				?>
			]}]
		});
		$('#chart-sugar-8').highcharts({
			chart: {type: 'line'},
			title: {text: '凌晨血糖统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($sugar_records_8); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $sugar_records_8[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $sugar_records_8[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血糖值mmol/L'}},
			series: [{name: '凌晨血糖',data: [
				<?php
				for($i = 0; $i < count($sugar_records_8); $i++) {
					if($i == 0) {
						echo $sugar_records_8[$i]['sugar'];
					} else {
						echo "," . $sugar_records_8[$i]['sugar'];
					}
				}
				?>
			]}]
		});
	}
	// 血压
	function init_pressure() {
		$('#chart-pressure').highcharts({
			chart: {type: 'line'},
			title: {text: '血压统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($pressure_records); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $pressure_records[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $pressure_records[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '血压值mmHg'}},
			series: [
				{name: '高压值', data: [
					<?php
					for($i = 0; $i < count($pressure_records); $i++) {
						if($i == 0) {
							echo $pressure_records[$i]['high'];
						} else {
							echo "," . $pressure_records[$i]['high'];
						}
					}
					?>
				]},
				{name: '低压值', data: [
					<?php
					for($i = 0; $i < count($pressure_records); $i++) {
						if($i == 0) {
							echo $pressure_records[$i]['low'];
						} else {
							echo "," . $pressure_records[$i]['low'];
						}
					}
					?>
				]}
			]
		});
	}
	// 糖化血红蛋白
	function init_protein() {
		$('#chart-protein').highcharts({
			chart: {type: 'line'},
			title: {text: '糖化血红蛋白统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($protein_records); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $protein_records[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $protein_records[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '糖化血红蛋白值%'}},
			series: [
				{name: '糖化血红蛋白值', data: [
					<?php
					for($i = 0; $i < count($protein_records); $i++) {
						if($i == 0) {
							echo $protein_records[$i]['protein'];
						} else {
							echo "," . $protein_records[$i]['protein'];
						}
					}
					?>
				]}
			]
		});
	}
	//bmi
	function init_bmi() {
		$('#chart-bmi').highcharts({
			chart: {type: 'line'},
			title: {text: 'BMI统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($bmi_records); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $bmi_records[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $bmi_records[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: 'bmi值'}},
			series: [
				{name: 'bmi值', data: [
					<?php
					for($i = 0; $i < count($bmi_records); $i++) {
						if($i == 0) {
							echo $bmi_records[$i]['bmi'];
						} else {
							echo "," . $bmi_records[$i]['bmi'];
						}
					}
					?>
				]}
			]
		});
	}
	//whr
	function init_whr() {
		$('#chart-whr').highcharts({
			chart: {type: 'line'},
			title: {text: '腰臀比统计图'},
			subtitle: {text: '<?php echo $status ; ?>'+'测量统计'},
			xAxis: {categories: [
				<?php
				for($i = 0; $i < count($whr_records); $i++) {
					if($i == 0) {
						echo "'" . date('m-d', $whr_records[$i]['measuretime']) . "'";
					} else {
						echo ",'" . date('m-d', $whr_records[$i]['measuretime']) . "'";
					}
				}
				?>
			]},
			yAxis: {title: {text: '腰臀比值'}},
			series: [
				{name: '腰臀比值', data: [
					<?php
					for($i = 0; $i < count($whr_records); $i++) {
						if($i == 0) {
							echo $whr_records[$i]['whr'];
						} else {
							echo "," . $whr_records[$i]['whr'];
						}
					}
					?>
				]}
			]
		});
	}
});
</script>
<div class="content f-cb">
	<div class="leftside f-fl">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">患者数据详情</div>
			<div class="panel-body">
				<ul>
					<li><a href="<?php A_M_U('doctor/index') ?>">所有医生</a></li>
					<li><a href="<?php A_M_U('record/index') ?>">数据汇总</a></li>
					<li><a href="../noticedoctor/index">医生通知</a></li>
					<li><a href="../noticeuser/index">患者通知</a></li>
					<li><a class="cur" href="javascript:;">数据详情</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="main f-fr">
		<div class="panel panel-default">
			<div class="panel-heading f-fwb">患者数据详情<a href="#modal-export" class="btn btn-primary f-fr" role="button" data-toggle="modal">导出当前患者数据</a></div>
			<div class="panel-body">
				<div class="search-row">
					<form action="<?php A_M_U('user/search') ?>?userid=<?php echo $userid ; ?>" method="post"  >
									记录时间：
									从 <input type="text" class="input-small" id="start-date" name="start-date" value="<?php echo $start_d ; ?>" style="width:80px;"/> 日
									<select name="start-hour" id="start-hour"  style="width:60px;">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select> 时，到 <input type="text" class="input-small" id="end-date" name="end-date" value="<?php echo $end_d ; ?>" style="width:80px;"/> 日
									<select name="end-hour" id="end-hour" style="width:60px;">
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select> 时
						<div class="form-buttons">
							<button class="btn btn-default" id="submit">筛选</button>
						</div>	
					</form>				
				</div>
				<br>
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
							<!--<div class="more" style="text-align:left" ><a class="btn btn-primary" href="#">更多血糖数据</a></div>-->
							<div id="chart-sugar-1" class="chart"></div>
							<div id="chart-sugar-2" class="chart"></div>
							<div id="chart-sugar-3" class="chart"></div>
							<div id="chart-sugar-4" class="chart"></div>
							<div id="chart-sugar-5" class="chart"></div>
							<div id="chart-sugar-6" class="chart"></div>
							<div id="chart-sugar-7" class="chart"></div>
							<div id="chart-sugar-8" class="chart"></div>
						</div>
						<div class="item item-pressure">
							<!--<div class="more" style="text-align:left"  ><a class="btn btn-primary" href="#">更多血压数据</a></div>-->
							<div id="chart-pressure" class="chart"></div>
						</div>
						<div class="item item-food">
							<ul class="f-cb">
								<?php
								for($i = 0; $i < count($food_records); $i++) {
								?>
								<li>
									<div class="f-cb" style="height:150px; " >
										<?php
										if($food_records[$i]['photo']) {
										?>
										<a class="photo f-fl photo-link" href="javascript:;" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($food_records[$i]['photo']); ?>" style="height:150px; "  /></a>
										<?php
										} else {
										?>
										<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/nophoto.jpg" style="height:150px; "  /></a>
										<?php
										}
										?>
										<div class="detail f-fr">
											<div class="type"><?php echo $food_records[$i]['type']; ?></div>
											<div class="time"><?php echo date('m-d H:i', $food_records[$i]['measuretime']); ?></div>
											<div class="des"><?php echo $food_records[$i]['content']; ?></div>
										</div>
									</div>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
						<div class="item item-drug">
							<ul class="f-cb">
								<?php
								for($i = 0; $i < count($drug_records); $i++) {
								?>
								<li  >
									<div class="f-cb" style="height:150px; " >
										<?php
										if($drug_records[$i]['photo']) {
										?>
										<a class="photo f-fl photo-link" href="javascript:;" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($drug_records[$i]['photo']); ?>" style="height:150px;" /></a>
										<?php
										} else {
										?>
										<a class="photo f-fl" href="javascript:;"><img style="height:150px; "  src="<?php echo base_url(); ?>public/images/nophoto.jpg"/></a>
										<?php
										}
										?>
										<div class="detail f-fr">
											<div class="type"><?php echo $drug_records[$i]['type']; ?></div>
											<div class="time"><?php echo date('m-d H:i', $drug_records[$i]['measuretime']); ?></div>
											<div class="des"><?php echo $drug_records[$i]['content']; ?></div>
										</div>
									</div>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
						<div class="item item-bmi">
							<div id="chart-bmi" class="chart"></div>
						</div>
						<div class="item item-visit">
							<ul class="f-cb">
								<?php
								for($i = 0; $i < count($visit_records); $i++) {
								?>
								<li  >
									<div class="f-cb" style="height:150px; " >
										<?php
										if($visit_records[$i]['photo']) {
										?>
										<a class="photo f-fl photo-link" href="javascript:;" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($visit_records[$i]['photo']); ?>" style="height:150px;" /></a>
										<?php
										} else {
										?>
										<a class="photo f-fl" href="javascript:;"><img style="height:150px; "  src="<?php echo base_url(); ?>public/images/nophoto.jpg"/></a>
										<?php
										}
										?>
										<div class="detail f-fr">
											<div class="type"><?php echo $visit_records[$i]['type']; ?></div>
											<div class="time"><?php echo date('m-d H:i', $visit_records[$i]['measuretime']); ?></div>
											<div class="des"><?php echo $visit_records[$i]['content']; ?></div>
										</div>
									</div>
								</li>
								<?php
								}
								?>
						</div>
						<div class="item item-stature">
							<div id="chart-whr" class="chart"></div>
						</div>
						<div class="item item-protein">
							<!--<div class="more" style="text-align:left"  ><a class="btn btn-primary" href="#">更多糖化血红蛋白数据</a></div>-->
							<div id="chart-protein" class="chart"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-export" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">选择导出数据时间段</h3>
	</div>
	<form action="<?php A_M_U('user/export') ?>?userid=<?php echo $userid ; ?>" method="post"  >
	<div class="modal-body" style="padding-left:100px;">
		从 <input type="text" class="input-small" id="start-date2" name="start" value=""/> 日
		<select name="start-hour" id="start-hour">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select> 时
		<br /><br />
		到 <input type="text" class="input-small" id="end-date2" name="end" value=""/> 日
		<select name="end-hour" id="end-hour">
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select> 时
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
		<button class="btn btn-primary">导出</button>
	</div>
	</form>
</div>

<?php
$this->load->view('include/footer');
?>