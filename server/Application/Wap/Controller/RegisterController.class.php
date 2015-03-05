<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class RegisterController extends Controller {
	/*
	*注册页面
	*注册功能
	*/
	public function Register(){
		if(check_verify($_POST['verify'])){ //判断验证码
			$password =  $_POST['password'];
			$repassword = $_POST['repassword'];
			if($password == $repassword){
				$mailResult = checkMail($_POST['mail']);
				if($mailResult&&$mailResult!=''){
					$username = $_POST['username'];
					$qq = $_POST['qq'];
					$time = time();
					$loginWay = LoginStyle();
					$data = array(
						'username' =>$username,
						'passwd' =>md5($password),
						'email' =>$email,
						'qq' =>$qq,
						'sign_time' =>$time,
						'login_time'=>$time,
						'login_style'=>$loginWay,
						);
					$user = D('user');
					$result = $user->data($data)->add();
				}else{
					$returnJson['error'] = 1007;
				}
				
			}else{
				$returnJson['error'] = 1006;
			}
			
		}else{
			$returnJson['error'] = 1005;
		}
		print_r(json_encode($returnJson));
	}
	public function checkName(){
		$username  = $_GET['username'];
		$user = D('user');
		$where['username'] = $username; 
		$result = $user->where($where)->count();
		if($result&&$result!=''){
			$returnJson['error'] = 0;
		}else{
			$returnJson['error'] = 1002;
		}
		print_r(json_encode($returnJson));
	}
	public function checkMail($mail){
		$pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
		$result = preg_match($pattern_test,$mail);
		if($result = 1){
			$returnJson['error'] = 0;
		}else{
			$returnJson['error'] = 1007;
		}
	}
	public function checkPswd(){
		$password = $_POST['password'];
		$repassword  = $_POST['repassword'];
		if($password == $repassword){
			$returnJson['error'] = 0;
		}else{
			$returnJson['error'] = 1006;
		}
	}

}