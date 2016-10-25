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
	
	$('#submit-del').click(function() {
		$.post('./unbind',
			{
				sn: <?php echo $box['sn'] ? $box['sn'] : 0; ?>
			},
			function(data) {
				if(data.result) {
					// luiji_alert('success', '删除成功！');
					alert('解绑成功！');
					// window.setTimeout(function() {
						window.location = './';
					// }, 1000);
				} else {
					luiji_alert('error', '解绑失败，待会再试');
				}
			},
			'json'
		);
	});
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的设备" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的设备</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="box-home" class="gh-center">
	
	<div class="box-photo"><img src="<?php echo base_url(); ?>public/images/miobox.jpg"/></div>
	<?php
	if($box) {
	?>
	<div class="bind-ok">您已经绑定了设备<br />SN：<?php echo $box['sn']; ?></div>
	<div class="controls"><a class="ui-btn ui-btn-d ui-btn-corner-all" href="#popupUnbind" data-rel="popup" data-position-to="window" data-transition="pop">解除绑定</a></div>
	<?php
	} else {
	?>
	<div class="bind-not">您还没有绑定设备</div>
	<div class="controls"><a data-ajax="false" class="ui-btn ui-btn-corner-all" href="./add">绑定设备</a></div>
	<?php
	}
	?>
</div>

<div data-role="popup" id="popupUnbind" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定解绑</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定解绑该设备？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-btn-corner-all" id="submit-del">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-btn-corner-all" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>