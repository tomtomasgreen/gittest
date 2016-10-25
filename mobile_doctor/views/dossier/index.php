<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	active_navbar('患者');
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="我的病历" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>我的病历</h1>
	<a href="../my/index" data-icon="back" data-ajax="false">返回</a>
	<a href="./create" data-icon="edit" data-ajax="false">添加病历</a>
</div>
<div id="dossier-list" class="gh-center">
	
	<ul>
		<?php
		for($i = 0; $i < count($dossiers); $i++) {
		?>
		<li>
			<a href="./show/<?php echo $dossiers[$i]['id']; ?>" data-ajax="false" class="f-cb">
				<h3><?php echo $dossiers[$i]['title']; ?></h3>
				<div class="des"><?php echo mb_substr($dossiers[$i]['content'], 0, 36, 'UTF8'); ?>...</div>
				<?php
					if($dossiers[$i]['photos']) {
						$photos = $dossiers[$i]['photos'];
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
					<div class="time f-fl"><?php echo date('Y-m-d H:i', $dossiers[$i]['createtime']); ?></div>
				</div>
			</a>
		</li>
		<?php
		}
		?>
	</ul>
	<?php
	if(!count($dossiers)) {
	?>
	<div class="alert">您还没有添加任何病历~</div>
	<?php
	}
	?>
</div>

<?php
$this->load->view('include/navigation');
$this->load->view('include/footer');
?>