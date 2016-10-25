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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="义诊证书" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>义诊证书</h1>
	<a href="../../my/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="collect-sn" role="main" class="gh-center">
	
	成功完成义诊，获得证书！<br />
	证书编号：<?php echo $collect['sn']; ?>
	<div class="certificate"><img src="<?php echo base_url() . 'public/certificate/' . $collect['sn'] . '.jpg'; ?>"/></div>
	
</div>
<?php
$this->load->view('include/footer');
?>