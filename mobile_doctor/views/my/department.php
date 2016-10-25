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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的科室" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的科室</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
	<a href="../my/notice_department" data-icon="comment" data-ajax="false" id="notice-link">通知<?php if($notices_unread) { ?><span class="chats"><?php echo count($notices_unread); ?></span><?php } ?></a>
</div>
<div id="my-department" class="gh-center">
	
	<?php
	if($department) {
	?>
	<div class="alert-info">
		<div class="item line"><?php echo $department['hospital'] . ' - ' . $department['department']; ?></div>
		<div class="item">本科室内共：<span><?php echo count($mates); ?></span> 名医生</div>
	</div>
	<?php
	} else {
	?>
	<div class="alert-info" style="padding-top:100px;text-align:center;color:#f33;">还未加入任何科室~</div>
	<?php
	}
	?>
	<ul>
		<?php
		for($i = 0; $i < count($mates); $i++) {
		?>
		<li class="f-cb">
			<?php
			if($mates[$i]['thumb']) {
			?>
			<a class="photo f-fl photo-link" href="javascript:;"><img src="<?php echo nn_fix_uploadurl($mates[$i]['thumb']); ?>"/></a>
			<?php
			} else {
			?>
			<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/user-nophoto.jpg"/></a>
			<?php
			}
			?>
			<div class="detail f-fr">
				<div class="username">医生姓名：<?php echo $mates[$i]['username']; ?></div>
				<div class="account">联系电话：<?php echo $mates[$i]['mobile']; ?></div>
			</div>
		</li>
		<?php
		}
		?>
	</ul>
	
</div>

<?php
$this->load->view('include/footer');
?>