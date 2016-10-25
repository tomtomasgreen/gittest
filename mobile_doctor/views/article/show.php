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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="知识" data-theme="b" style="background-color:#fff;">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>知识</h1>
	<a href="../index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="article-show" role="main" class="ui-content gh-center">
	<div class="title"><h1><?php echo $article['title']; ?></h1></div>
	<div class="article-description"><?php echo $article['description']; ?></div>
	<div class="article-content">
		<?php echo $article['content']; ?>
	</div>
	<div class="time"><?php echo date('Y-m-d', $article['createtime']); ?></div>
</div>


<?php
$this->load->view('include/footer');
?>