<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	$('#collect-generate').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在兑换...');
		window.setTimeout(function() {
			$.post('./generate_card',
				{
					
				}, function(data) {
					if(data.result > 0) {
						alert('兑换成功！');
						window.location = '../collect/index';
					} else if(data.result == -1) {
						alert('尚有未使用智库邀请函，无需再次兑换~');
						nn_enableButton(_btn, '确定');
					} else {
						alert('兑换失败，稍后再试~');
						nn_enableButton(_btn, '确定');
					}
				},
				'json'
			);
		}, 600);
	});
	$('#package-buy').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在兑换...');
		window.setTimeout(function() {
			$.post('./package_buy',
				{
					
				}, function(data) {
					if(data.result > 0) {
						alert('兑换成功！');
						window.location = '../gift/history';
					} else {
						alert('兑换失败，稍后再试~');
						nn_enableButton(_btn, '确定');
					}
				},
				'json'
			);
		}, 600);
	});
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="兑换中心" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>兑换中心</h1>
	<!--<a href="../my/money" data-icon="back" data-ajax="false">返回</a>-->
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
	<a href="../gift/history" data-icon="clock" data-ajax="false">历史</a>
</div>
<div id="collectcard-list" class="gh-center">
	<div class="info"><div class="text">当前积分总额： <span><?php echo $doctor['money']; ?></span> 分<!--<a href="../my/money" data-ajax="false">[ 查看明细 ]</a>--></div></div>
	<ul>
		<?php
		if($doctor['money'] >= config_item('collect_cost')) {
		?>
		<li class="f-cb">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/collect-card.jpg"/></div>
			<div class="text f-fr">
				<h3>40题智库邀请函<br /> <span>（<?php echo config_item('collect_cost'); ?>积分）</span></h3>
				<a class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-mini collect-cost f-br6" href="#popupBuy" data-rel="popup" data-position-to="window" data-transition="pop" data-type="30">我要兑换</a>
			</div>
		</li>
		<?php
		} else {
		?>
		<li class="f-cb not-enough">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/collect-card.jpg"/></div>
			<div class="text f-fr">
				<h3>40题智库邀请函<br /> <span>（<?php echo config_item('collect_cost'); ?>积分）</span></h3>
				<a href="javascript:;" disabled="disabled" class="ui-btn ui-state-disabled ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-mini f-br6">积分不足</a>
			</div>
		</li>
		<?php
		}
		?>
		<!--
		<?php
		if($doctor['money'] >= config_item('package_cost')) {
		?>
		<li class="f-cb">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/package-card.jpg"/></div>
			<div class="text f-fr">
				<h3>学术大礼包<br /> <span>（<?php echo config_item('package_cost'); ?>积分）</span></h3>
				<a class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-mini collect-cost f-br6" href="#popupBuyPackage" data-rel="popup" data-position-to="window" data-transition="pop" data-type="30">我要兑换</a>
			</div>
		</li>
		<?php
		} else {
		?>
		<li class="f-cb not-enough">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/package-card.jpg"/></div>
			<div class="text f-fr">
				<h3>学术大礼包<br /> <span>（<?php echo config_item('package_cost'); ?>积分）</span></h3>
				<a href="javascript:;" disabled="disabled" class="ui-btn ui-state-disabled ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-mini f-br6">积分不足</a>
			</div>
		</li>
		<?php
		}
		?>
		-->
	</ul>
	
</div>

<div data-role="popup" id="popupBuy" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定兑换</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定使用<?php echo config_item('collect_cost'); ?>积分兑换一张智库邀请函？</h3>
		<h4 style="color:#f33;"></h4>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" id="collect-generate">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" data-rel="back" data-transition="flow" id="collect-cancel">返回</a>
	</div>
</div>

<div data-role="popup" id="popupBuyPackage" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定兑换</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定使用<?php echo config_item('package_cost'); ?>积分兑换一份学术大礼包？</h3>
		<h4 style="color:#f33;"></h4>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" id="package-buy">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" data-rel="back" data-transition="flow" id="package-cancel">返回</a>
	</div>
</div>
<?php
$this->load->view('include/footer');
?>