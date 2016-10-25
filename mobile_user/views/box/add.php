<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	// active_navbar('医生');
	
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var sn = $.trim($('#sn').val());
		if(!is_sn(sn)) {
			luiji_alert('error', '请输入正确的设备SN号');
			nn_enableButton(_btn, '绑定');
			return false;
		} else {
			$.post('./bind',
				{
					sn: sn
				},
				function(data) {
					console.log(data);
					if(data.result > 0) {
						luiji_alert('success', '绑定成功！');
						window.setTimeout(function() {
							window.location = './';
						}, 1000);
					} else if(data.result == -1) {
						luiji_alert('error', '设备SN号不存在或已被绑定');
						nn_enableButton(_btn, '绑定');
						return false;
					} else {
						luiji_alert('error', '绑定失败，待会再试');
						nn_enableButton(_btn, '绑定');
						return false;
					}
				},
				'json'
			);
		}
	});
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="绑定设备" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>绑定设备</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="box-add" class="gh-center">
	
	<div class="form">
		<div class="form-item">
			<label for="sn">设备SN：<!--<a href="javascript:;" id="qrcode-btn" class="ui-btn ui-btn-inline ui-icon-camera ui-btn-icon-left">扫描二维码</a>--></label>
			<input type="text" name="sn" id="sn"/>
		</div>
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">绑定</button>
		</div>
	</div>
	
</div>


<?php
$this->load->view('include/footer');
?>