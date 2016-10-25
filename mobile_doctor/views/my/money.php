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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的积分" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的积分</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="my-money" class="gh-center">
	
	<div class="info"><div class="text">当前积分<span><?php echo $doctor['money']; ?></span></div></div>
	<div class="info"><a data-ajax="false" href="../collect/card" class="ui-btn ui-btn-inline">兑换义诊券</a></div>
	<ul>
		<?php
		for($i = 0; $i < count($logs); $i++) {
		?>
		<li class="f-cb">
			<div class="item-l f-fl">
				<div class="des"><?php echo $logs[$i]['way']; ?></div>
				<div class="time"><?php echo date('Y-m-d H:i', $logs[$i]['createtime']); ?></div>
			</div>
			<div class="item-r f-fr">
				<div class="money <?php echo strtolower($logs[$i]['type']); ?>"><?php echo ($logs[$i]['type'] == 'INCREASE' ? '+' : '-') . $logs[$i]['score']; ?></div>
			</div>
		</li>
		<?php
		}
		?>
	</ul>
	
</div>

<?php
$this->load->view('include/footer');
?>