<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	$('.item-food').show();
	
	$('.photo-link').click(function() {
		var src = $(this).find('img').eq(0).attr('src');
		$('#popupUphoto img').attr('src', src);
	});
});
</script>
<style type="text/css">
</style>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="过往数据" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>过往数据</h1>
	<a href="../show/<?php echo $id; ?>" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="record-show" class="gh-center">

	<div class="records">
		<div class="item item-food">
			<div class="search f-cb">
				<form action="../record_food/<?php echo $id; ?>" method="post" data-ajax="false">
					<div class="startdate f-fl"><input type="date" name="start" id="start" value="<?php echo date('Y-m-d', $start); ?>"/></div>
					<div class="enddate f-fl"><input type="date" name="end" id="end" value="<?php echo date('Y-m-d', $end); ?>"/></div>
					<div class="submit-control f-fr"><button class="ui-btn ui-btn-inline ui-btn-corner-all" id="search-submit">筛选</button></div>
				</form>
			</div>
			<?php
			if($food_records) {
			?>
			<ul>
				<?php
				for($i = 0; $i < count($food_records); $i++) {
				?>
				<li class="f-cb">
					<?php
					if($food_records[$i]['photo']) {
					?>
					<a class="photo f-fl photo-link" href="#popupUphoto" data-rel="popup" data-position-to="window" data-transition="pop"><img src="<?php echo nn_fix_uploadurl($food_records[$i]['photo']); ?>"/></a>
					<?php
					} else {
					?>
					<a class="photo f-fl" href="javascript:;"><img src="<?php echo base_url(); ?>public/images/nophoto.jpg"/></a>
					<?php
					}
					?>
					<div class="detail f-fr">
						<div class="type"><?php echo $food_records[$i]['type']; ?></div>
						<div class="time"><?php echo date('m-d H:i', $food_records[$i]['measuretime']); ?></div>
						<div class="des"><?php echo $food_records[$i]['content']; ?></div>
					</div>
				</li>
				<?php
				}
				?>
			</ul>
			<?php
			} else {
			?>
			<div class="empty-alert" style="padding:10px 20px;color:#f33;">当前时间段下没有任何记录~</div>
			<?php
			}
			?>
		</div>
	</div>

</div>

<div data-role="popup" id="popupUphoto" class="photopopup" data-overlay-theme="b" data-corners="false" data-tolerance="30,15">
	<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<img src="/guanhuai/upload/image/201512/20151220163827_752027.jpg"/>
</div>
<?php
$this->load->view('include/footer');
?>