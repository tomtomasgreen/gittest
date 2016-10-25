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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="兑换中心" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>兑换中心</h1>
	<a href="../my/money" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="gift-home" class="gh-center">

	<div class="alert-gift" style="text-align:center;padding-top:100px;color:#5B9BBF;font-weight:bold;font-size:32px;">敬请期待</div>
	
</div>

<?php
$this->load->view('include/footer');
?>