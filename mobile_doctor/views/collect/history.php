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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="义诊历史" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>义诊历史</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="collect-history" class="gh-center">

	<div class="my-info"><div class="text">共参与义诊： <span><?php echo count($collects1); ?></span> 次</div></div>
	<ul>
		<?php
		for($i = 0; $i < count($collects1); $i++) {
		?>
		<li>
			<a data-ajax="false" href="./detail/<?php echo $collects1[$i]['id']; ?>">
				<div class="info-time">开始时间：<?php echo date('Y-m-d H:i', $collects1[$i]['createtime']); ?></div>
				<div class="info-time">提交时间：<?php echo date('Y-m-d H:i', $collects1[$i]['submittime']); ?></div>
			</a>
		</li>
		<?php
		}
		?>
	</ul>
	<div class="my-info timeout"><div class="text">已过期： <span><?php echo count($collects2); ?></span> 次</div></div>
	<ul>
		<?php
		for($i = 0; $i < count($collects2); $i++) {
		?>
		<li class="not-enough">
			<a data-ajax="false" href="javascript:;">
				<div class="info-time">开始时间：<?php echo date('Y-m-d H:i', $collects2[$i]['createtime']); ?></div>
			</a>
		</li>
		<?php
		}
		?>
	</ul>
	
</div>

<?php
$this->load->view('include/footer');
?>