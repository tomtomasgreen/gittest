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
	
	$('#create-submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var content = $.trim($('#content').val());
		if(content == '') {
			luiji_alert('error', '请输入问题描述');
			nn_enableButton(_btn, '提交问题');
			return false;
		} else {
			$.post('./create',
				{
					title		: '',
					content		: content,
					photos		: ''
				}, function(data) {
					if(data.result > 0) {
						luiji_alert('success', '提交成功！');
						window.setTimeout(function() {
							window.location = '<?php echo config_item('app_url'); ?>question/index';
						}, 1000);
					} else if(data.result == -1) {
						nn_enableButton(_btn, '提交问题');
						luiji_alert('error', '提问中包含敏感词');
					} else {
						nn_enableButton(_btn, '提交问题');
						luiji_alert('error', '保存失败，请稍后重试~');
					}
				},
				'json'
			);
		}
	});
	
	var current_page = 1, per = <?php echo config_item('perpage_question'); ?>;
	$('.more-link.more1').show();
	$('#more-loader').click(function() {
		$('.more-link.more1').hide();
		$('.article-loading').show();
		current_page++;
		$.post('./load_page',
			{
				page		: current_page
			}, function(data) {
				var _list = '';
				for(var i = 0; i < data.length; i++) {
					_list +=
						'<li>' +
						'	<a href="./show/' + data[i].id + '" data-ajax="false" class="f-cb">' +
						'		<div class="des">' + data[i].content + '</div>' +
						'		<div class="info f-cb">' +
						'			<div class="time f-fl">' + data[i].createtimes + '</div>' +
						'			<div class="answers f-fr">' + data[i].answers + '个回答</div>' +
						'		</div>' +
						'	</a>' +
						'</li>'
					;
				}
				$(_list).appendTo($('#question-list ul'));
				if(data.length == per) {
					$('.more-link.more1').show();
					$('.article-loading').hide();
				} else {
					$('.article-loading').hide();
					$('.more-link.more1').hide();
					$('.more-link.more2').show();
				}
			},
			'json'
		);
	});
});
</script>
<style type="text/css">
#create-panel ul{padding:0;margin:0;}
#create-panel ul li{list-style:none;padding:10px 0;margin-bottom:10px;border-bottom:1px solid #f3f3f3;}
#create-panel ul li a{display:block;color:#666;text-decoration:none;font-weight:normal;}
#create-panel ul li h3{padding:6px 0;margin:0;font-size:16px;}
#create-panel ul li .des{padding-bottom:10px;font-size:14px;color:#999;}
#create-panel ul li .info{font-size:10px;color:#999;}
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="专家答疑" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>专家答疑</h1>
	<a href="./search" data-icon="search" data-ajax="false">搜索</a>
	<a href="./create" data-icon="edit" data-ajax="false">提问</a>
</div>
<div id="question-list" class="ui-content gh-center">

	<ul>
		<?php
		for($i = 0; $i < count($questions); $i++) {
		?>
		<li>
			<a href="./show/<?php echo $questions[$i]['id']; ?>" data-ajax="false" class="f-cb">
				<div class="des"><?php echo $questions[$i]['content']; ?></div>
				<div class="info f-cb">
					<div class="time f-fl"><?php echo date('Y-m-d H:i', $questions[$i]['createtime']); ?></div>
					<div class="answers f-fr"><?php echo $questions[$i]['answers']; ?>个回答</div>
				</div>
			</a>
		</li>
		<?php
		}
		?>
	</ul>
	<div class="more-link more1"><a data-ajax="false" href="javascript:;" id="more-loader">点击加载更多</a></div>
	<div class="more-link more2"><a data-ajax="false" href="javascript:;">没有了~</a></div>
	<div class="article-loading"></div>

</div>
<!-- search-panel -->
<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>