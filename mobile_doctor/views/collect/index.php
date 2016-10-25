<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	var cardid = 0;
	$('.collect-cost').click(function() {
		cardid = $(this).data('cardid');
	});
	$('#collect-generate').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在生成题库...');
		window.setTimeout(function() {
			$.post('./generate',
				{
					cardid: cardid
				}, function(data) {
					if(data.result > 0) {
						window.location = './play/' + data.result;
					} else if(data.result == -1) {
						alert('题库中题目不够~~/(ㄒoㄒ)/~~');
						nn_enableButton(_btn, '确定');
					} else if(data.result == -2) {
						alert('最近30天已经参与过义诊');
						nn_enableButton(_btn, '确定');
					} else if(data.result == -3) {
						alert('一年内只能参与4次义诊哦~');
						nn_enableButton(_btn, '确定');
					} else {
						alert('生成失败，稍后再试~');
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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="糖友智库" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>糖友智库</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
	<a href="./history" data-icon="clock" data-ajax="false">历史</a>
</div>
<div id="collect-home" class="gh-center">
	<?php
	if($collect_not_finished) {
	?>
	<div class="cards-info error"><div class="text">有未完成题集，<a href="./play/<?php echo $collect_not_finished['id']; ?>" data-ajax="false">[ 点此继续答题 ]</a></div></div>
	<?php
	}
	?>
	
	
	
	
	
	
	
	
	<?php
	if($card) {
	?>
	<ul>
		<?php
		if($collect_not_finished) {
		?>
		<li class="not-enough">
			<div class="my-info"><div class="text">我的智库邀请函</div></div>
			<div class="card-item f-cb">
				<div class="thumb f-fl"><img src="/guanhuai/public/images/collect-card.jpg"/></div>
				<div class="text f-fr">
					<h3>40题智库邀请函</h3>
					<div class="buy-time">兑换时间：<br /><?php echo date('Y-m-d H:i', $card['createtime']); ?></div>
					<a href="javascript:;" disabled="disabled" class="ui-btn ui-state-disabled ui-corner-all ui-shadow ui-btn-inline ui-icon-clock ui-btn-icon-left ui-btn-b ui-mini f-br6">有未完成题集</a>
				</div>
			</div>
		</li>
		<?php
		} else {
		?>
		<li>
			<div class="my-info"><div class="text">我的智库邀请函</div></div>
			<div class="card-item f-cb">
				<div class="thumb f-fl"><img src="/guanhuai/public/images/collect-card.jpg"/></div>
				<div class="text f-fr">
					<h3>40题智库邀请函</h3>
					<div class="buy-time">兑换时间：<br /><?php echo date('Y-m-d H:i', $card['createtime']); ?></div>
					<?php
					if(!in_array($doctor['province'], config_item('blacklist_collect_province')) || in_array($doctor['mobile'], config_item('whitelist_collect_doctor'))) {
					?>
					<a class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-clock ui-btn-icon-left ui-btn-b ui-mini collect-cost f-br6" href="#popupBuy" data-rel="popup" data-position-to="window" data-transition="pop" data-type="30" data-cardid="<?php echo $card['id']; ?>">立即开始</a>
					<?php
					} else {
					?>
					<a href="javascript:;" disabled="disabled" class="ui-btn ui-state-disabled ui-corner-all ui-shadow ui-btn-inline ui-icon-clock ui-btn-icon-left ui-btn-b ui-mini f-br6">智库暂时关闭</a>
					<?php
					}
					?>
				</div>
			</div>
		</li>
		<?php
		}
		?>
	</ul>
	<?php
	} else {
	?>
	<ul>
		<li>
			<div class="my-info"><div class="text">我的智库邀请函</div></div>
			<div class="card-item f-cb">
				<div class="cards-info"><div class="text" style="width:88%;">我还没有智库邀请函<a href="../collect/card" data-ajax="false">[ 去兑换 ]</a></div></div>
			</div>
		</li>
	</ul>
	<?php
	}
	?>
	
</div>

<div data-role="popup" id="popupBuy" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定开始</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">使用此智库邀请函开始答题？</h3>
		<h4 style="color:#f33;"></h4>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" id="collect-generate">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" data-rel="back" data-transition="flow" id="collect-cancel">返回</a>
	</div>
</div>
<?php
$this->load->view('include/footer');
?>