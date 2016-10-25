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
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="专家答疑" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>专家答疑</h1>
	<a href="../index" data-icon="back" data-ajax="false">返回</a>
	<!--<a href="#search-panel" data-icon="search">搜索</a>-->
</div>
<div id="question-show" class="gh-center">
	<div class="q-top">
		<div class="question-content">
			<p><?php echo $question['content']; ?></p>
		</div>
		<div class="info f-cb">
			<div class="time f-fr"><?php echo date('Y-m-d H:i', $question['createtime']); ?></div>
		</div>
	</div>
	<div class="info f-cb" style="padding:6px 12px;background-color:#f3f3f3;font-weight:bold;border:0;">
		<div class="answers-count f-fl"><?php echo count($answers); ?>个回答</div>
	</div>
	<div class="answers">
		<ul>
			<?php
			for($i = 0; $i < count($answers); $i++) {
			?>
			<li>
				<div class="doctor">专家回答</div>
				<div class="answer-content">
					<span>这位患者您好！</span>
					<p><?php echo $answers[$i]['content']; ?></p>
					<span>希望能对您有所帮助！（如果涉及诊疗与处方的问题，请到正规医院就诊）</span>
				</div>
				<div class="time"><?php echo date('Y-m-d H:i', $answers[$i]['createtime']); ?></div>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
</div>

<!-- search-panel -->
<?php
$this->load->view('include/footer');
?>