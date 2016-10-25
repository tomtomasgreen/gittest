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
	$('#start').change(function() {
		var starttime = $(this).val();
		starttime = Date.parse(new Date(starttime));
		starttime = starttime / 1000;
		var endtime = (starttime + 60 * 60 * 24 * 7) * 1000;
		var endtimeDate = new Date();
		endtimeDate.setTime(endtime);
		$('#end').val(endtimeDate.format('yyyy-MM-dd'));
	});
	$('#end').change(function() {
		var endtime = $(this).val();
		endtime = Date.parse(new Date(endtime));
		endtime = endtime / 1000;
		var starttime = (endtime - 60 * 60 * 24 * 7) * 1000;
		var starttimeDate = new Date();
		starttimeDate.setTime(starttime);
		$('#start').val(starttimeDate.format('yyyy-MM-dd'));
	});
	
	init_protein();
	
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
					for($i = 0; $i < count($records); $i++) {
						if($i == 0) {
							echo "'" . date('m-d', $records[$i]['measuretime']) . "'";
						} else {
							echo ",'" . date('m-d', $records[$i]['measuretime']) . "'";
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
					for($i = 0; $i < count($records); $i++) {
						if($i == 0) {
							echo $records[$i]['protein'];
						} else {
							echo "," . $records[$i]['protein'];
						}
					}
					?>
					],
					markPoint : {
						symbol : 'pin',
						symbolSize : 45,
						data : [
							<?php
							for($i = 0; $i < count($records); $i++) {
								if($i == 0) {
									echo "{name : '糖化血红蛋白', value : " . $records[$i]['protein'] . ", xAxis: " . $i . ", yAxis: " . $records[$i]['protein'] . "}";
								} else {
									echo ",{name : '糖化血红蛋白', value : " . $records[$i]['protein'] . ", xAxis: " . $i . ", yAxis: " . $records[$i]['protein'] . "}";
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
});
</script>
<style type="text/css">
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="过往数据" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>过往数据</h1>
	<a href="./show_protein" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="record-more" class="gh-center">
	<div class="search f-cb">
		<form action="./more_protein" method="post" data-ajax="false">
			<div class="startdate f-fl"><input type="date" name="start" id="start" value="<?php echo date('Y-m-d', $start); ?>"/></div>
			<div class="enddate f-fl"><input type="date" name="end" id="end" value="<?php echo date('Y-m-d', $end); ?>"/></div>
			<div class="submit-control f-fr"><button class="ui-btn ui-btn-inline ui-btn-corner-all" id="search-submit">筛选</button></div>
		</form>
	</div>
	<div class="info"><div class="text">当前糖化血红蛋白数据共： <span><?php echo count($records); ?></span> 条</div></div>
	<div class="chart-box"><div id="chart-protein" class="chart"></div></div>
	<ul>
		<?php
		for($i = 0; $i < count($records); $i++) {
		?>
		<li>
			<div class="time"><?php echo $records[$i]['measuretimes']; ?></div>
			<div class="money decrease">糖化血红蛋白值：<?php echo $records[$i]['protein']; ?></div>
			<div class="des"></div>
		</li>
		<?php
		}
		?>
	</ul>
</div>

<?php
$this->load->view('include/footer');
?>