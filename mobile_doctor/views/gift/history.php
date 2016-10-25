<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('我的');
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="兑换历史" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>兑换历史</h1>
	<a href="../collect/card" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="gift-home" class="gh-center">

	<ul>
		<?php
		for($i = 0; $i < count($cards); $i++) {
			if(!$cards[$i]['usedtime']) {
		?>
		<li class="f-cb">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/collect-card.jpg"/></div>
			<div class="text f-fr">
				<h3>40题智库邀请函</h3>
				<div class="info sn"><?php echo $cards[$i]['sn']; ?></div>
				<div class="info">兑换时间</div>
				<div class="info"><?php echo date('Y-m-d H:i', $cards[$i]['createtime']); ?></div>
			</div>
		</li>
		<?php
			}
		}
		?>
		<?php
		for($i = 0; $i < count($packages); $i++) {
			if(!$packages[$i]['usedtime']) {
		?>
		<li class="f-cb">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/package-card.jpg"/></div>
			<div class="text f-fr">
				<h3>学术大礼包</h3>
				<div class="info sn"><?php echo $packages[$i]['sn']; ?></div>
				<div class="info">兑换时间</div>
				<div class="info"><?php echo date('Y-m-d H:i', $packages[$i]['createtime']); ?></div>
			</div>
		</li>
		<?php
			}
		}
		?>
	</ul>
	<h3>已使用</h3>
	<ul>
		<?php
		for($i = 0; $i < count($cards); $i++) {
			if($cards[$i]['usedtime']) {
		?>
		<li class="f-cb not-enough">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/collect-card.jpg"/></div>
			<div class="text f-fr">
				<h3>40题智库邀请函</h3>
				<div class="info sn"><?php echo $cards[$i]['sn']; ?></div>
				<div class="info">兑换时间</div>
				<div class="info"><?php echo date('Y-m-d H:i', $cards[$i]['createtime']); ?></div>
				<div class="info">使用时间</div>
				<div class="info"><?php echo date('Y-m-d H:i', $cards[$i]['usedtime']); ?></div>
			</div>
		</li>
		<?php
			}
		}
		?>
		<?php
		for($i = 0; $i < count($packages); $i++) {
			if($packages[$i]['usedtime']) {
		?>
		<li class="f-cb not-enough">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/package-card.jpg"/></div>
			<div class="text f-fr">
				<h3>学术大礼包</h3>
				<div class="info sn"><?php echo $packages[$i]['sn']; ?></div>
				<div class="info">兑换时间</div>
				<div class="info"><?php echo date('Y-m-d H:i', $packages[$i]['createtime']); ?></div>
				<div class="info">使用时间</div>
				<div class="info"><?php echo date('Y-m-d H:i', $packages[$i]['usedtime']); ?></div>
			</div>
		</li>
		<?php
			}
		}
		?>
	</ul>
	
</div>

<?php
$this->load->view('include/footer');
?>