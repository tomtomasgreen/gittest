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
	active_navbar('问答');
	
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
			content = $.trim($('#content').val()),
			photos = ''
		;
		if(content == '') {
			luiji_alert('error', '请填写问题描述！');
			nn_enableButton(_btn, '提交问题');
			return false;
		} else {
			$.post('./create',
				{
					title		: title,
					content		: content,
					photos		: photos
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '保存成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>question/index';
						}, 1000);
					} else {
						nn_enableButton(_btn, '提交问题');
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
#create-panel ul{padding:0;margin:0;}
#create-panel ul li{list-style:none;padding:10px 0;margin-bottom:10px;border-bottom:1px solid #f3f3f3;}
#create-panel ul li a{display:block;color:#666;text-decoration:none;font-weight:normal;}
#create-panel ul li h3{padding:6px 0;margin:0;font-size:16px;}
#create-panel ul li .des{padding-bottom:10px;font-size:14px;color:#999;}
#create-panel ul li .info{font-size:10px;color:#999;}
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我要提问" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我要提问</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="question-create" class="gh-center">

		<div class="form">
			<!--
			<div class="form-item">
				<label for="title">标题：</label>
				<input type="text" name="title" id="title"/>
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
			-->
			<div class="form-item">
				<label for="content ">问题描述（500字以内）：</label>
				<textarea name="content" id="content" placeholder="问题描述"></textarea>
			</div>
			<div class="ui-field-contain">
				<button class="ui-btn ui-icon-mail ui-btn-icon-left ui-shadow ui-corner-all ui-btn-inline" id="submit">提交问题</button>
			</div>
		</div>
		<div id="create-panel">
			<h3>我的提问</h3>
			<ul>
				<?php
				for($i = 0; $i < count($myquestions); $i++) {
				?>
				<li>
					<a href="./show/<?php echo $myquestions[$i]['id']; ?>" data-ajax="false" class="f-cb">
						<div class="des"><?php echo $myquestions[$i]['content']; ?></div>
						<div class="info f-cb">
							<div class="time f-fl"><?php echo date('Y-m-d H:i', $myquestions[$i]['createtime']); ?></div>
							<div class="answers f-fr"><?php echo $myquestions[$i]['answers']; ?>个回答</div>
						</div>
					</a>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
		
</div>

<!-- search-panel -->
<?php
$this->load->view('include/footer');
?>