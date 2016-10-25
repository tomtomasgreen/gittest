<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript" src="<?php echo site_url(); ?>public/js/echarts-3.0.1/echarts.common.min.js"></script>
<script type="text/javascript"> 
$(function() {
	$('.item-pressure').show();
	init_pressure();
	
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
});
</script>
<style type="text/css">
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="数据" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>数据</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="record-show" class="gh-center">

	<div class="navbar">
		<ul class="f-cb">
			<li><a data-ajax="false" href="./show" data-item="sugar" class="ui-link ui-btn">血糖</a></li>
			<li><a data-ajax="false" href="javascript:;" data-item="pressure" class="ui-link ui-btn cur">血压</a></li>
			<li><a data-ajax="false" href="./show_food" data-item="food" class="ui-link ui-btn ">饮食</a></li>
			<li><a data-ajax="false" href="./show_drug" data-item="drug" class="ui-link ui-btn ">用药</a></li>
			<li><a data-ajax="false" href="./show_bmi" data-item="bmi" class="ui-link ui-btn ">BMI</a></li>
			<li><a data-ajax="false" href="./show_visit" data-item="visit" class="ui-link ui-btn ">就诊</a></li>
			<li><a data-ajax="false" href="./show_whr" data-item="whr" class="ui-link ui-btn ">腰臀比</a></li>
			<li><a data-ajax="false" href="./show_protein" data-item="protein" class="ui-link ui-btn ">糖化血红蛋白</a></li>
		</ul>
	</div>
	<div class="records">
		<div class="item item-pressure">
			<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="./more_pressure" data-ajax="false">过往数据</a></div>
			<div class="chart-box"><div id="chart-pressure" class="chart"></div></div>
		</div>
	</div>

</div>

<?php
$this->load->view('include/footer');
?>