<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('待办');
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="待办" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>待办</h1>
	<a href="javascript:;" data-ajax="false" style="padding:0;margin:0;width:0;height:0;border:0;"></a>
	<a href="../notice/index" data-icon="audio" data-ajax="false">系统通知</a>
</div>
<div id="task-list" class="gh-center">
	
	<div class="calendar">
		<div class="calendar-label"><a data-ajax="false" href="../calendar/edit">编辑</a></div>
		<div class="calendar-body">
			<div class="cal-time"><?php echo date('m月d日', $week_start); ?> —— <?php echo date('m月d日', $week_end); ?></div>
			<div class="cal-th f-cb">
				<div class="cal-td f-fl first"></div>
				<div class="cal-td f-fl">一</div>
				<div class="cal-td f-fl">二</div>
				<div class="cal-td f-fl">三</div>
				<div class="cal-td f-fl">四</div>
				<div class="cal-td f-fl">五</div>
				<div class="cal-td f-fl">六</div>
				<div class="cal-td f-fl">日</div>
			</div>
			<div class="cal-tr f-cb">
				<div class="cal-td f-fl first">上午</div>
				<?php
				for($i = 0; $i < 7; $i++) {
				?>
				<div class="cal-td f-fl"><?php echo $jobs[$i]['am']; ?></div>
				<?php
				}
				?>
			</div>
			<div class="cal-tr f-cb">
				<div class="cal-td f-fl first">下午</div>
				<?php
				for($i = 0; $i < 7; $i++) {
				?>
				<div class="cal-td f-fl"><?php echo $jobs[$i]['pm']; ?></div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
	
	<div class="mission">
		<div class="mission-label f-cb"><a data-ajax="false" href="../mission/create">添加</a></div>
		<?php
		if(!$missions) {
		?>
		<div class="alert-info" style="padding-top:100px;text-align:center;color:#f33;">还未添加任何待办事项~</div>
		<?php
		} else {
		?>
		<ul style="padding-top:10px;">
			<?php
			for($i = 0; $i < count($missions); $i++) {
			?>
			<li>
				<div class="task-item">
					<h3><?php echo $missions[$i]['content']; ?></h3>
					<?php
						if($missions[$i]['photos']) {
							$photos = $missions[$i]['photos'];
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
					<div class="info f-cb">
						<div class="time f-fr"><?php echo date('Y-m-d H:i', $missions[$i]['missiontime']); ?></div>
					</div>
				</div>
			</li>
			<?php
			}
			?>
		</ul>
		<?php
		}
		?>
	</div>
</div>

<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>