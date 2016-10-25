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
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的</h1>
</div>
<div id="my-home" class="gh-center">

	<a data-ajax="false" href="./info">
		<div class="userinfo f-cb">
			<div class="thumb f-fl"><img src="<?php echo $user['thumb'] ? nn_fix_uploadurl($user['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
			<div class="info f-fr">
				<div class="item"><?php echo $user['username']; ?></div>
				<div class="item" style="font-size:12px;color:#999;">联系电话：<?php echo $user['mobile']; ?></div>
				<div class="item" style="font-size:12px;color:#999;">电子邮箱：<?php echo $user['email']; ?></div>
			</div>
		</div>
	</a>
	<ul>
		<li><a class="user-home-0" data-ajax="false" href="../my/notice_department">系统通知<?php if($notices_unread) { echo '<span style="font-size:14px;color:#f33;">（' . count($notices_unread) . '条新消息）</span>';} ?></a></li>
		<li><a class="user-home-1" data-ajax="false" href="../dossier/index">我的病历</a></li>
		<li><a class="user-home-2" data-ajax="false" href="../box/index">我的设备</a></li>
		<li><a class="user-home-3" data-ajax="false" href="../my/money_ohmate">我的糖豆<span class="money-left"><?php echo $user['money']; ?></span></a></li>
		<li><a class="user-home-4" data-ajax="false" href="./editpwd">修改密码</a></li>
	</ul>
	<!--<div class="qrcode"><img src="<?php echo base_url(); ?>public/images/user_1.jpg"/></div>-->
	<div class="controls" style="padding-top:20px;"><a data-ajax="false" class="ui-btn" href="../passport/logout">退出当前账号</a></div>
	
</div>

<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>