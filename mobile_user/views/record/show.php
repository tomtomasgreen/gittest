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
					for($i = 0; $i < count($records); $i++) {
					?>
					<div class="cal-day f-cb">
						<div class="day-label f-fl"><?php echo $records[$i]['time']; ?></div>
						<div class="day-records f-fr">
							<div class="four-meals f-cb">
								<div class="meal f-fl">
									<div class="two-time f-cb">
										<div class="item-cell f-fl <?php echo $records[$i]['data'][0]; ?>"><?php echo $records[$i]['sugar'][0]; ?></div>
										<div class="item-cell f-fr <?php echo $records[$i]['data'][1]; ?>"><?php echo $records[$i]['sugar'][1]; ?></div>
									</div>
								</div>
								<div class="meal f-fl">
									<div class="two-time f-cb">
										<div class="item-cell f-fl <?php echo $records[$i]['data'][2]; ?>"><?php echo $records[$i]['sugar'][2]; ?></div>
										<div class="item-cell f-fr <?php echo $records[$i]['data'][3]; ?>"><?php echo $records[$i]['sugar'][3]; ?></div>
									</div>
								</div>
								<div class="meal f-fl">
									<div class="two-time f-cb">
										<div class="item-cell f-fl <?php echo $records[$i]['data'][4]; ?>"><?php echo $records[$i]['sugar'][4]; ?></div>
										<div class="item-cell f-fr <?php echo $records[$i]['data'][5]; ?>"><?php echo $records[$i]['sugar'][5]; ?></div>
									</div>
								</div>
								<div class="meal f-fl">
									<div class="two-time f-cb">
										<div class="item-cell f-fl <?php echo $records[$i]['data'][6]; ?>"><?php echo $records[$i]['sugar'][6]; ?></div>
										<div class="item-cell f-fr <?php echo $records[$i]['data'][7]; ?>"><?php echo $records[$i]['sugar'][7]; ?></div>
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
	</div>

</div>
<?php
$this->load->view('include/footer');
?>