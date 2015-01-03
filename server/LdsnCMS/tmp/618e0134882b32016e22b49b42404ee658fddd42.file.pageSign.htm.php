<?php /* Smarty version Smarty-3.0.8, created on 2015-01-03 15:04:51
         compiled from "/home/wwwroot/default/server/LdsnCMS/tpl/pageSign.htm" */ ?>
<?php /*%%SmartyHeaderCode:102760472954a7949351f2b3-52136678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '618e0134882b32016e22b49b42404ee658fddd42' => 
    array (
      0 => '/home/wwwroot/default/server/LdsnCMS/tpl/pageSign.htm',
      1 => 1420268287,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102760472954a7949351f2b3-52136678',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
　　<title>change the admin </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<link type="text/css" rel="stylesheet" href="CSS文件路径" />
	<script type="text/javascript" src="JS文件路径"></script>
</head>
<body>
	<div class="LoginForm">
		<form action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['spUrl'][0][0]->__template_spUrl(array('c'=>'adUser','a'=>'adminSignin'),$_smarty_tpl);?>
" method="POST">
			<input type="text" name="name"/><br/>
			<input type="password" name="passwd"/><br/>
			<input type="hidden" name="originConfirm" value="<?php echo $_smarty_tpl->getVariable('confirm')->value;?>
" />
			<h3><?php echo $_smarty_tpl->getVariable('confirm')->value;?>
</h3>
			<select name="UserLevel">
				<option value="1">超级管理员</option>
				<option value="2">频道管理员</option>
				<option value="3">信息审核员</option>
				<option value="4">信息发布员</option>
			</select>
			<input type="text" name="confirm"/ >
			<input type="submit" name="submit" value="submit" />
		</form>
	</div>
</body>
</html>