<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	var
		size = get_window_size(),
		height = size[1]
	;
	$('#iframe').css('height', (height - 50) + 'px');
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="查看照片" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>查看照片</h1>
	<a href="./show/<?php echo $id; ?>" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="article-show" style="margin:0;padding:0;" class="gh-center">
	<iframe id="iframe" src="<?php echo $photo; ?>" frameborder="0" width="100%"></iframe>
</div>


<?php
$this->load->view('include/footer');
?>