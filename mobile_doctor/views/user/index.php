<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('患者');
	
	$('.photo-link').click(function() {
		var src = $(this).find('img').eq(0).attr('src');
		$('#popupUphoto img').attr('src', src);
	});
	var users = $('#user-list ul.users-list li');
	$('#filter-submit').click(function() {
		var keyword = $('#filter').val();
		if(keyword == '') {
			users.show();
		} else {
			users.hide();
			for(var i = 0; i < users.length; i++) {
				var
					uname = users.eq(i).find('span.uname').text(),
					username = users.eq(i).find('span.username').text(),
					mobile = users.eq(i).find('span.mobile').text(),
					email = users.eq(i).find('span.email').text()
				;
				if(uname.indexOf(keyword) >= 0) {
					users.eq(i).show();
				} else if(username.indexOf(keyword) >= 0) {
					users.eq(i).show();
				} else if(mobile.indexOf(keyword) >= 0) {
					users.eq(i).show();
				} else if(email.indexOf(keyword) >= 0) {
					users.eq(i).show();
				}
			}
		}
	});
	
	var current_uid = 0;
	$('#user-list .unaccepted .control-item a').click(function() {
		current_uid = $(this).data('id');
	});
	$('#submit-accept').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '稍等...');
		$.post('./bind_accept',
			{
				userid: current_uid
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
					nn_enableButton(_btn, '确定');
				}
			},
			'json'
		);
	});
	$('#submit-unaccept').click(function() {
		$.post('./bind_unaccept',
			{
				userid: current_uid
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
});
</script>
<style type="text/css">
.filter-label .ui-btn{padding:0.5em 1em;}
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="患者" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>患者</h1>
	<a href="javascript:;" data-ajax="false" style="padding:0;margin:0;width:0;height:0;border:0;"></a>
	<a href="./add" data-icon="plus" data-ajax="false">添加患者</a>
</div>
<div id="user-list" class="gh-center">
	<div class="f-cb users-filter form-item">
		<div class="filter-input f-fl"><input type="text" name="filter" id="filter" placeholder="备注/姓名/电话/邮箱"/></div>
		<div class="filter-label f-fr" for="filter"><button class="btn" id="filter-submit">筛选</button></div>
	</div>
	<a href="../chat/index" data-ajax="false" class="chat-link"><div class="info" style="padding-top:0;"><div class="text"><span><?php echo count($chats1); ?></span> 条未读消息，[ 点击查看 ]</div></div></a>
	<div class="unaccepted">
		<?php
		if($users_unaccepted) {
		?>
		<div class="info" style="padding-top:0;text-align:center;"><div class="text"><?php echo count($users_unaccepted); ?></span> 位患者等待通过</div></div>
		<ul>
			<?php
			for($i = 0; $i < count($users_unaccepted); $i++) {
			?>
			<li>
				<div class="user-card f-cb">
					<?php
					if($users_unaccepted[$i]['thumb']) {
					?>
					<a class="photo f-fl photo-link" href="#popupUphoto" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($users_unaccepted[$i]['thumb']); ?>"/></a>
					<?php
					} else {
					?>
					<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/user-nophoto.jpg"/></a>
					<?php
					}
					?>
					<div class="item f-fr">
						<div class="username">患者姓名：<span class="username"><?php echo $users_unaccepted[$i]['username']; ?></span></div>
						<div class="account">联系电话：<span class="mobile"><?php echo $users_unaccepted[$i]['mobile']; ?></span></div>
						<div class="account">邮箱地址：<span class="email"><?php echo $users_unaccepted[$i]['email']; ?></span></div>
						<div class="bindtime">申请时间：<?php echo date('Y-m-d', $users_unaccepted[$i]['bindtime']); ?></div>
					</div>
				</div>
				<div class="controls f-cb">
					<div class="control-item f-fl"><a class="ui-btn ui-btn-b ui-btn-corner-all" href="#popupBindaccept" data-rel="popup" data-position-to="window" data-transition="pop" data-id="<?php echo $users_unaccepted[$i]['id']; ?>">通过邀请</a></div>
					<div class="control-item f-fr"><a class="ui-btn ui-btn-d ui-btn-corner-all" href="#popupBindunaccept" data-rel="popup" data-position-to="window" data-transition="pop" data-id="<?php echo $users_unaccepted[$i]['id']; ?>">拒绝邀请</a></div>
				</div>
			</li>
			<?php
			}
			?>
		</ul>
		<?php
		}
		?>
	</div>
	<div class="info" style="padding-top:0;text-align:center;"><div class="text">当前已添加了 <span><?echo count($users); ?></span> 位患者</div></div>
	<ul class="users-list">
		<?php
		for($i = 0; $i < count($users); $i++) {
		?>
		<li class="f-cb">
			<?php
			if($users[$i]['thumb']) {
			?>
			<a class="photo f-fl photo-link" href="#popupUphoto" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($users[$i]['thumb']); ?>"/></a>
			<?php
			} else {
			?>
			<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/user-nophoto.jpg"/></a>
			<?php
			}
			?>
			<a class="item f-fr" href="./show/<?php echo $users[$i]['id']; ?>" data-ajax="false">
				<div class="username">患者姓名：<span class="username"><?php echo $users[$i]['username']; ?></span></div>
				<div class="username">备注姓名：<span class="uname"><?php echo $users[$i]['uname']; ?></span></div>
				<div class="account">联系电话：<span class="mobile"><?php echo $users[$i]['mobile']; ?></span></div>
				<div class="account">邮箱地址：<span class="email"><?php echo $users[$i]['email']; ?></span></div>
				<div class="bindtime">添加时间：<?php echo date('Y-m-d', $users[$i]['bindtime']); ?></div>
			</a>
		</li>
		<?php
		}
		?>
	</ul>
	<?php
	if(!count($users)) {
	?>
	<div class="alert">您还没有添加任何患者~</div>
	<?php
	}
	?>
</div>

<div data-role="popup" id="popupUphoto" class="photopopup" data-overlay-theme="b" data-corners="false" data-tolerance="30,15">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<img src="/guanhuai/public/images/user-photo2.jpg"/>
</div>
<div data-role="popup" id="popupBindaccept" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确认添加</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定添加该患者？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="submit-accept">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<div data-role="popup" id="popupBindunaccept" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	<div data-role="header" data-theme="b">
		<h1>确认拒绝</h1>
	</div>
	<div role="main" class="ui-content">
		<h3 class="ui-title">确定拒绝该患者？</h3>
		<button class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="submit-unaccept">确定</button>
		<a href="javascript:;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back" data-transition="flow">返回</a>
	</div>
</div>
<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>