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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="测试首页" data-theme="b">
<div data-role="header" data-position="fixed">
	<h1>测试首页</h1>
</div>
<div id="article-show" role="main" class="ui-content">
	
	
	
	<p><a data-ajax="false" class="ui-btn" href="http://wxtnbw.360med.so/guanhuai/index.php/">患者端</a></p>
	<p><a data-ajax="false" class="ui-btn" href="http://wxtnbw.360med.so/guanhuai/doctor.php/">医生端</a></p>
	
	
	
	
	
	
</div>


<?php
$this->load->view('include/footer');
?>