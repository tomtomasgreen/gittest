<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('问答');
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我要答题" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我要答题</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
	<a href="../gift/index" data-icon="shop" data-ajax="false">兑换答题卡</a>
</div>
<div id="play-list" class="gh-center">

	<div class="info"><div class="text">有未完成题集，<a href="./collect/1" data-ajax="false">[ 点此继续答题 ]</a></div></div>
	<ul>
		<li class="f-cb">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/question-3.jpg"/></div>
			<div class="text f-fr">
				<h3>30题答题卡</h3>
				<h3 class="cost">2015-12-23</h3>
				<a class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-clock ui-btn-icon-left ui-btn-b ui-mini" href="#popupBuy" data-rel="popup" data-position-to="window" data-transition="pop">立即使用</a>
			</div>
		</li>
		<li class="f-cb not-enough">
			<div class="thumb f-fl"><img src="/guanhuai/public/images/question-3.jpg"/></div>
			<div class="text f-fr">
				<h3>50题答题卡</h3>
				<h3 class="cost">2015-12-22</h3>
				<a href="javascript:;" disabled="disabled" class="ui-btn ui-state-disabled ui-corner-all ui-shadow ui-btn-inline ui-icon-clock ui-btn-icon-left ui-btn-b ui-mini">立即使用</a>
			</div>
		</li>
	</ul>
	
</div>

<div data-role="popup" id="popupBuy" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定使用</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定使用此张答题卡？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b">确定</button>
		<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<?php
$this->load->view('include/footer');
?>