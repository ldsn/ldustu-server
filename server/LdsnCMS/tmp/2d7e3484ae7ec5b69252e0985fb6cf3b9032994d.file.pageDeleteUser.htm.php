<?php /* Smarty version Smarty-3.0.8, created on 2015-01-03 15:08:16
         compiled from "/home/wwwroot/default/server/LdsnCMS/tpl/pageDeleteUser.htm" */ ?>
<?php /*%%SmartyHeaderCode:151017267454a79560189d14-57225902%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d7e3484ae7ec5b69252e0985fb6cf3b9032994d' => 
    array (
      0 => '/home/wwwroot/default/server/LdsnCMS/tpl/pageDeleteUser.htm',
      1 => 1420268749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151017267454a79560189d14-57225902',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn">
<head>
　　<title>Delete_user </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="zh-CN" />
	<link type="text/css" rel="stylesheet" href="CSS文件路径" />
	<script type="text/javascript" src="JS文件路径"></script>
	<style>
	.center{
		width:1000px;
		margin:0 auto;
	}
	</style>
</head>
<body>
	<div class="center">
	 	<table>
	 	<?php  $_smarty_tpl->tpl_vars['one'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('SmartyOutput')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['one']->key => $_smarty_tpl->tpl_vars['one']->value){
?>
	 		<tr>
	 			<td><?php echo $_smarty_tpl->tpl_vars['one']->value['name'];?>
</td>
	 			<td><?php echo $_smarty_tpl->tpl_vars['one']->value['time'];?>
</td>
	 			<td><?php echo $_smarty_tpl->tpl_vars['one']->value['levelName'];?>
</td>
	 			
	 		</tr>
	 	<?php }} ?>
	 	</table>
	</div>
</body>
</html>