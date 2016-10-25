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
	<a href="../task/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="task-list" class="gh-center">
	
	<ul>
		<?php
		for($i = 0; $i < count($notices); $i++) {
		?>
		<li>
			<div class="task-item">
				<div class="des"><?php echo $notices[$i]['content']; ?></div>
				<div class="info f-cb">
					<div class="time f-fr"><?php echo date('Y-m-d H:i', $notices[$i]['createtime']); ?></div>
				</div>
			</div>
		</li>
		<?php
		}
		?>
	</ul>
	<?php
	if(!$notices) {
	?>
	<div class="alert">暂时没有任何系统通知~</div>
	<?php
	}
	?>
</div>

<?php
$this->load->view('include/footer');
?>