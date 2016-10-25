<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="对话留言" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>对话留言</h1>
	<a href="../user/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="chat-list" class="gh-center">
	
	<div class="view-list not-view">
		<div class="info"><div class="text"><span><?php echo count($chats1); ?></span> 条未读消息</div></div>
		<ul>
			<?php
			for($i = 0; $i < count($chats1); $i++) {
			?>
			<li class="f-cb">
				<a href="./user/<?php echo $chats1[$i]['userid']; ?>" data-ajax="false" class="f-cb">
					<div class="thumb f-fl"><img src="<?php echo $chats1[$i]['thumb'] ? nn_fix_uploadurl($chats1[$i]['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
					<div class="detail f-fr">
						<div class="timeinfo f-cb">
							<div class="username f-fl"><?php echo $chats1[$i]['username']; ?></div>
							<div class="time f-fr"><?php echo date('m-d H:i', $chats1[$i]['createtime']); ?></div>
						</div>
						<div class="message"><?php echo $chats1[$i]['content']; ?></div>
					</div>
				</a>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
	<div class="view-list viewed">
		<div class="info"><div class="text">已读消息</div></div>
		<ul>
			<?php
			for($i = 0; $i < count($chats2); $i++) {
			?>
			<li class="f-cb">
				<a href="./user/<?php echo $chats2[$i]['userid']; ?>" data-ajax="false" class="f-cb">
					<div class="thumb f-fl"><img src="<?php echo $chats2[$i]['thumb'] ? nn_fix_uploadurl($chats2[$i]['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
					<div class="detail f-fr">
						<div class="timeinfo f-cb">
							<div class="username f-fl"><?php echo $chats2[$i]['username']; ?></div>
							<div class="time f-fr"><?php echo date('m-d H:i', $chats2[$i]['createtime']); ?></div>
						</div>
						<div class="message"><?php echo $chats2[$i]['content']; ?></div>
					</div>
				</a>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
	
</div>

<?php
$this->load->view('include/footer');
?>