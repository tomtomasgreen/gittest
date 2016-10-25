<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript" src="<?php echo site_url(); ?>public/js/highcharts-4.1.3/js/highcharts.js"></script>
<script type="text/javascript"> 
$(function() {
	$('.item-sugar').show();
	init_sugar();
	// 血糖
	function init_sugar() {
		$('#chart-sugar-1').highcharts({
			chart: {type: 'line'},
			title: {text: '空腹血糖统计图'},
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			subtitle: {text: '近10次测量统计'},
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
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: false
				}
			},
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
			<li><a data-ajax="false" href="javascript:;" data-item="sugar" class="ui-link ui-btn cur">血糖</a></li>
			<li><a data-ajax="false" href="./show_pressure" data-item="pressure" class="ui-link ui-btn ">血压</a></li>
			<li><a data-ajax="false" href="./show_food" data-item="food" class="ui-link ui-btn ">饮食</a></li>
			<li><a data-ajax="false" href="./show_drug" data-item="drug" class="ui-link ui-btn ">用药</a></li>
			<li><a data-ajax="false" href="./show_bmi" data-item="bmi" class="ui-link ui-btn ">BMI</a></li>
			<li><a data-ajax="false" href="./show_visit" data-item="visit" class="ui-link ui-btn ">就诊</a></li>
			<li><a data-ajax="false" href="./show_whr" data-item="whr" class="ui-link ui-btn ">腰臀比</a></li>
			<li><a data-ajax="false" href="./show_protein" data-item="protein" class="ui-link ui-btn ">糖化血红蛋白</a></li>
		</ul>
	</div>
	<div class="records">
		<div class="item item-sugar">
			<div class="more"><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="./more" data-ajax="false">合并数据</a><a class="ui-link ui-btn ui-btn-inline ui-btn-corner-all" href="./box" data-ajax="false">盒子数据</a></div>
			<div id="chart-sugar-1" class="chart"></div>
			<div id="chart-sugar-2" class="chart"></div>
			<div id="chart-sugar-3" class="chart"></div>
			<div id="chart-sugar-4" class="chart"></div>
			<div id="chart-sugar-5" class="chart"></div>
			<div id="chart-sugar-6" class="chart"></div>
			<div id="chart-sugar-7" class="chart"></div>
			<div id="chart-sugar-8" class="chart"></div>
		</div>
	</div>

</div>
<?php
$this->load->view('include/footer');
?>