<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div data-role="footer" data-position="fixed" class="gh_footer gh-center">
	<div data-role="navbar">
		<ul>
			<li><a href="<?php echo config_item('app_url'); ?>task/index" data-ajax="false" class="gh_footer_1">待办</a></li>
			<li><a href="<?php echo config_item('app_url'); ?>user/index" data-ajax="false" class="gh_footer_2">患者</a></li>
			<li><a href="<?php echo config_item('app_url'); ?>article/index" data-ajax="false" class="gh_footer_3">知识</a></li>
			<li><a href="<?php echo config_item('app_url'); ?>my/index" data-ajax="false" class="gh_footer_4">我的</a></li>
		</ul>
	</div>
</div>