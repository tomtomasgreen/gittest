<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('问答');
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="问答中心" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>问答中心</h1>
	<a href="./play" data-icon="comment" data-ajax="false">我要答题</a>
	<a href="#search-panel" data-icon="search">搜索</a>
</div>
<div id="question-list" class="gh-center">

	<ul>
		<?php
		for($i = 0; $i < count($questions); $i++) {
		?>
		<li>
			<a href="./show/<?php echo $questions[$i]['id']; ?>" data-ajax="false" class="f-cb">
				<h3><?php echo $questions[$i]['title']; ?></h3>
				<div class="des"><?php echo mb_substr($questions[$i]['content'], 0, 36, 'UTF8'); ?>...</div>
				<?php
					if($questions[$i]['photos']) {
						$photos = $questions[$i]['photos'];
						$photos = explode(';', $photos);
				?>
				<div class="thumbs f-cb">
				<?php
				for($j = 0; $j < count($photos); $j++) {
				?>
					<div class="thumb <?php echo ($j == count($photos) - 1) ? 'last' : ''; ?>"><img src="<?php echo nn_fix_uploadurl($photos[$j]); ?>"/></div>
				<?php
					}
				?>
				</div>
				<?php
					}
				?>
				<div class="info f-cb">
					<div class="time f-fl"><?php echo date('Y-m-d H:i', $questions[$i]['createtime']); ?></div>
					<div class="answers f-fr"><?php echo $questions[$i]['answers']; ?>个回答</div>
				</div>
			</a>
		</li>
		<?php
		}
		?>
	</ul>

</div>

<!-- search-panel -->
<?php
$this->load->view('include/question_search');
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>