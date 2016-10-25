<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>糖尿病关怀</title>
<link href="<?php echo base_url(); ?>public/js/bootstrap-2.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/base.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/admin_sale.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-2.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function() {
    $('#submit').click(function() {
		var mobile = $('#mobile').val(),
			password = $('#password').val();
		if(!password) {
			alert('请输入登录密码！');
			return false;
		}
	});
});
</script>
<style type="text/css">
body{background-color:#3A5169;padding-top:150px;}
.wrap{width:500px;min-width:500px;margin:0 auto;padding:30px;}
</style>
</head>
<body>
<div class="wrap">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="login-form">
				<form class="form-horizontal" action="./login" method="post">
					<fieldset>
						<div id="legend" class="">
							<legend class="">科室主任登录</legend>
						</div>
						<div class="control-group">
							<label class="control-label" for="mobile">登录手机：</label>
							<div class="controls">
								<input type="text" placeholder="输入登录手机" class="input-xlarge" name="mobile" id="mobile" maxlength="20">
								<p class="help-block" id="help-mobile"></p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password">登录密码：</label>
							<div class="controls">
								<input type="password" placeholder="输入登录密码" class="input-xlarge" name="password" id="password" maxlength="20">
								<p class="help-block" id="help-password"></p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label"></label>
							<div class="controls">
								<button type="submit" class="btn btn-primary" id="submit">登录</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			
			
		</div>
	</div>
</div>
</div>
</body>
</html>