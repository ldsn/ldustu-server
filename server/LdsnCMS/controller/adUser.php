<?php
class adUser extends spController
{
	//用户相关
	function addUser(){ //增加用户
		//1、未增加变量过滤函数
		//2、接收模板变量 增加 md5加密 密码
		header("Content-Type:text/html; charset=utf-8");
		echo '增加用户页面';
		$username = 'jason';
		$password = '123456';
		$repeat_word = '123456';
		$email = '351192873@qq.com';
		$qq = '351192873';
		//获取用户的IP
		$userIp = GetIP();
		$args = array(
			'username' => $username,
			'password' => $password,
			'confirm_password' => $repeat_word,
			'email' => $email,
			);
		$login_style = loginStyle();
		$ldsn_user = spClass('ldsn_user');
		$checkResult = $ldsn_user->spVerifier($args);
		if($checkResult){
			$SmatyOutput = json_encode($checkResult);
		}else{
			$newrow = array(
				'username' =>$username,
				'passwd' =>$password,
				'sign_ip' =>$userIp,
				'login_ip' =>$userIp,
				'email' =>$email,
				'qq' =>$qq,
				'login_style' =>$login_style,
				);
			$result = $ldsn_user->create($newrow);
			if($result){
				$SmatyOutput = json_encode('注册成功');
			}else{
				$SmatyOutput = json_encode('注册失败');
			}
			print_r($SmatyOutput);
		}

	}
	function UserLogin(){ //用户登陆处理
		$ldsn_user = spClass('ldsn_user');
		$username = 'jason';
		$password =  '123456';
		$login_ip = GetIp();
		$login_style = loginStyle();
		$ldsn_user = spClass('ldsn_user');
		$condition = array(
			'username' => $username,
			);
		$searchResult = $ldsn_user->find($condition);
		$newrow = array(
				'login_ip' => $login_ip,
				'login_style' => $login_style,
				)
		$insertResult = $ldsn_user->update($newrow);
		if($searchResult&&$insertResult){
			$SmatyOutput = json_encode('登陆成功正在跳转');
		}else{
			

			$SmatyOutput = json_encode('登陆失败返回登陆页面'.$login_ip.$login_style);
		}
	}
	function changeUser(){ //用户更改密码
		header("Content-Type:text/html; charset=utf-8");
		//功能项目待开发，暂停更改密码使用，加入邮箱验证系统
			
	}
	function searchUser(){ //查找用户 -- 待开发
		
	}
	
}