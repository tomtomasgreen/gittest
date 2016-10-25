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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的病历" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的病历</h1>
	<a href="../index" data-icon="back" data-ajax="false">返回</a>
	<a href="../create" data-icon="edit" data-ajax="false">添加病历</a>
</div>
<div id="dossier-show" class="gh-center">
	<div class="title"><h1><?php echo $dossier['title']; ?></h1></div>
	<div class="info f-cb">
		<div class="time f-fl"><?php echo date('Y-m-d H:i', $dossier['createtime']); ?></div>
	</div>
	<?php
		if($dossier['photos']) {
			$photos = $dossier['photos'];
			$photos = explode(';', $photos);
	?>
	<div class="thumbs">
	<?php
	for($i = 0; $i < count($photos); $i++) {
	?>
		<p align="center"><img src="<?php echo nn_fix_uploadurl($photos[$i]); ?>"/></p>
	<?php
		}
	?>
	</div>
	<?php
		}
	?>
	<div class="dossier-content">
		<p><?php echo $dossier['content']; ?></p>
	</div>
	<div class="info f-cb">
		<div class="time f-fl"><?php echo date('Y-m-d H:i', $dossier['createtime']); ?></div>
	</div>
</div>

<?php
$this->load->view('include/footer');
?>