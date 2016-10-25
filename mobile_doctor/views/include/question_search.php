<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div data-role="panel" data-position="left" data-display="overlay" data-theme="b" id="search-panel">
	<form class="userform">
		<h2 style="border-bottom:1px solid #ddd;padding-bottom:16px;">问题搜索</h2>
		<label for="title">关键词：</label>
		<input type="text" name="title" id="title" value="" data-clear-btn="true" data-mini="true"/>
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" style="padding-bottom:16px;">
			<input type="radio" name="type" id="radio-type-all" value="all" checked="checked"/>
			<label for="radio-type-all">所有</label>
			<input type="radio" name="type" id="radio-type-my" value="my"/>
			<label for="radio-type-my">我的</label>
		</fieldset>
		<div style="border-top:1px solid #ddd;padding-top:16px;"><a href="#" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-mini">搜索</a></div>
	</form>
</div>