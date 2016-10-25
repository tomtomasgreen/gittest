<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="系统通知" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>系统通知</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="task-list" class="gh-center">
	<?php
	if(!$notices_unread && !$notices_read) {
	?>
	<div class="alert">暂时没有任何系统通知~</div>
	<?php
	} else {
	?>
	<h3 style="margin:0 0 8px;padding-left:10px;font-size:16px;font-weight:bold;">新通知</h3>
	<ul class="unread">
		<?php
		for($i = 0; $i < count($notices_unread); $i++) {
		?>
		<li>
			<div class="task-item">
				<div class="des"><?php echo $notices_unread[$i]['content']; ?></div>
				<div class="info f-cb">
					<div class="time f-fr"><?php echo date('Y-m-d H:i', $notices_unread[$i]['createtime']); ?></div>
				</div>
			</div>
		</li>
		<?php
		}
		?>
	</ul>
	<?php
	if(!$notices_unread) {
	?>
	<div class="alert" style="text-align:left;padding:0 0 20px 20px;">暂无~</div>
	<?php
	}
	?>
	
	<h3 style="margin:0 0 8px;padding-left:10px;font-size:16px;font-weight:bold;">已读通知</h3>
	<ul class="read" style="opacity:.7;">
		<?php
		for($i = 0; $i < count($notices_read); $i++) {
		?>
		<li>
			<div class="task-item">
				<div class="des"><?php echo $notices_read[$i]['content']; ?></div>
				<div class="info f-cb">
					<div class="time f-fr"><?php echo date('Y-m-d H:i', $notices_read[$i]['createtime']); ?></div>
				</div>
			</div>
		</li>
		<?php
		}
		?>
	</ul>
	<?php
	if(!$notices_read) {
	?>
	<div class="alert" style="text-align:left;">暂无~</div>
	<?php
	}
	}
	?>
</div>

<?php
$this->load->view('include/footer');
?>