<?php /* Smarty version Smarty-3.0.8, created on 2015-01-03 14:56:49
         compiled from "/home/wwwroot/default/server/LdsnCMS/tpl/pageLogin.htm" */ ?>
<?php /*%%SmartyHeaderCode:84751779754a792b1845913-98490582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a01e0b1b3ce1b092c5192ffa42b09263a91dba59' => 
    array (
      0 => '/home/wwwroot/default/server/LdsnCMS/tpl/pageLogin.htm',
      1 => 1420268143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84751779754a792b1845913-98490582',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
　　<title>网站标题 - Admin10000.com </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<link type="text/css" rel="stylesheet" href="CSS文件路径" />
	<script type="text/javascript" src="JS文件路径"></script>
</head>
<body>
	<form action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'adUser','a'=>'adminLogin'),$_smarty_tpl);?>
" method="POST">
	<input type="text" name="name" />
	<input type="password" name="passwd"/>
	<input type="submit" name="submit" value="submit"/>
	</form>
</body>
</html>