<?php
$spConfig = array(
	"db" => array(//数据库配置
		'drive' => 'mysql',//数据库类型
		'host' => $_SERVER['LDSN_HOST'],//数据库地址
		'login' => $_SERVER['LDSN_USER'],//数据库用户名
		'password' => $_SERVER['LDSN_PASSWD'],//数据库密码
		'database' => $_SERVER['LDSN_DBNAME'],
	),
	'view' => array(
		'enabled' => TRUE, // 开启视图
		'config' =>array(
			'template_dir' => APP_PATH.'/tpl', // 模板目录
			'compile_dir' => APP_PATH.'/tmp', // 编译目录
			'cache_dir' => APP_PATH.'/tmp', // 缓存目录
			'left_delimiter' => '{%',  // smarty左限定符
			'right_delimiter' => '%}', // smarty右限定符
		),
		),
);
