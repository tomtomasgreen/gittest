<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<link rel="stylesheet" href="<?php echo site_url(); ?>public/js/uploadifive/uploadifive-mobile.css">
<script src="<?php echo site_url(); ?>public/js/uploadifive/jquery.uploadifive-mobile.min.js"></script>
<script type="text/javascript">
$(function() {
	var data_photo = false, data_photos = [];
	$('#uploader-photos').uploadifive({
		'auto'				: true,
		'formData'			: 
							{
								'timestamp'	: '<?php echo $timestamp;?>',
								'token'		: '<?php echo md5('nnguanhuai' . $timestamp);?>',
								'file'		: 'image'
							},
		'buttonText'		: '+ 选 择 照 片',
		'fileSizeLimit'   	: '51200kb',
		'queueID'			: 'uploader-queue-photos',
		'uploadScript'		: '<?php echo site_url(); ?>public/js/uploadifive/uploadifive.php',
		'removeCompleted'	: true,
		'onUploadComplete'	: function(file, data) {
			data_photo = data;
			$('<div class="thumb-item"><img src="' + data_photo + '"/></div>').appendTo($('#photos-box'));
			data_photos.push(data_photo);
			$('#photos').val(data_photos.join(';'));
		}
	});
	$('.uploader-preview').delegate('.thumb-item', 'click', function() {
		var
			item = $(this),
			img = item.find('img'),
			src = img.attr('src')
		;
		for(i = 0; i < data_photos.length; i++) {
			if(data_photos[i] == src) {
				data_photos.splice(i ,1);
				break;
			}
		}
		item.remove();
		$('#photos').val(data_photos.join(';'));
	});
	
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var title = '',
			missiondate = $.trim($('#missiondate').val()),
			missiontime = $.trim($('#missiontime').val()),
			content = $.trim($('#content').val()),
			photos = $.trim($('#photos').val())
		;
		if(content == '') {
			luiji_alert('error', '请填写任务描述！');
			nn_enableButton(_btn, '保存任务');
			return false;
		} else if(missiondate == '' || missiontime == '') {
			luiji_alert('error', '请选择任务时间！');
			nn_enableButton(_btn, '保存任务');
			return false;
		} else {
			$.post('./create',
				{
					title		: title,
					content		: content,
					missiondate	: missiondate,
					missiontime	: missiontime,
					photos		: photos
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>task/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '保存任务');
						luiji_alert('error', '保存失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
});
</script>
<style type="text/css">
.uploader-box{width:100%;border:0;}
.uploader-preview{margin-bottom:8px;width:100%;}
.uploader-preview .thumb-item{float:left;margin-right:1%;width:32%;}
.uploader-preview .thumb-item img{width:100%;height:auto;}
.uploader-queue{width:100%;}
.uploader-helper{color:#0088cc;}
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="添加待办" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>添加待办</h1>
	<a href="../task/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="task-create" class="gh-center">

		<div class="form">
			<div class="form-item">
				<label for="missiondate">任务时间：</label>
				<div class="datetime f-cb">
					<div class="datetime-item-1 f-fl"><input type="date" name="missiondate" id="missiondate" value="<?php echo date('Y-m-d', $timestamp + 60 * 60 * 24); ?>"/></div>
					<div class="datetime-item-2 f-fr"><input type="time" name="missiontime" id="missiontime" value="<?php echo date('H', $timestamp) . ':00'; ?>"/></div>
				</div>
			</div>
			<div class="form-item">
				<label for="photos">上传图片（最多三张，点击照片删除）：</label>
				<div class="uploader-preview f-cb" id="photos-box"></div>
				<div class="uploader-box">
					<input type="file" name="uploader-photos" class="uploader" id="uploader-photos"/>
					<input type="hidden" id="photos" name="photos" value=""/>
				</div>
				<div class="uploader-queue" id="uploader-queue-photos"></div>
			</div>
			<div class="form-item">
				<label for="content">任务描述（500字以内）：</label>
				<textarea name="content" id="content" placeholder="任务描述"></textarea>
			</div>
			<div class="ui-field-contain">
				<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">保存任务</button>
			</div>
		</div>

</div>

<?php
$this->load->view('include/footer');
?>