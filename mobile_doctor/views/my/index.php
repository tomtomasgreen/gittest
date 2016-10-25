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
			<div class="thumb f-fl"><img src="<?php echo $doctor['thumb'] ? nn_fix_uploadurl($doctor['thumb']) : base_url() . 'public/images/user-nophoto.jpg'; ?>"/></div>
			<div class="info f-fr">
				<div class="item"><?php echo $doctor['username']; ?></div>
				<div class="item" style="font-size:12px;color:#999;">联系电话：<?php echo $doctor['mobile']; ?></div>
			</div>
		</div>
	</a>
	<ul>
		<li><a class="doctor-home-1" data-ajax="false" href="./department">我的科室<?php if($notices_unread) { echo '<span style="font-size:14px;color:#f33;">（' . count($notices_unread) . '条新消息）</span>';} ?></a></li>
		<li><a class="doctor-home-2" data-ajax="false" href="../collect/card">我的积分</a></li>
		<?php
		if(!in_array($doctor['province'], config_item('blacklist_collect_province')) || in_array($doctor['mobile'], config_item('whitelist_collect_doctor'))) {
		?>
		<li><a class="doctor-home-3" data-ajax="false" href="../collect/index">糖友智库</a></li>
		<?php
		}
		?>
		<li><a class="doctor-home-4" data-ajax="false" href="./editpwd">修改密码</a></li>
	</ul>
	<div class="qrcode"><img src="<?php echo base_url(); ?>public/qrcode/<?php echo config_item('qrcode_start') + $doctor['id']; ?>.jpg"/></div>
	<div class="qrcode-label">医生唯一码：<?php echo config_item('qrcode_start') + $doctor['id']; ?></div>
	<div class="controls"><a data-ajax="false" class="ui-btn" href="../passport/logout">退出当前账号</a></div>
	
</div>

<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>