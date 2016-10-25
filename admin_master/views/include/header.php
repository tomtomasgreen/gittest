<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>糖尿病关怀</title>
<link href="<?php echo base_url(); ?>public/js/bootstrap-2.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/base.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/css/admin_master.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap-2.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/admin.js"></script>
</head>
<body>
<div class="wrap">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						<a href="javascript:;" class="brand">糖尿病关怀</a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
							<ul class="nav"></ul>
							<ul class="nav pull-right">
								<li class="dropdown">
									<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">管理员：主任 <strong class="caret"></strong></a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo config_item('app_url'); ?>master/editpwd">修改密码</a></li>
										<li><a href="<?php echo config_item('app_url'); ?>passport/logout">退出</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>