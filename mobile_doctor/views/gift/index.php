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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="积分兑换" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>积分兑换</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
	<a href="../my/money" data-icon="calendar" data-ajax="false">积分明细</a>
</div>
<div id="gift-list" class="gh-center">

	<div class="info"><div class="text">当前积分总额： <span>300</span> 分，<a href="../my/money" data-ajax="false">[ 查看明细 ]</a></div></div>
	<ul>
		<li class="f-cb">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/question-3.jpg"/></div>
			<div class="text f-fr">
				<h3>30题答题卡</h3>
				<h3 class="cost">100积分</h3>
				<a class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-shop ui-btn-icon-left ui-btn-b ui-mini" href="#popupBuy" data-rel="popup" data-position-to="window" data-transition="pop">立即兑换</a>
			</div>
		</li>
		<li class="f-cb not-enough">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/question-3.jpg"/></div>
			<div class="text f-fr">
				<h3>小米移动电源（10000mAh）</h3>
				<h3 class="cost">500积分</h3>
				<a href="javascript:;" disabled="disabled" class="ui-btn ui-state-disabled ui-corner-all ui-shadow ui-btn-inline ui-icon-shop ui-btn-icon-left ui-btn-b ui-mini">积分不足</a>
			</div>
		</li>
	</ul>
	
</div>

<div data-role="popup" id="popupBuy" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定兑换</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定兑换此件礼品？</h3>
		<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">确定</a>
		<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>