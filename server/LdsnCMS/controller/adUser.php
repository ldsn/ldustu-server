<?php
class adUser extends spController
{
	//用户相关
	function addUser(){ //增加用户
		//1、未增加变量过滤函数
		header("Content-Type:text/html; charset=utf-8");
		echo '增加用户页面';
		$username = 'jason';
		$password = '123456';
		$email = '';
		$ip = '';
		//获取用户的IP


	}
	function deleteUser(){ //删除用户

	}
	function changeUser(){ //用户更改密码

	}
	function searchUser(){ //查找用户 -- 待开发
		
	}
	
}