<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var sn = $.trim($('#sn').val()),
			doctorname = '',
			doctordes = $.trim($('#doctordes').val())
		;
		if(!is_doctor_sn(sn)) {
			luiji_alert('error', '请输入正确的医生编号');
			nn_enableButton(_btn, '添加');
			return false;
		}
		// else if (doctordes == '') {
			// luiji_alert('error', '请输入有效的医生备注');
			// nn_enableButton(_btn, '添加');
			// return false;
		// }
		else {
			$.post('./bind',
				{
					sn: sn,
					doctorname: doctorname,
					doctordes: doctordes
				},
				function(data) {
					if(data.result > 0) {
						luiji_alert('success', '添加成功，等待医生通过！');
						window.setTimeout(function() {
							window.location = './index';
						}, 1000);
					} else if(data.result == -1) {
						luiji_alert('error', '该编号医生不存在');
						nn_enableButton(_btn, '添加');
						return false;
					} else {
						luiji_alert('error', '添加失败，待会再试');
						nn_enableButton(_btn, '添加');
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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="添加医生" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>添加医生</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="doctor-add" class="gh-center">
	
	<div class="form">
		<div class="form-item">
			<label for="sn">医生编号：<!--<a href="javascript:;" id="qrcode-btn" class="ui-btn ui-btn-inline ui-icon-camera ui-btn-icon-left">扫描二维码</a>--></label>
			<input type="text" name="sn" id="sn" placeholder="必填"/>
		</div>
		<div class="form-item">
			<label for="doctordes">医生备注：</label>
			<input type="text" name="doctordes" id="doctordes" placeholder="选填"/>
		</div>
		<div class="ui-field-contain">
			<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">添加</button>
		</div>
	</div>
	
</div>


<?php
$this->load->view('include/footer');
?>