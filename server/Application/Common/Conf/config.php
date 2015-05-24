<?php
return array(
        //'配置项'=>'配置值'
    'URL_HTML_SUFFIX' =>'',
    'TMPL_ENGINE_TYPE'      =>'Smarty',
    'TMPL_TEMPLATE_SUFFIX'  =>'.tpl',
    'TMPL_ENGINE_CONFIG'    =>array(
        'plugins_dir'       => './Application/Wap/View/Plugins/',
        'config_dir'        => './Application/Wap/View/Config/',
        'left_delimiter'    => '{%',
        'right_delimiter'   => '%}'
    ),
    'MODULE_ALLOW_LIST'     =>  array(
        'Pc',
        'Api',
    ),
    'DEFAULT_MODULE'        =>  'Pc',
    'APP_SUB_DOMAIN_DEPLOY' =>    1, // 开启子域名或者IP配置

    'URL_MODEL'             =>1,  //url模式  pathinfo
    'URL_CASE_INSENSITIVE'  => true, //URL不区分大小写
    'SESSION_AUTO_START'    => true,//是否开启session
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'ldustu',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'woai110..',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'ldsn_',    // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    'DEFAULT_FILTER'        => 'strip_tags,htmlspecialchars', //默认过滤器
);
