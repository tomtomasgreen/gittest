<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('知识');
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="知识" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>知识</h1>
</div>
<div id="article-list" class="gh-center">
	<ul>
		<?php
		for($i = 0; $i < count($articles); $i++) {
		?>
		<li>
			<?php
			if($articles[$i]['url']) {
			?>
			<a href="./url?url=<?php echo urlencode($articles[$i]['url']); ?>" data-ajax="false" class="f-cb">
			<?php
			} else {
			?>
			<a href="./show/<?php echo $articles[$i]['id']; ?>" data-ajax="false" class="f-cb">
			<?php
			}
			?>
			<div class="thumb f-fl"><img src="<?php echo $articles[$i]['thumb'] ? nn_fix_uploadurl($articles[$i]['thumb']) : base_url() . 'public/images/nophoto.jpg'; ?>"/></div>
			<div class="info f-fr">
				<h3><?php echo $articles[$i]['title']; ?></h3>
			</div>
			</a>
		</li>
		<?php
		}
		?>
	</ul>

</div>


<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>