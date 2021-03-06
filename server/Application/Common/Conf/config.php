<?php
return array(
    //前端模版配置
    'URL_HTML_SUFFIX' =>'',
    'TMPL_ENGINE_TYPE'      =>'Smarty',
    'TMPL_TEMPLATE_SUFFIX'  =>'.tpl',
    'TMPL_CACHE_ON'  => false,
    'TMPL_ENGINE_CONFIG'    =>array(
        'plugins_dir'       => './Application/Pc/View/Plugins/',
        'config_dir'        => './Application/Pc/View/Config/',
        'left_delimiter'    => '{%',
        'right_delimiter'   => '%}'
    ),
    //被允许的模块列表
    'MODULE_ALLOW_LIST'     =>  array(
        'Pc',
        'Api'
    ),
    'DEFAULT_MODULE'        =>  'Pc',
    //路由设置
    'URL_ROUTER_ON'   => true,          //开启路由
    'URL_ROUTE_RULES' => array( //定义路由规则
        'category/:column_id' => 'index/listArticle',
        'arc/:aid' => 'index/articleArticle',
        'publish' => 'index/publishArticle',
        'home/:user_id' => 'user/index',
        'info/:user_id' => 'user/info_center'
     ),
    'URL_MODEL'             =>1,  //url模式  pathinfo
    'URL_CASE_INSENSITIVE'  => true, //URL不区分大小写
    'SESSION_AUTO_START'    => true,//是否开启session
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  $_SERVER['LDSN_DB_NAME'],          // 数据库名
    'DB_USER'               =>  $_SERVER['LDSN_DB_USER'],      // 用户名
    'DB_PWD'                =>  $_SERVER['LDSN_DB_PWD'],          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'ldsn_',    // 数据库表前缀
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    'DEFAULT_FILTER'        => 'strip_tags,htmlspecialchars', //默认过滤器
);
