<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
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
<div data-role="panel" data-position="left" data-display="overlay" data-theme="b" id="search-panel">
	<form class="userform" action="./search" method="post" data-ajax="false">
		<h2 style="border-bottom:1px solid #ddd;padding-bottom:16px;">问题搜索</h2>
		<label for="title">关键词：</label>
		<input type="text" name="title" id="title" value="" data-clear-btn="true" data-mini="true"/>
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-bottom:16px;">
			<input type="radio" name="type" id="radio-type-all" value="all" checked="checked"/>
			<label for="radio-type-all">所有</label>
			<input type="radio" name="type" id="radio-type-my" value="my"/>
			<label for="radio-type-my">我的</label>
		</fieldset>
		<div style="border-top:1px solid #ddd;padding-top:16px;"><button class="ui-btn ui-shadow ui-corner-all ui-mini" id="search-submit">搜索</button></div>
	</form>
	<div id="create-panel">
		<h3>我的提问</h3>
		<ul>
			<?php
			for($i = 0; $i < count($myquestions); $i++) {
			?>
			<li>
				<a href="./show/<?php echo $myquestions[$i]['id']; ?>" data-ajax="false" class="f-cb">
					<div class="des"><?php echo $myquestions[$i]['content']; ?></div>
					<div class="info f-cb">
						<div class="time f-fl"><?php echo date('Y-m-d H:i', $myquestions[$i]['createtime']); ?></div>
						<div class="answers f-fr"><?php echo $myquestions[$i]['answers']; ?>个回答</div>
					</div>
				</a>
			</li>
			<?php
			}
			?>
		</ul>
	</div>

</div>