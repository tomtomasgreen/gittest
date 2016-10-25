<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('医生');
	
	$('#flip-watch').change(function() {
		var healthopen = $(this).prop('checked');
		$.post('./healthopen',
			{
				doctorid: <?php echo $doctor['id'] ? $doctor['id'] : 0; ?>,
				healthopen: healthopen
			},
			function(data) {
				if(data.result) {
					if(healthopen) {
						luiji_alert('success', '已打开健康监护！');
					} else {
						luiji_alert('success', '已关闭健康监护！');
					}
				} else {
					luiji_alert('error', '操作失败，待会再试');
				}
			},
			'json'
		);
	});
	
	$('#submit-del').click(function() {
		$.post('./unbind',
			{
				doctorid: <?php echo $doctor['id'] ? $doctor['id'] : 0; ?>
			},
			function(data) {
				if(data.result) {
					// luiji_alert('success', '删除成功！');
					alert('删除成功！');
					// window.setTimeout(function() {
						window.location = './index';
					// }, 1000);
				} else {
					luiji_alert('error', '删除失败，待会再试');
				}
			},
			'json'
		);
	});
	
	$('#submit-cancel').click(function() {
		$.post('./cancel',
			{
				doctorid: <?php echo $doctor_unaccepted['id'] ? $doctor_unaccepted['id'] : 0; ?>
			},
			function(data) {
				if(data.result) {
					// luiji_alert('success', '删除成功！');
					alert('取消成功！');
					// window.setTimeout(function() {
						window.location = './index';
					// }, 1000);
				} else {
					luiji_alert('error', '取消失败，待会再试');
				}
			},
			'json'
		);
	});
	
	$('#submit-check').click(function() {
		$.post('./bind_check',
			{
				doctorid: <?php echo $doctor_unchecked['id'] ? $doctor_unchecked['id'] : 0; ?>
			},
			function(data) {
				if(data.result) {
					// luiji_alert('success', '删除成功！');
					alert('添加成功！');
					// window.setTimeout(function() {
						window.location = './index';
					// }, 1000);
				} else {
					luiji_alert('error', '添加失败，待会再试');
				}
			},
			'json'
		);
	});
	$('#submit-uncheck').click(function() {
		$.post('./bind_uncheck',
			{
				doctorid: <?php echo $doctor_unchecked['id'] ? $doctor_unchecked['id'] : 0; ?>
			},
			function(data) {
				if(data.result) {
					// luiji_alert('success', '删除成功！');
					alert('拒绝成功！');
					// window.setTimeout(function() {
						window.location = './index';
					// }, 1000);
				} else {
					luiji_alert('error', '拒绝失败，待会再试');
				}
			},
			'json'
		);
	});
	
	$('#update-submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var ddes = $.trim($('#ddes').val());
		$.post('./update_ddes',
			{
				ddes: ddes,
				doctorid: <?php echo $doctor['id'] ? $doctor['id'] : 0; ?>
			}, function(data) {
				if(data.result >= 0) {
					window.location = './index';
				} else {
					alert('更新失败~');
					nn_enableButton(_btn, '提交');
				}
			},
			'json'
		);
	});
	<?php
	if($doctor) {
	?>
	window.setInterval(function() {
		$.post('./get_chat',
			{
				doctorid: <?php echo $doctor['id'] ? $doctor['id'] : 0; ?>
			}, function(data) {
				if(data.result > 0) {
					$('#chat-link').html('对话留言<span class="chats">' + data.result + '</span>');
				} else {
					$('#chat-link').html('对话留言');
				}
			},
			'json'
		);
	}, 5000);
	<?php
	}
	?>
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的医生" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的医生</h1>
	<a href="javascript:;" data-ajax="false" style="padding:0;margin:0;width:0;height:0;border:0;"></a>
	<?php
	if($doctor) {
	?>
	<a href="../chat/doctor/<?php echo $doctor['id']; ?>" data-icon="comment" data-ajax="false" id="chat-link">对话留言<?php if($chats) { ?><span class="chats"><?php echo count($chats); ?></span><?php } ?></a>
	<?php
	} else {
	?>
	<!--<a href="./add" data-icon="plus" data-ajax="false">添加医生</a>-->
	<?php
	}
	?>
</div>
<div id="doctor-index" class="gh-center">
	<?php
	if($doctor) {
	?>
	<div class="thumb"><img src="<?php echo $doctor['thumb'] ? nn_fix_uploadurl($doctor['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
	<div class="doctor-info">
		<div class="des f-cb"><div class="des-label f-fl">医生备注：</div><div class="des-text f-fr"><?php echo $doctor['ddes']; ?>
			<?php
			if($doctor['ddes']) {
			?>
			<a href="#popupUname" data-rel="popup" data-position-to="window" data-transition="pop">[修改]</a>
			<?php
			} else {
			?>
			<a href="#popupUname" data-rel="popup" data-position-to="window" data-transition="pop">[添加]</a>
			<?php
			}
			?>
		</div></div>
		<div class="des f-cb"><div class="des-label f-fl">医生姓名：</div><div class="des-text f-fr"><?php echo $doctor['username']; ?></div></div>
		<div class="des f-cb"><div class="des-label f-fl">医院：</div><div class="des-text f-fr"><?php echo $doctor['hospital']; ?></div></div>
		<div class="des f-cb"><div class="des-label f-fl">科室：</div><div class="des-text f-fr"><?php echo $doctor['department']; ?></div></div>
		<div class="time f-cb"><div class="des-label f-fl">添加时间：</div><div class="des-text f-fr"><?php echo date('Y-m-d H:i', $doctor['bindtime']); ?></div></div>
	</div>
	<!--
	<div class="switch">
		<label for="flip-watch">健康监护</label>
		<input type="checkbox" data-role="flipswitch" name="flip-watch" id="flip-watch" data-on-text="打开" data-off-text="关闭" data-wrapper-class="custom-size-flipswitch" <?php echo $doctor['healthopen'] ? 'checked="checked"' : ''; ?>/>
	</div>
	-->
	<div class="controls" style="padding:14px 10px;"><a class="ui-btn ui-btn-d ui-btn-corner-all" href="#popupUnbind" data-rel="popup" data-position-to="window" data-transition="pop">删除医生</a></div>
	<?php
	} else if($doctor_unchecked) {
	?>
	<div class="thumb"><img src="<?php echo $doctor_unchecked['thumb'] ? nn_fix_uploadurl($doctor_unchecked['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
	<div class="doctor-info">
		<div class="des f-cb"><div class="des-label f-fl">医生姓名：</div><div class="des-text f-fr"><?php echo $doctor_unchecked['username']; ?></div></div>
		<div class="des f-cb"><div class="des-label f-fl">医院：</div><div class="des-text f-fr"><?php echo $doctor_unchecked['hospital']; ?></div></div>
		<div class="des f-cb"><div class="des-label f-fl">科室：</div><div class="des-text f-fr"><?php echo $doctor_unchecked['department']; ?></div></div>
		<div class="time f-cb"><div class="des-label f-fl">添加时间：</div><div class="des-text f-fr"><?php echo date('Y-m-d H:i', $doctor_unchecked['bindtime']); ?></div></div>
	</div>
	<div class="controls" style="padding:14px 10px 0;"><a class="ui-btn ui-btn-b ui-btn-corner-all" href="#popupBindcheck" data-rel="popup" data-position-to="window" data-transition="pop">通过邀请</a></div>
	<div class="controls" style="padding:10px 10px;"><a class="ui-btn ui-btn-d ui-btn-corner-all" href="#popupBinduncheck" data-rel="popup" data-position-to="window" data-transition="pop">拒绝邀请</a></div>
	<?php
	} else if($doctor_unaccepted) {
	?>
	<div class="thumb"><img src="<?php echo $doctor_unaccepted['thumb'] ? nn_fix_uploadurl($doctor_unaccepted['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
	<div class="doctor-info">
		<div class="des f-cb"><div class="des-label f-fl">医生姓名：</div><div class="des-text f-fr"><?php echo $doctor_unaccepted['username']; ?></div></div>
		<div class="des f-cb"><div class="des-label f-fl">医生备注：</div><div class="des-text f-fr"><?php echo $doctor_unaccepted['ddes']; ?></div></div>
		<div class="des f-cb"><div class="des-label f-fl">医院：</div><div class="des-text f-fr"><?php echo $doctor_unaccepted['hospital']; ?></div></div>
		<div class="des f-cb"><div class="des-label f-fl">科室：</div><div class="des-text f-fr"><?php echo $doctor_unaccepted['department']; ?></div></div>
		<div class="time f-cb"><div class="des-label f-fl">添加时间：</div><div class="des-text f-fr"><?php echo date('Y-m-d H:i', $doctor_unaccepted['bindtime']); ?></div></div>
	</div>
	<!--<div class="controls" style="padding:14px 10px 0;"><a class="ui-btn ui-btn-b ui-btn-corner-all" href="javascript:;">等待医生通过</a></div>-->
	<div class="controls" style="padding:10px 10px;"><a class="ui-btn ui-btn-d ui-btn-corner-all" href="#popupCancel" data-rel="popup" data-position-to="window" data-transition="pop">取消该申请</a></div>
	<?php
	} else {
	?>
	<div class="thumb"><img src="/guanhuai/public/images/user-nophoto.jpg"/></div>
	<div class="doctor-info">
		<div class="error">尚未添加医生，请先添加医生</div>
	</div>
	<div class="controls" style="padding:14px 10px;"><a data-ajax="false" class="ui-btn ui-btn-b ui-btn-corner-all" href="./add">添加医生</a></div>
	<?php
	}
	?>
</div>

<div data-role="popup" id="popupUname" data-theme="b" data-overlay-theme="b">
	<div style="padding:10px 20px;">
		<h3>输入备注名</h3>
		<label for="ddes" class="ui-hidden-accessible">备注名：</label>
		<input type="text" name="ddes" id="ddes" placeholder="输入备注名" value="<?php echo $doctor['ddes']; ?>"/>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" id="update-submit">更新</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b f-br6" data-rel="back" data-transition="flow" id="update-cancel">取消</a>
	</div>
</div>
<div data-role="popup" id="popupUnbind" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定删除</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定删除该医生？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="submit-del">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<div data-role="popup" id="popupCancel" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确定取消</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定取消该申请？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="submit-cancel">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<div data-role="popup" id="popupBindcheck" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确认添加</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定添加该医生？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="submit-check">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<div data-role="popup" id="popupBinduncheck" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确认拒绝</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定拒绝该医生？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="submit-uncheck">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>

<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>