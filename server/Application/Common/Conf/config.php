<?php
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST'     =>  array(
		'Pc',
		'Wap',
	),
	'DEFAULT_MODULE'        =>  'Pc',
	'URL_MODEL'=>1,  //url模式  pathinfo
	'URL_CASE_INSENSITIVE' => true, //URL不区分大小写
	'SESSION_AUTO_START' => true,//是否开启session
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  $_SERVER['LDSN_HOST'], // 服务器地址
	'DB_NAME'               =>  $_SERVER['LDSN_DBNAME'],          // 数据库名
	'DB_USER'               =>  $_SERVER['LDSN_USER'],      // 用户名
	'DB_PWD'                =>  $_SERVER['LDSN_PASSWD'],          // 密码
	'DB_PORT'               =>  '3306',        // 端口
	'DB_PREFIX'             =>  'ldsn_',    // 数据库表前缀
	'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
	'TMPL_L_DELIM'=>'{%',
	'TMPL_R_DELIM'=>'%}',	
	'TMPL_PARSE_STRING' =>array(
				),
);