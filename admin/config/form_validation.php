<?php
$config = array(
	'add_doctor' => array(
		array(
			'field' => 'username',
			'label' => '用户名',
			'rules' => 'required|min_length[2]|max_length[11]'
		),
		array(
			'field' => 'password',
			'label' => '密码',
			'rules' => 'required|min_length[6]|max_length[25]'
		),
		array(
			'field' => 'email',
			'label' => '邮箱',
			'rules' => 'valid_email'
		),
		array(
			'field' => 'mobile',
			'label' => '手机号',
			'rules' => 'required|is_unique[doctor.mobile]|is_natural_no_zero|exact_length[11]'
		)
	),
);