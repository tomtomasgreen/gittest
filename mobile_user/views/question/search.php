<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript">
$(function() {
	$('#search-submit').click(function() {
		var title = $('#title').val();
		if(title == '') {
			luiji_alert('error', '请输入搜索关键词');
			return false;
		}
	});
});
</script>
<style type="text/css">
#create-panel ul{padding:0;margin:0;}
#create-panel ul li{list-style:none;padding:10px 0;margin-bottom:10px;border-bottom:1px solid #f3f3f3;}
#create-panel ul li a{display:block;color:#666;text-decoration:none;font-weight:normal;}
#create-panel ul li h3{padding:6px 0;margin:0;font-size:16px;}
#create-panel ul li .des{padding-bottom:10px;font-size:14px;color:#999;}
#create-panel ul li .info{font-size:10px;color:#999;}
form{padding:10px 10px 0;}
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="问答中心" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>问答中心</h1>
	<a href="./index" data-icon="back" data-ajax="false">返回</a>
	<!--<a href="./create" data-icon="edit" data-ajax="false">提问</a>-->
</div>
<div id="question-list" class="gh-center">
	<form class="userform" action="./search" method="post" data-ajax="false">
		<div class="f-cb">
			<div class="f-fl" style="width:70%;">
				<input type="text" name="title" id="title" value="<?php echo $title; ?>" data-clear-btn="true" data-mini="true"/>
			</div>
			<div class="f-fr" style="width:28%;">
				<button class="ui-btn ui-shadow ui-corner-all ui-mini" id="search-submit">搜索</button>
			</div>
		</div>
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-bottom:16px;">
			<input type="radio" name="type" id="radio-type-all" value="all" <?php echo ($type == 'all' ? 'checked="checked"' : ''); ?>/>
			<label for="radio-type-all">所有</label>
			<input type="radio" name="type" id="radio-type-my" value="my" <?php echo ($type == 'my' ? 'checked="checked"' : ''); ?>/>
			<label for="radio-type-my">我的</label>
		</fieldset>
	</form>
	<?php
	if($questions) {
	?>
	<div class="search-info">
		<!--<div class="item"><?php echo ($type == 'all') ? '所有提问' : '我的提问'; ?>中，包含 <span><?php echo $title; ?></span> 的问题</div>-->
		<div class="item f-cb">
			<div class="f-fl">共搜索到 <span><?php echo count($questions); ?></span> 条</div>
			<!--<div class="f-fr"><a href="./index" class="ui-btn ui-shadow ui-corner-all ui-mini" data-ajax="false">返回所有</a></div>-->
		</div>
	</div>
	<?php
	}
	?>
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
					<div class="thumb <?php echo ($j == count($photos) - 1) ? 'last' : ''; ?>"><img src="<?php echo $photos[$j]; ?>"/></div>
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
$this->load->view('include/footer');
?>