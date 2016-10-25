<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript" src="<?php echo site_url(); ?>public/js/highcharts-4.1.3/js/highcharts.js"></script>
<script type="text/javascript" src="<?php echo site_url(); ?>public/js/echarts-3.0.1/echarts.common.min.js"></script>
<script type="text/javascript"> 
$(function() {
	
	$('.detail .tabs .tab a').click(function() {
		var
			tab = $(this),
			index = tab.data('index')
		;
		$('.detail .tabs .tab').removeClass('cur');
		$('.detail .tabs .tab').eq(index).addClass('cur');
		$('.detail .tab-content .tab-item').removeClass('cur');
		$('.detail .tab-content .tab-item').eq(index).addClass('cur');
	});
	
	$('.item-sugar').show();
	$('.navbar a').click(function (){
		var
			tab = $(this),
			item_label = tab.data('item'),
			item = $('.item-' + item_label)
		;
		$('.navbar a').removeClass('cur');
		tab.addClass('cur');
		$('.records .item').hide();
		item.show();
		if(item_label == 'pressure') {
			init_pressure();
		} else if(item_label == 'protein') {
			init_protein();
		} else if(item_label == 'bmi') {
			init_bmi();
		} else if(item_label == 'whr') {
			init_whr();
		}
	});
	
	// 血压
	function init_pressure() {
		var option = {
			title : {
				text: '',
				subtext: '近10次测量统计'
			},
			tooltip : {
				trigger: 'axis'
			},
			legend: {
				data:['高压mmHg', '低压mmHg']
			},
			toolbox: {
				show : false
			},
			xAxis : [
				{
					type : 'category',
					boundaryGap : false,
					data : [
					<?php
					for($i = 0; $i < count($pressure_records); $i++) {
						if($i == 0) {
							echo "'" . date('m-d', $pressure_records[$i]['measuretime']) . "'";
						} else {
							echo ",'" . date('m-d', $pressure_records[$i]['measuretime']) . "'";
						}
					}
					?>
					]
				}
			],
			yAxis : [
				{
					type : 'value',
					axisLabel : {
						formatter: '{value}'
					}
				}
			],
			series : [
				{
					name:'高压mmHg',
					type:'line',
					data:[
					<?php
					for($i = 0; $i < count($pressure_records); $i++) {
						if($i == 0) {
							echo $pressure_records[$i]['high'];
						} else {
							echo "," . $pressure_records[$i]['high'];
						}
					}
					?>
					],
					markPoint : {
						symbol : 'circle',
						symbolSize : 24,
						data : [
							<?php
							for($i = 0; $i < count($pressure_records); $i++) {
								if($i == 0) {
									echo "{name : '腰臀比', value : " . $pressure_records[$i]['high'] . ", xAxis: " . $i . ", yAxis: " . $pressure_records[$i]['high'] . "}";
								} else {
									echo ",{name : '腰臀比', value : " . $pressure_records[$i]['high'] . ", xAxis: " . $i . ", yAxis: " . $pressure_records[$i]['high'] . "}";
								}
							}
							?>
						]
					},
					markLine : {
						data : [
							{type : 'average', name: '平均值'}
						]
					}
				},
				{
					name:'低压mmHg',
					type:'line',
					data:[
					<?php
					for($i = 0; $i < count($pressure_records); $i++) {
						if($i == 0) {
							echo $pressure_records[$i]['low'];
						} else {
							echo "," . $pressure_records[$i]['low'];
						}
					}
					?>
					],
					markPoint : {
						symbol : 'circle',
						symbolSize : 24,
						data : [
							<?php
							for($i = 0; $i < count($pressure_records); $i++) {
								if($i == 0) {
									echo "{name : '腰臀比', value : " . $pressure_records[$i]['low'] . ", xAxis: " . $i . ", yAxis: " . $pressure_records[$i]['low'] . "}";
								} else {
									echo ",{name : '腰臀比', value : " . $pressure_records[$i]['low'] . ", xAxis: " . $i . ", yAxis: " . $pressure_records[$i]['low'] . "}";
								}
							}
							?>
						]
					},
					markLine : {
						data : [
							{type : 'average', name: '平均值'}
						]
					}
				}
			]
		};
		
		var chart = echarts.init(document.getElementById('chart-pressure'));
		chart.setOption(option);
	}
	// BMI
	function init_bmi() {
		var option = {
			title : {
				text: '',
				subtext: '近10次测量统计'
			},
			tooltip : {
				trigger: 'axis'
			},
			legend: {
				data:['BMI']
			},
			toolbox: {
				show : false
			},
			xAxis : [
				{
					type : 'category',
					boundaryGap : false,
					data : [
					<?php
					for($i = 0; $i < count($bmi_records); $i++) {
						if($i == 0) {
							echo "'" . date('m-d', $bmi_records[$i]['measuretime']) . "'";
						} else {
							echo ",'" . date('m-d', $bmi_records[$i]['measuretime']) . "'";
						}
					}
					?>
					]
				}
			],
			yAxis : [
				{
					type : 'value',
					min : 'dataMin',
					boundaryGap : true,
					axisLabel : {
						formatter: '{value}'
					}
				}
			],
			series : [
				{
					name:'BMI',
					type:'line',
					data:[
					<?php
					for($i = 0; $i < count($bmi_records); $i++) {
						if($i == 0) {
							echo $bmi_records[$i]['bmi'];
						} else {
							echo "," . $bmi_records[$i]['bmi'];
						}
					}
					?>
					],
					markPoint : {
						symbol : 'pin',
						symbolSize : 55,
						data : [
							<?php
							for($i = 0; $i < count($bmi_records); $i++) {
								if($i == 0) {
									echo "{name : 'BMI', value : " . $bmi_records[$i]['bmi'] . ", xAxis: " . $i . ", yAxis: " . $bmi_records[$i]['bmi'] . "}";
								} else {
									echo ",{name : 'BMI', value : " . $bmi_records[$i]['bmi'] . ", xAxis: " . $i . ", yAxis: " . $bmi_records[$i]['bmi'] . "}";
								}
							}
							?>
						]
					},
					markLine : {
						data : [
							{type : 'average', name: '平均值'}
						]
					}
				}
			]
		};
		
		var chart = echarts.init(document.getElementById('chart-bmi'));
		chart.setOption(option);
	}
	// 糖化血红蛋白
	function init_protein() {
		var option = {
			title : {
				text: '',
				subtext: '近10次测量统计'
			},
			tooltip : {
				trigger: 'axis'
			},
			legend: {
				data:['糖化血红蛋白']
			},
			toolbox: {
				show : false
			},
			xAxis : [
				{
					type : 'category',
					boundaryGap : false,
					data : [
					<?php
					for($i = 0; $i < count($protein_records); $i++) {
						if($i == 0) {
							echo "'" . date('m-d', $protein_records[$i]['measuretime']) . "'";
						} else {
							echo ",'" . date('m-d', $protein_records[$i]['measuretime']) . "'";
						}
					}
					?>
					]
				}
			],
			yAxis : [
				{
					type : 'value',
					axisLabel : {
						formatter: '{value}'
					}
				}
			],
			series : [
				{
					name:'糖化血红蛋白',
					type:'line',
					data:[
					<?php
					for($i = 0; $i < count($protein_records); $i++) {
						if($i == 0) {
							echo $protein_records[$i]['protein'];
						} else {
							echo "," . $protein_records[$i]['protein'];
						}
					}
					?>
					],
					markPoint : {
						symbol : 'pin',
						symbolSize : 45,
						data : [
							<?php
							for($i = 0; $i < count($protein_records); $i++) {
								if($i == 0) {
									echo "{name : '糖化血红蛋白', value : " . $protein_records[$i]['protein'] . ", xAxis: " . $i . ", yAxis: " . $protein_records[$i]['protein'] . "}";
								} else {
									echo ",{name : '糖化血红蛋白', value : " . $protein_records[$i]['protein'] . ", xAxis: " . $i . ", yAxis: " . $protein_records[$i]['protein'] . "}";
								}
							}
							?>
						]
					},
					markLine : {
						data : [
							{type : 'average', name: '平均值'}
						]
					}
				}
			]
		};

		var chart = echarts.init(document.getElementById('chart-protein'));
		chart.setOption(option);
	}
	// 腰臀比
	function init_whr() {
		var option = {
			title : {
				text: '',
				subtext: '近10次测量统计'
			},
			tooltip : {
				trigger: 'axis'
			},
			legend: {
				data:['腰臀比']
			},
			toolbox: {
				show : false
			},
			xAxis : [
				{
					type : 'category',
					boundaryGap : false,
					data : [
					<?php
					for($i = 0; $i < count($whr_records); $i++) {
						if($i == 0) {
							echo "'" . date('m-d', $whr_records[$i]['measuretime']) . "'";
						} else {
							echo ",'" . date('m-d', $whr_records[$i]['measuretime']) . "'";
						}
					}
					?>
					]
				}
			],
			yAxis : [
				{
					type : 'value',
					axisLabel : {
						formatter: '{value}'
					}
				}
			],
			series : [
				{
					name:'腰臀比',
					type:'line',
					data:[
					<?php
					for($i = 0; $i < count($whr_records); $i++) {
						if($i == 0) {
							echo $whr_records[$i]['whr'];
						} else {
							echo "," . $whr_records[$i]['whr'];
						}
					}
					?>
					],
					markPoint : {
						symbol : 'pin',
						symbolSize : 55,
						data : [
							<?php
							for($i = 0; $i < count($whr_records); $i++) {
								if($i == 0) {
									echo "{name : '腰臀比', value : " . $whr_records[$i]['whr'] . ", xAxis: " . $i . ", yAxis: " . $whr_records[$i]['whr'] . "}";
								} else {
									echo ",{name : '腰臀比', value : " . $whr_records[$i]['whr'] . ", xAxis: " . $i . ", yAxis: " . $whr_records[$i]['whr'] . "}";
								}
							}
							?>
						]
					},
					markLine : {
						data : [
							{type : 'average', name: '平均值'}
						]
					}
				}
			]
		};
		
		var chart = echarts.init(document.getElementById('chart-whr'));
		chart.setOption(option);
	}
	
	$('.photo-link').click(function() {
		var src = $(this).find('img').eq(0).attr('src');
		$('#popupUphoto img').attr('src', src);
	});
	
	$('#update-submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var uname = $.trim($('#uname').val());
		$.post('../update_uname',
			{
				uname: uname,
				userid: <?php echo $user['id']; ?>
			}, function(data) {
				if(data.result >= 0) {
					window.location = '../show/<?php echo $user['id']; ?>';
				} else {
					alert('更新失败~');
					nn_enableButton(_btn, '提交');
				}
			},
			'json'
		);
	});
	
	
	$('#submit-del').click(function() {
		$.post('../unbind',
			{
				userid: <?php echo $user['id'] ? $user['id'] : 0; ?>
			},
			function(data) {
				if(data.result) {
					// luiji_alert('success', '删除成功！');
					alert('取消关注成功！');
					// window.setTimeout(function() {
						window.location = '../index';
					// }, 1000);
				} else {
					luiji_alert('error', '取消关注失败，待会再试');
				}
			},
			'json'
		);
	});
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="患者" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>患者</h1>
	<a href="../index" data-icon="back" data-ajax="false">返回</a>
	<a href="../../chat/user/<?php echo $user['id']; ?>" data-icon="comment" data-ajax="false">在线对话</a>
</div>
<div id="user-show" role="main" class="ui-content gh-center">
	
	<div class="info f-cb">
		<?php
		if($user['thumb']) {
		?>
		<div class="photo f-fl">
			<a class="photo-link" href="#popupUphoto" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($user['thumb']); ?>"/></a>
			<!--<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-search ui-mini">更换照片</button>-->
		</div>
		<?php
		} else {
		?>
		<div class="photo f-fl">
			<a href="javascript:;"><img src="<?php echo base_url(); ?>public/images/user-nophoto.jpg"/></a>
			<!--<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-search ui-mini">添加照片</button>-->
		</div>
		<?php
		}
		?>
		<div class="text f-fr">
			<div class="username">患者姓名：<?php echo $user['username']; ?></div>
			<div class="username">备注姓名：<?php echo $user['uname']; ?>
			<?php
			if($user['uname']) {
			?>
			<a href="#popupUname" data-rel="popup" data-position-to="window" data-transition="pop">[修改]</a>
			<?php
			} else {
			?>
			<a href="#popupUname" data-rel="popup" data-position-to="window" data-transition="pop">[添加]</a>
			<?php
			}
			?>
			</div>
			<div class="account">联系电话：<?php echo $user['mobile']; ?></div>
			<div class="account">邮箱地址：<?php echo $user['email']; ?></div>
			<div class="bindtime">添加时间：<?php echo date('Y-m-d', $user['bindtime']); ?></div>
			<a href="#popupUnbind" data-rel="popup" data-position-to="window" data-transition="pop" style="text-align:right;display:block;text-decoration:none;color:#5B9BBF;font-size:14px;padding-top:6px;font-weight:normal;">[ 取消关注 ]</a>
			<!--
			<div class="account">性　　别：男</div>
			<div class="account">出生年月：1989-1</div>
			-->
		</div>
	</div>
	<?php
	if(true || $user['healthopen']) {
	?>
	<div class="detail">
		<div class="tabs f-cb">
			<div class="tab cur"><a href="javascript:;" data-index="0">健康数据</a></div>
			<div class="tab"><a href="javascript:;" data-index="1">查看病历</a></div>
		</div>
		<div class="tab-content">
			<div class="tab-item cur" style="padding:20px 0 0;">
				<div class="navbar">
					<ul class="f-cb">
						<li><a href="javascript:;" data-item="sugar" class="ui-link ui-btn cur">血糖</a></li>
						<li><a href="javascript:;" data-item="pressure" class="ui-link ui-btn ">血压</a></li>
						<li><a href="javascript:;" data-item="food" class="ui-link ui-btn ">饮食</a></li>
						<li><a href="javascript:;" data-item="drug" class="ui-link ui-btn ">用药</a></li>
						<li><a href="javascript:;" data-item="bmi" class="ui-link ui-btn ">BMI</a></li>
						<li><a href="javascript:;" data-item="visit" class="ui-link ui-btn ">就诊</a></li>
						<li><a href="javascript:;" data-item="whr" class="ui-link ui-btn ">腰臀比</a></li>
						<li><a href="javascript:;" data-item="protein" class="ui-link ui-btn ">糖化血红蛋白</a></li>
					</ul>
				</div>
				<div class="records" style="padding-top:0;">
					<div class="item item-sugar">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_sugar/<?php echo $user['id']; ?>" data-ajax="false">合并数据</a><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_box/<?php echo $user['id']; ?>" data-ajax="false">盒子数据</a></div>
						<div id="sugar-calendar">
							<div class="cal-suggest"></div>
							<div class="cal-topbar f-cb">
								<div class="tb-label f-fl">血糖</div>
								<div class="tb-body f-fr">
									<div class="four-meals f-cb">
										<div class="meal f-fl">
											<div class="meal-item">
												<div class="meal-label">早餐</div>
												<div class="two-time f-cb">
													<div class="item-cell f-fl">前</div>
													<div class="item-cell f-fr">后</div>
												</div>
											</div>
										</div>
										<div class="meal f-fl">
											<div class="meal-item">
												<div class="meal-label">午餐</div>
												<div class="two-time f-cb">
													<div class="item-cell f-fl">前</div>
													<div class="item-cell f-fr">后</div>
												</div>
											</div>
										</div>
										<div class="meal f-fl">
											<div class="meal-item">
												<div class="meal-label">晚餐</div>
												<div class="two-time f-cb">
													<div class="item-cell f-fl">前</div>
													<div class="item-cell f-fr">后</div>
												</div>
											</div>
										</div>
										<div class="meal f-fl">
											<div class="meal-item">
												<div class="meal-label">夜间</div>
												<div class="two-time f-cb">
													<div class="item-cell f-fl">前</div>
													<div class="item-cell f-fr">后</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="cal-body">
								<?php
								for($i = 0; $i < count($sugar_records); $i++) {
								?>
								<div class="cal-day f-cb">
									<div class="day-label f-fl"><?php echo $sugar_records[$i]['time']; ?></div>
									<div class="day-records f-fr">
										<div class="four-meals f-cb">
											<div class="meal f-fl">
												<div class="two-time f-cb">
													<div class="item-cell f-fl <?php echo $sugar_records[$i]['data'][0]; ?>"><?php echo $sugar_records[$i]['sugar'][0]; ?></div>
													<div class="item-cell f-fr <?php echo $sugar_records[$i]['data'][1]; ?>"><?php echo $sugar_records[$i]['sugar'][1]; ?></div>
												</div>
											</div>
											<div class="meal f-fl">
												<div class="two-time f-cb">
													<div class="item-cell f-fl <?php echo $sugar_records[$i]['data'][2]; ?>"><?php echo $sugar_records[$i]['sugar'][2]; ?></div>
													<div class="item-cell f-fr <?php echo $sugar_records[$i]['data'][3]; ?>"><?php echo $sugar_records[$i]['sugar'][3]; ?></div>
												</div>
											</div>
											<div class="meal f-fl">
												<div class="two-time f-cb">
													<div class="item-cell f-fl <?php echo $sugar_records[$i]['data'][4]; ?>"><?php echo $sugar_records[$i]['sugar'][4]; ?></div>
													<div class="item-cell f-fr <?php echo $sugar_records[$i]['data'][5]; ?>"><?php echo $sugar_records[$i]['sugar'][5]; ?></div>
												</div>
											</div>
											<div class="meal f-fl">
												<div class="two-time f-cb">
													<div class="item-cell f-fl <?php echo $sugar_records[$i]['data'][6]; ?>"><?php echo $sugar_records[$i]['sugar'][6]; ?></div>
													<div class="item-cell f-fr <?php echo $sugar_records[$i]['data'][7]; ?>"><?php echo $sugar_records[$i]['sugar'][7]; ?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="item item-pressure">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_pressure/<?php echo $user['id']; ?>" data-ajax="false">过往数据</a></div>
						<div id="chart-pressure" class="chart"></div>
					</div>
					<div class="item item-food">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_food/<?php echo $user['id']; ?>" data-ajax="false">过往数据</a></div>
						<?php
						if($food_records) {
						?>
						<ul>
							<?php
							for($i = 0; $i < count($food_records); $i++) {
							?>
							<li class="f-cb">
								<?php
								if($food_records[$i]['photo']) {
								?>
								<a class="photo f-fl photo-link" href="#popupUphoto" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($food_records[$i]['photo']); ?>"/></a>
								<?php
								} else {
								?>
								<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/nophoto.jpg"/></a>
								<?php
								}
								?>
								<div class="detail f-fr">
									<div class="type"><?php echo $food_records[$i]['type']; ?></div>
									<div class="time"><?php echo date('m-d H:i', $food_records[$i]['measuretime']); ?></div>
									<div class="des"><?php echo $food_records[$i]['content']; ?></div>
								</div>
							</li>
							<?php
							}
							?>
						</ul>
						<?php
						} else {
						?>
						<div class="empty-alert" style="padding:10px 20px;color:#f33;">当前时间段下没有任何记录~</div>
						<?php
						}
						?>
					</div>
					<div class="item item-drug">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_drug/<?php echo $user['id']; ?>" data-ajax="false">过往数据</a></div>
						<ul>
							<?php
							for($i = 0; $i < count($drug_records); $i++) {
							?>
							<li class="f-cb">
								<?php
								if($drug_records[$i]['photo']) {
								?>
								<a class="photo f-fl photo-link" href="#popupUphoto" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($drug_records[$i]['photo']); ?>"/></a>
								<?php
								} else {
								?>
								<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/nophoto.jpg"/></a>
								<?php
								}
								?>
								<div class="detail f-fr">
									<div class="type"><?php echo $drug_records[$i]['type']; ?></div>
									<div class="time"><?php echo date('m-d H:i', $drug_records[$i]['measuretime']); ?></div>
									<div class="des"><?php echo $drug_records[$i]['content']; ?></div>
								</div>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
					<div class="item item-bmi">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_bmi/<?php echo $user['id']; ?>" data-ajax="false">过往数据</a></div>
						<div id="chart-bmi" class="chart"></div>
					</div>
					<div class="item item-visit">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_visit/<?php echo $user['id']; ?>" data-ajax="false">过往数据</a></div>
					<?php
					if($visit_records) {
					?>
					<ul>
						<?php
						for($i = 0; $i < count($visit_records); $i++) {
						?>
						<li class="f-cb">
							<?php
							if($visit_records[$i]['photo']) {
							?>
							<a class="photo f-fl photo-link" href="#popupUphoto" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($visit_records[$i]['photo']); ?>"/></a>
							<?php
							} else {
							?>
							<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/nophoto.jpg"/></a>
							<?php
							}
							?>
							<div class="detail f-fr">
								<div class="type"><?php echo $visit_records[$i]['type']; ?></div>
								<div class="time"><?php echo date('m-d H:i', $visit_records[$i]['measuretime']); ?></div>
								<div class="des"><?php echo $visit_records[$i]['content']; ?></div>
							</div>
						</li>
						<?php
						}
						?>
					</ul>
					<?php
					} else {
					?>
					<div class="empty-alert" style="padding:10px 20px;color:#f33;">当前时间段下没有任何记录~</div>
					<?php
					}
					?>
				</div>
					<div class="item item-whr">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_whr/<?php echo $user['id']; ?>" data-ajax="false">过往数据</a></div>
						<div id="chart-whr" class="chart"></div>
					</div>
					<div class="item item-protein">
						<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="../record_protein/<?php echo $user['id']; ?>" data-ajax="false">过往数据</a></div>
						<div id="chart-protein" class="chart"></div>
					</div>
				</div>
			</div>
			<div class="tab-item" style="padding:20px;">
				<!--<div class="more"><a href="./dossier/<?php echo $user['id']; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-calendar ui-btn-icon-left ui-btn-b ui-mini">查看所有病历</a></div>-->
				<ul class="dossier-list">
					<?php
					for($i = 0; $i < count($dossiers); $i++) {
					?>
					<li class="<?php echo $i == 0 ? 'first' : ''; ?>">
						<!--<a href="./show/3" data-ajax="false" class="f-cb">-->
							<h3><?php echo $dossiers[$i]['title']; ?></h3>
							<div class="des"><?php echo $dossiers[$i]['content']; ?></div>
							<?php
							if($dossiers[$i]['photos']) {
								$photos = $dossiers[$i]['photos'];
								$photos = explode(';', $photos);
							?>
							<div class="thumbs f-cb">
							<?php
							for($j = 0; $j < count($photos); $j++) {
							?>
								<div class="thumb <?php echo ($j == count($photos) - 1) ? 'last' : ''; ?>"><img src="<?php echo nn_fix_uploadurl($photos[$j]); ?>"/></div>
							<?php
							}
							?>
							</div>
							<?php
							}
							?>
							<div class="timeinfo f-cb">
								<div class="time f-fl"><?php echo date('Y-m-d H:i', $dossiers[$i]['createtime']); ?></div>
							</div>
						<!--</a>-->
					</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	<?php
	} else {
	?>
	<div class="info-error">用户未打开健康监护</div>
	<?php
	}
	?>
</div>


<div data-role="popup" id="popupUname" data-theme="b" data-overlay-theme="b">
	<div style="padding:10px 20px;">
		<h3>输入备注名</h3>
		<label for="uname" class="ui-hidden-accessible">备注名：</label>
		<input type="text" name="user" id="uname" placeholder="输入备注名" value="<?php echo $user['uname']; ?>"/>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" id="update-submit">更新</a>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" data-rel="back" data-transition="flow" id="update-cancel">取消</a>
	</div>
</div>

<div data-role="popup" id="popupUnbind" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定取消</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定取消关注该患者？</h3>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="submit-del">确定</a>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<div data-role="popup" id="popupUphoto" class="photopopup" data-overlay-theme="b" data-corners="false" data-tolerance="30,15">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<img src="<?php echo nn_fix_uploadurl($user['thumb']); ?>"/>
</div>
<?php
$this->load->view('include/footer');
?>