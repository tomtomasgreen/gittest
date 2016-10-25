<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('include/header');
?>
<script type="text/javascript"> 
$(function() {
	var
		total_questions = <?php echo count($questions); ?>,
		current_answered = 0,
		current_question = 0,
		questions = false
	;
	$.post('../load_collect',
		{
			id: <?php echo $collect['id']; ?>
		}, function(data) {
			questions = data;
			init_questions();
		},
		'json'
	);
	function init_questions() {
		for(var i = 0; i < total_questions; i++) {
			if(questions[i].answer != '') {
				current_answered++;
				$('#navigation-panel .question-item-nav').eq(i).addClass('answered').find('span').text('已答');
			}
		}
		
		$('.question').hide().eq(current_question).show();
		$('#next').show();
		progress();
		$('#submit').show();
		
		$('#prev').click(function() {
			submit_current(current_question, function() {
				$('#next').show();
				current_question--;
				if(current_question <= 0) {
					current_question = 0;
					$('#prev').hide();
				}
				$('.question').hide().eq(current_question).show();
			});
		});
		$('#next').click(function() {
			submit_current(current_question, function () {
				$('#prev').show();
				current_question++;
				if(current_question >= total_questions - 1) {
					current_question = total_questions - 1;
					$('#next').hide();
				}
				$('.question').hide().eq(current_question).show();
			});
		});
	}
	$('#save_return').click(function() {
		submit_current(current_question);
	});
	$('#submit').click(function() {
		var _btn = $(this);
		nn_disableButton(_btn, '正在提交...');
		submit_current(current_question, function() {
			if(current_answered < 40) {
				luiji_alert('error', '尚未回答所有问题！');
				nn_enableButton(_btn, '提交');
				return false;
			} else {
				$.post('../submit_collect',
					{
						collectid: <?php echo $collect['id']; ?>
					}, function(data) {
						if(data.result >= 0) {
							luiji_alert('success', '提交成功！');
							window.setTimeout(function() {
								window.location = '../result/<?php echo $collect['id']; ?>';
							}, 1000);
						} else {
							nn_enableButton(_btn, '提交');
							luiji_alert('error', '提交失败，请稍后重试~');
						}
					},
					'json'
				);
			}
		});
	});
	function submit_current(current, func) {
		// console.log('提交了');
		var answer = $.trim($('#answer-textarea-' + (current + 1)).val());
		if(answer.length > 0 && answer.length < 20) {
			luiji_alert('error', '回答不少于20个字！');
			nn_enableButton($('#submit'), '提交');
			return false;
		} else {
			$.post('../submit_answer',
				{
					id: questions[current].id,
					answer: answer
				}, function(data) {
					if(data.result == -1) {
						luiji_alert('error', '回答中包含敏感词');
						nn_enableButton($('#submit'), '提交');
						return false;
					} else {
						questions[current].answer = answer;
						current_answered = 0;
						$('#navigation-panel .question-item-nav').removeClass('answered').find('span').text('未答');
						for(var i = 0; i < total_questions; i++) {
							if(questions[i].answer != '') {
								current_answered++;
								$('#navigation-panel .question-item-nav').eq(i).addClass('answered').find('span').text('已答');
							}
						}
						progress();
						if(func) {
							func();
						}
					}
				},
				'json'
			);
		}
	}
	
	$('#navigation-panel .question-item-nav').click(function() {
		// console.log('点击了');
		var _index = $(this).data('index');
		submit_current(current_question, function() {
			// console.log('提交成功');
			if(_index == 0) {
				$('#prev').hide();
				$('#next').show();
			} else if(_index == 39) {
				$('#prev').show();
				$('#next').hide();
			} else {
				$('#prev').show();
				$('#next').show();
			}
			current_question = _index;
			$('.question').hide().eq(current_question).show();
		});
	});
	function progress() {
		$('#current_num').text(current_answered);
		var _progress = current_answered / total_questions * 100;
		$('.current-progress').animate({'width': _progress + '%'}, 300);
		if(current_answered == total_questions) {
			// $('#submit').show();
		} else {
			// $('#submit').hide();
		}
	}
});
</script>
</head>
<body data-role="page" class="f-ff1" data-quicklinks="true" data-title="糖友智库" data-theme="b">
<div data-role="header" data-position="fixed" class="gh-center">
	<h1>糖友智库</h1>
	<a href="../index" data-icon="back" data-ajax="false" id="save_return">保存返回</a>
	<a href="#navigation-panel" data-icon="bullets">切题</a>
</div>
<div id="collect-play" class="gh-center">

	<div id="collect-play-control">
		<div class="progress-btn">
			<div class="submit-box f-cb">
				<button class="ui-btn ui-btn-inline ui-btn-g f-br4 f-fr" id="submit">提交</button>
			</div>
		</div>
	</div>
	
	<div class="questions">
		<?php
		for($i = 0; $i < count($questions); $i++) {
		?>
		<div class="question">
			<div class="q-label">第 <?php echo $i + 1; ?> 题</div>
			<div class="q-content"><?php echo $questions[$i]['content']; ?></div>
			<div class="q-answer">
				<label for="answer-textarea-<?php echo $i + 1; ?>">我的回答</label>
				<div class="formarea">
					<span>这位患者您好！</span>
					<textarea name="answer-textarea" class="answer-textarea" id="answer-textarea-<?php echo $i + 1; ?>" placeholder="回答不少于20个字！"><?php echo $questions[$i]['answer']; ?></textarea>
					<span>希望能对您有所帮助！（如果涉及诊疗与处方的问题，请到正规医院就诊）</span>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
	<div class="q-control f-cb">
		<a href="javascript:;" class="ui-btn ui-btn-inline ui-btn-g f-br4 f-fr" id="next" style="margin-left:6px;">下一题</a>
		<a href="javascript:;" class="ui-btn ui-btn-inline ui-btn-g f-br4 f-fr" id="prev">上一题</a>
	</div>
	
</div>
<div id="progress-text">
	<div class="text">已答：<span id="current_num">0</span> / <span id="total_num"><?php echo count($questions); ?></span></div>
	<div class="progress-bar"><div class="current-progress"></div></div>
</div>
<div data-role="panel" data-position-fixed="true" data-position="right" data-display="overlay" data-theme="f" id="navigation-panel">
	<ul data-role="listview">
		<li data-icon="delete"><a href="javascript:;" data-rel="close">关闭</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="0">第1题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="1">第2题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="2">第3题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="3">第4题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="4">第5题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="5">第6题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="6">第7题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="7">第8题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="8">第9题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="9">第10题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="10">第11题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="11">第12题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="12">第13题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="13">第14题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="14">第15题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="15">第16题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="16">第17题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="17">第18题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="18">第19题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="19">第20题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="20">第21题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="21">第22题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="22">第23题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="23">第24题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="24">第25题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="25">第26题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="26">第27题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="27">第28题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="28">第29题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="29">第30题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="30">第31题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="31">第32题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="32">第33题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="33">第34题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="34">第35题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="35">第36题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="36">第37题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="37">第38题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="38">第39题（<span>未答</span>）</a></li>
		<li><a class="question-item-nav" href="javascript:;" data-index="39">第40题（<span>未答</span>）</a></li>
	</ul>
</div>
<?php
$this->load->view('include/footer');
?>