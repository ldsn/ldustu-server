<?php
return array(
	//'配置项'=>'配置值'
	'name' =>'jason',
//	'URL_MODEL'=>0,
    'TMPL_ENGINE_TYPE'=>'Smarty',
    'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
    'TMPL_ENGINE_CONFIG'=>array(
        'plugins_dir'=>'./Application/Wap/Plugins/',
        'template_dir'=>'./Application/Wap/Temp/',
        'config_dir'=>'./Application/Wap/Config/',
        'left_delimiter'=>'{%',
        'right_delimiter'=>'%}'
    ),
);