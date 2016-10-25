<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	
	var
		userid = <?php echo $userid; ?>, 
		doctorid = <?php echo $loginuser; ?>, 
		from = 'doctor',
		since = 0
	;
	getLastestMessage();
	$('#chat-submit').click(function() {
		var content = $.trim($('#chat-textarea').val());
		if(!content) {
			luiji_alert('error', '请输入对话内容！');
			return false;
		} else {
			$.post('../send',
				{
					userid: userid,
					doctorid: doctorid,
					from: from,
					content: content
				}, function(data) {
					if(data.result > 0) {
						$('#chat-textarea').val('');
						appendMessage(content, '22:15:31', 'my');
					} else {
						luiji_alert('error', '发送失败，待会再试');
					}
				},
				'json'
			);
		}
	});
	function getLastestMessage() {
		$.post('../get_lastest',
			{
				userid: userid,
				doctorid: doctorid,
				num: 20
			}, function(data) {
				var time = '', html = '', from = '';
				for(i = data.length - 1; i >= 0; i--) {
					time = data[i].createtimes;
					time = time.substr(5, 14);
					from = data[i].from == 'user' ? 'user' : 'my';
					appendMessage(data[i].content, time, from);
					if(i == 0) {
						since = data[i].createtime;
					}
				}
				getNewMessage();
				window.setInterval(function() {
					getNewMessage();
				}, <?php echo config_item('chat_timeout'); ?>);
			},
			'json'
		);
	}
	function getNewMessage() {
		$.post('../get_reply',
			{
				userid: userid,
				doctorid: doctorid,
				since: since
			}, function(data) {
				var time = '', html = '';
				for(i = 0; i < data.length; i++) {
					time = data[i].createtimes;
					time = time.substr(5, 14);
					appendMessage(data[i].content, time, 'user');
					if(i == data.length - 1) {
						since = data[i].createtime;
					}
				}
			},
			'json'
		);
	}
	function appendMessage(content, time, from) {
		var html = 
			'<div class="chat-item f-cb">' +
			'	<div class="item-' + from + '">' +
			'		<div class="time">' + time + '</div>' +
			'		<div class="content">' + content + '</div>' +
			'	</div>' +
			'</div>'
		;
		$(html).appendTo($('.chat-content'));
		$('body').clearQueue().animate({scrollTop: ($('.chat-content').height() - 60) + 'px'}, 300);
		// $('body').css('scrollTop', $('.chat-content').height() + 'px');
	}
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="在线对话" data-theme="b">
<div data-role="header" data-position="fixed" style="border-bottom:0;" class="gh-center">
	<h1>在线对话</h1>
	<a href="../../user/show/<?php echo $userid; ?>" data-icon="back" data-ajax="false">返回</a>
	<!--<a href="#chat-setting" data-icon="gear">详情</a>-->
	<!--
	<div class="ui-bar ui-bar-d" id="chat-closed">
		<div class="alert" data-icon="alert">已关闭该用户对话，可在设置中打开消息接收</div>
	</div>
	-->
</div>
<div id="chat-user" role="main" class="ui-content gh-center">
	<div class="chat-content"></div>

	<div data-role="panel" data-position="left" data-display="overlay" data-theme="b" id="chat-setting">
		<h2 style="border-bottom:1px solid #e6e6e6;padding-bottom:16px;">用户详情与设置</h2>
		<div class="thumb"><img src="<?php echo $user['thumb'] ? nn_fix_uploadurl($user['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
		<div class="user-info">
			<div class="username"><?php echo $user['username']; ?><?php echo $user['sex'] ? '，' . $user['sex'] : ''; ?></div>
			<div class="account"><?php echo $user['mobile'] ? $user['mobile'] : $user['email']; ?></div>
		</div>
		<!--
		<div class="switch">
			<label for="flip-receive">接收消息？</label>
			<input type="checkbox" data-role="flipswitch" name="flip-receive" id="flip-receive" data-on-text="打开" data-off-text="关闭" data-wrapper-class="custom-size-flipswitch" checked="checked"/>
		</div>
		-->
	</div>
	<div data-role="footer" data-position="fixed" class="chat-editor f-cb gh-center">
		<textarea class="f-fl" name="" id="chat-textarea"></textarea>
		<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-navigation ui-mini f-fl chat-send f-br4" id="chat-submit">发送</button>
	</div>
</div>
<?php
$this->load->view('include/footer');
?>