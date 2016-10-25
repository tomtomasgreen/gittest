<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	$('#start').change(function() {
		var starttime = $(this).val();
		starttime = Date.parse(new Date(starttime));
		starttime = starttime / 1000;
		var endtime = (starttime + 60 * 60 * 24 * 30) * 1000;
		var endtimeDate = new Date();
		endtimeDate.setTime(endtime);
		$('#end').val(endtimeDate.format('yyyy-MM-dd'));
	});
	$('#end').change(function() {
		var endtime = $(this).val();
		endtime = Date.parse(new Date(endtime));
		endtime = endtime / 1000;
		var starttime = (endtime - 60 * 60 * 24 * 30) * 1000;
		var starttimeDate = new Date();
		starttimeDate.setTime(starttime);
		$('#start').val(starttimeDate.format('yyyy-MM-dd'));
	});
});
</script>
<style type="text/css">
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="盒子数据" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>盒子数据</h1>
	<a href="../show/<?php echo $id; ?>" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="record-more" class="gh-center">
	<div class="search f-cb">
		<form action="../record_box/<?php echo $id; ?>" method="post" data-ajax="false">
			<div class="startdate f-fl"><input type="date" name="start" id="start" value="<?php echo date('Y-m-d', $start); ?>"/></div>
			<div class="enddate f-fl"><input type="date" name="end" id="end" value="<?php echo date('Y-m-d', $end); ?>"/></div>
			<div class="submit-control f-fr"><button class="ui-btn ui-btn-inline ui-btn-corner-all" id="search-submit">筛选</button></div>
		</form>
	</div>
	<?php
	if(!$box) {
	?>
	<div class="info"><div class="text">尚未绑定设备。</div></div>
	<?php
	} else {
	?>
	
	
	
	<div class="info"><div class="text">当前盒子数据共： <span><?php echo count($records); ?></span> 条</div></div>
	<ul>
		<?php
		for($i = 0; $i < count($records); $i++) {
		?>
		<li>
			<div class="time"><?php echo $records[$i]['measuretimes']; ?></div>
			<div class="money decrease"><?php echo $records[$i]['sugar']; ?> mmol/L</div>
		</li>
		<?php
		}
		?>
	</ul>
	<?php
	}
	?>
</div>
<?php
$this->load->view('include/footer');
?>