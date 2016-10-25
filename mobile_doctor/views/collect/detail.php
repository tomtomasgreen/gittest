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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="义诊详情" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>义诊详情</h1>
	<a href="../history" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="collect-detail" class="gh-center">
	
	<div class="questions">
		<?php
		for($i = 0; $i < count($questions); $i++) {
		?>
		<div class="question">
			<div class="q-label">第 <?php echo $i + 1; ?> 题</div>
			<div class="q-content"><?php echo $questions[$i]['content']; ?></div>
			<div class="q-answer">
				<label for="answer-textarea-<?php echo $i + 1; ?>">我的回答</label>
				<div class="formarea">
					<span>这位患者您好！</span>
					<p><?php echo $questions[$i]['answer']; ?></p>
					<span>希望能对您有所帮助！（如果涉及诊疗与处方的问题，请到正规医院就诊）</span>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
	<div class="certificate"><img src="<?php echo base_url() . 'public/certificate/' . $collect['sn'] . '.jpg'; ?>"/></div>
	
</div>
</div>
<?php
$this->load->view('include/footer');
?>