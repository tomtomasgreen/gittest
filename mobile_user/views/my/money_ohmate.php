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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的糖豆" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的糖豆</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
	<!--<a href="../gift/history" data-icon="clock" data-ajax="false">历史</a>-->
</div>
<div id="my-money" class="gh-center">
	
	<!--<div class="info"><div class="text">当前糖豆<span><?php echo $user['money']; ?></span></div></div>-->
	<div class="info"><div class="text">当前糖豆总额： <span><?php echo $user['money']; ?></span> 糖豆<!--<a href="../my/money" data-ajax="false">[ 查看明细 ]</a>--></div></div>
	<?php
	if($isWeixinBrowser) {
	?>
	<div class="store"><a href="http://puanpharm.ohmate.cn/wx/index?phone=<?php echo urlencode(aes_encode($user['mobile'], 'n0u0norDi5k_maTe')); ?>"><img src="/guanhuai/public/images/ohmate-1.jpg"/></a></div>
	<?php
	} else {
	?>
	<div class="store"><a href="http://puanpharm.ohmate.cn/member/index?phone=<?php echo urlencode(aes_encode($user['mobile'], 'n0u0norDi5k_maTe')); ?>"><img src="/guanhuai/public/images/ohmate-1.jpg"/></a></div>
	<?php
	}
	?>
	
	<!--
	<?php
		// echo aes_decode(urldecode('uLpLV0W4ySj18JA79iUDzW8jLw7Tx5h9wLJHsNhAptU%3D'), 'n0u0norDi5k_maTe');
		echo urldecode('KF1poDLVzsU6kl2wiJPqOByIqm%2BpmaYdEE%2BsGY8vhWw%3D');
		echo '-------';
		echo aes_decode(urldecode('KF1poDLVzsU6kl2wiJPqOByIqm%2BpmaYdEE%2BsGY8vhWw%3D'), 'n0u0norDi5k_maTe');
	?>
	-->
	
	<div class="store"><img src="/guanhuai/public/images/ohmate-3.jpg"/></div>
</div>

<?php
$this->load->view('include/footer');
?>