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
	<a href="../index" data-icon="back" data-ajax="false">返回</a>
	<a href="#search-panel" data-icon="search">搜索</a>
</div>
<div id="question-show" role="main" class="ui-content gh-center">
	<div class="alert"><div class="text answered">此题我已回答</div></div>
	<div class="alert"><div class="text not-answered">此题我还未回答</div></div>
	<div class="title"><h1><?php echo $question['title']; ?></h1></div>
	<div class="info f-cb">
		<div class="time f-fl"><?php echo date('Y-m-d H:i', $question['createtime']); ?></div>
		<div class="answers-count f-fr"><?php echo $question['answers']; ?>个回答</div>
	</div>
	<?php
		if($question['photos']) {
			$photos = $question['photos'];
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
	<div class="question-content">
		<p><?php echo $question['content']; ?></p>
	</div>
	<div class="info f-cb">
		<div class="time f-fl"><?php echo date('Y-m-d H:i', $question['createtime']); ?></div>
		<div class="answers-count f-fr"><?php echo $question['answers']; ?>个回答</div>
	</div>
	<div class="answers">
		<ul>
			<li>
				<div class="doctor">张大毛 大夫</div>
				<div class="answer-content">中国公司在核心技术上的投入和原创性还是不足。”不少创业者热衷于“讲故事”、“画大饼”，希望能快速成功，这一点在互联网金融领域尤为明显。日前，成交额一度位列北京P2P借贷平台榜首的E租宝因涉嫌违法经营被调查，引发广泛关注和业界反思。在此间参会的互联网业界人士这两天频频谈及稳步创新、充分尊重实体经济规律的重要性。</div>
				<div class="time">2015-12-16 19:26</div>
			</li>
			<li>
				<div class="doctor">张大毛 大夫</div>
				<div class="answer-content">中国公司在核心技术上的投入和原创性还是不足。”不少创业者热衷于“讲故事”、“画大饼”，希望能快速成功，这一点在互联网金融领域尤为明显。日前，成交额一度位列北京P2P借贷平台榜首的E租宝因涉嫌违法经营被调查，引发广泛关注和业界反思。在此间参会的互联网业界人士这两天频频谈及稳步创新、充分尊重实体经济规律的重要性。</div>
				<div class="time">2015-12-16 19:26</div>
			</li>
			<li>
				<div class="doctor">张大毛 大夫</div>
				<div class="answer-content">中国公司在核心技术上的投入和原创性还是不足。”不少创业者热衷于“讲故事”、“画大饼”，希望能快速成功，这一点在互联网金融领域尤为明显。日前，成交额一度位列北京P2P借贷平台榜首的E租宝因涉嫌违法经营被调查，引发广泛关注和业界反思。在此间参会的互联网业界人士这两天频频谈及稳步创新、充分尊重实体经济规律的重要性。</div>
				<div class="time">2015-12-16 19:26</div>
			</li>
			<li>
				<div class="doctor">张大毛 大夫</div>
				<div class="answer-content">中国公司在核心技术上的投入和原创性还是不足。”不少创业者热衷于“讲故事”、“画大饼”，希望能快速成功，这一点在互联网金融领域尤为明显。日前，成交额一度位列北京P2P借贷平台榜首的E租宝因涉嫌违法经营被调查，引发广泛关注和业界反思。在此间参会的互联网业界人士这两天频频谈及稳步创新、充分尊重实体经济规律的重要性。</div>
				<div class="time">2015-12-16 19:26</div>
			</li>
			<li>
				<div class="doctor">张大毛 大夫</div>
				<div class="answer-content">中国公司在核心技术上的投入和原创性还是不足。”不少创业者热衷于“讲故事”、“画大饼”，希望能快速成功，这一点在互联网金融领域尤为明显。日前，成交额一度位列北京P2P借贷平台榜首的E租宝因涉嫌违法经营被调查，引发广泛关注和业界反思。在此间参会的互联网业界人士这两天频频谈及稳步创新、充分尊重实体经济规律的重要性。</div>
				<div class="time">2015-12-16 19:26</div>
			</li>
			<li>
				<div class="doctor">张大毛 大夫</div>
				<div class="answer-content">中国公司在核心技术上的投入和原创性还是不足。”不少创业者热衷于“讲故事”、“画大饼”，希望能快速成功，这一点在互联网金融领域尤为明显。日前，成交额一度位列北京P2P借贷平台榜首的E租宝因涉嫌违法经营被调查，引发广泛关注和业界反思。在此间参会的互联网业界人士这两天频频谈及稳步创新、充分尊重实体经济规律的重要性。</div>
				<div class="time">2015-12-16 19:26</div>
			</li>
			<li>
				<div class="doctor">张大毛 大夫</div>
				<div class="answer-content">中国公司在核心技术上的投入和原创性还是不足。”不少创业者热衷于“讲故事”、“画大饼”，希望能快速成功，这一点在互联网金融领域尤为明显。日前，成交额一度位列北京P2P借贷平台榜首的E租宝因涉嫌违法经营被调查，引发广泛关注和业界反思。在此间参会的互联网业界人士这两天频频谈及稳步创新、充分尊重实体经济规律的重要性。</div>
				<div class="time">2015-12-16 19:26</div>
			</li>
		</ul>
	</div>
</div>

<!-- search-panel -->
<?php
$this->load->view('include/question_search');
$this->load->view('include/footer');
?>