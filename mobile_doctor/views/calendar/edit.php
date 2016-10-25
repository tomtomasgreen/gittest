<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	var week_start = <?php echo $week_start; ?>;
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		var
			job_1_1 = $('#setting-1-1').val(),
			job_1_2 = $('#setting-1-2').val(),
			job_2_1 = $('#setting-2-1').val(),
			job_2_2 = $('#setting-2-2').val(),
			job_3_1 = $('#setting-3-1').val(),
			job_3_2 = $('#setting-3-2').val(),
			job_4_1 = $('#setting-4-1').val(),
			job_4_2 = $('#setting-4-2').val(),
			job_5_1 = $('#setting-5-1').val(),
			job_5_2 = $('#setting-5-2').val(),
			job_6_1 = $('#setting-6-1').val(),
			job_6_2 = $('#setting-6-2').val(),
			job_7_1 = $('#setting-7-1').val(),
			job_7_2 = $('#setting-7-2').val()
		;
		$.post('./edit',
			{
				week_start	: week_start,
				job_1_1		: job_1_1,
				job_1_2		: job_1_2,
				job_2_1		: job_2_1,
				job_2_2		: job_2_2,
				job_3_1		: job_3_1,
				job_3_2		: job_3_2,
				job_4_1		: job_4_1,
				job_4_2		: job_4_2,
				job_5_1		: job_5_1,
				job_5_2		: job_5_2,
				job_6_1		: job_6_1,
				job_6_2		: job_6_2,
				job_7_1		: job_7_1,
				job_7_2		: job_7_2
			}, function(data) {
				if(data.result > 0) {
					luiji_alert('success', '保存成功！');
					window.setTimeout(function() {
						window.location = '<?php echo config_item('app_url'); ?>task/index';
					}, 1000);
				} else {
					nn_enableButton(_btn, '保存');
					luiji_alert('error', '保存失败，请稍后重试~');
				}
			},
			'json'
		);
	});
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="编辑排版表" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>编辑排版表</h1>
	<a href="../task/index" data-icon="back" data-ajax="false">返回</a>
</div>
<div id="calendar-edit" class="gh-center">
	
	<div class="cal-day f-cb">
		<div class="cal-label f-fl">星期一<br /><?php echo $jobs[0]['day']; ?></div>
		<div class="cal-setting f-fr">
			<div class="setting-item f-cb line">
				<div class="time f-fl">上午</div>
				<select name="setting-1-1 f-fr" id="setting-1-1" data-theme="c">
					<option value="">请选择</option>
					<option value="白班" <?php echo $jobs[0]['am'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊" <?php echo $jobs[0]['am'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="休息" <?php echo $jobs[0]['am'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
			<div class="setting-item f-cb">
				<div class="time f-fl">下午</div>
				<select name="setting-1-2 f-fr" id="setting-1-2" data-theme="c">
					<option value="">请选择</option>
					<option value="白班" <?php echo $jobs[0]['pm'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊" <?php echo $jobs[0]['pm'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="夜班" <?php echo $jobs[0]['pm'] == '夜班' ? 'selected' : ''; ?>>夜班</option>
					<option value="休息" <?php echo $jobs[0]['pm'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cal-day f-cb">
		<div class="cal-label f-fl">星期二<br /><?php echo $jobs[1]['day']; ?></div>
		<div class="cal-setting f-fr">
			<div class="setting-item f-cb line">
				<div class="time f-fl">上午</div>
				<select name="setting-2-1 f-fr" id="setting-2-1" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[1]['am'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[1]['am'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="休息"<?php echo $jobs[1]['am'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
			<div class="setting-item f-cb">
				<div class="time f-fl">下午</div>
				<select name="setting-2-2 f-fr" id="setting-2-2" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[1]['pm'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[1]['pm'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="夜班"<?php echo $jobs[1]['pm'] == '夜班' ? 'selected' : ''; ?>>夜班</option>
					<option value="休息"<?php echo $jobs[1]['pm'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cal-day f-cb">
		<div class="cal-label f-fl">星期三<br /><?php echo $jobs[2]['day']; ?></div>
		<div class="cal-setting f-fr">
			<div class="setting-item f-cb line">
				<div class="time f-fl">上午</div>
				<select name="setting-3-1 f-fr" id="setting-3-1" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[2]['am'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[2]['am'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="休息"<?php echo $jobs[2]['am'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
			<div class="setting-item f-cb">
				<div class="time f-fl">下午</div>
				<select name="setting-3-2 f-fr" id="setting-3-2" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[2]['pm'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[2]['pm'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="夜班"<?php echo $jobs[2]['pm'] == '夜班' ? 'selected' : ''; ?>>夜班</option>
					<option value="休息"<?php echo $jobs[2]['pm'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cal-day f-cb">
		<div class="cal-label f-fl">星期四<br /><?php echo $jobs[3]['day']; ?></div>
		<div class="cal-setting f-fr">
			<div class="setting-item f-cb line">
				<div class="time f-fl">上午</div>
				<select name="setting-4-1 f-fr" id="setting-4-1" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[3]['am'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[3]['am'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="休息"<?php echo $jobs[3]['am'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
			<div class="setting-item f-cb">
				<div class="time f-fl">下午</div>
				<select name="setting-4-2 f-fr" id="setting-4-2" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[3]['pm'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[3]['pm'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="夜班"<?php echo $jobs[3]['pm'] == '夜班' ? 'selected' : ''; ?>>夜班</option>
					<option value="休息"<?php echo $jobs[3]['pm'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cal-day f-cb">
		<div class="cal-label f-fl">星期五<br /><?php echo $jobs[4]['day']; ?></div>
		<div class="cal-setting f-fr">
			<div class="setting-item f-cb line">
				<div class="time f-fl">上午</div>
				<select name="setting-5-1 f-fr" id="setting-5-1" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[4]['am'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[4]['am'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="休息"<?php echo $jobs[4]['am'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
			<div class="setting-item f-cb">
				<div class="time f-fl">下午</div>
				<select name="setting-5-2 f-fr" id="setting-5-2" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[4]['pm'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[4]['pm'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="夜班"<?php echo $jobs[4]['pm'] == '夜班' ? 'selected' : ''; ?>>夜班</option>
					<option value="休息"<?php echo $jobs[4]['pm'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cal-day f-cb">
		<div class="cal-label f-fl">星期六<br /><?php echo $jobs[5]['day']; ?></div>
		<div class="cal-setting f-fr">
			<div class="setting-item f-cb line">
				<div class="time f-fl">上午</div>
				<select name="setting-6-1 f-fr" id="setting-6-1" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[5]['am'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[5]['am'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="休息"<?php echo $jobs[5]['am'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
			<div class="setting-item f-cb">
				<div class="time f-fl">下午</div>
				<select name="setting-6-2 f-fr" id="setting-6-2" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[5]['pm'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[5]['pm'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="夜班"<?php echo $jobs[5]['pm'] == '夜班' ? 'selected' : ''; ?>>夜班</option>
					<option value="休息"<?php echo $jobs[5]['pm'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
		</div>
	</div>

	<div class="cal-day f-cb">
		<div class="cal-label f-fl">星期日<br /><?php echo $jobs[6]['day']; ?></div>
		<div class="cal-setting f-fr">
			<div class="setting-item f-cb line">
				<div class="time f-fl">上午</div>
				<select name="setting-7-1 f-fr" id="setting-7-1" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[6]['am'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[6]['am'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="休息"<?php echo $jobs[6]['am'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
			<div class="setting-item f-cb">
				<div class="time f-fl">下午</div>
				<select name="setting-7-2 f-fr" id="setting-7-2" data-theme="c">
					<option value="">请选择</option>
					<option value="白班"<?php echo $jobs[6]['pm'] == '白班' ? 'selected' : ''; ?>>白班</option>
					<option value="门诊"<?php echo $jobs[6]['pm'] == '门诊' ? 'selected' : ''; ?>>门诊</option>
					<option value="夜班"<?php echo $jobs[6]['pm'] == '夜班' ? 'selected' : ''; ?>>夜班</option>
					<option value="休息"<?php echo $jobs[6]['pm'] == '休息' ? 'selected' : ''; ?>>休息</option>
				</select>
			</div>
		</div>
	</div>
	
	<div class="save-control"><button class="ui-btn ui-corner-all" id="submit">保存</button></div>

</div>

<?php
$this->load->view('include/footer');
?>