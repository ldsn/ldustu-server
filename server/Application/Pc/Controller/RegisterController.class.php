<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class RegisterController extends Controller {
	/*
	*注册页面
	*注册功能
	*/
	public function index(){
		
		//dump(M('user')->select());
		//session('name','jason');
		$this->display('Register/Register');
	}
	public function Register(){
		if(check_verify($_POST['verify'])){ //判断验证码
			$username = $_POST['username'];
			$password =  $_POST['password'];
			$repassword = $_POST['repassword'];
			$email = $_POST['email'];
			$qq = $_POST['qq'];
			$time = time();
			$loginWay = LoginStyle();
			$data = array(
				'username' =>$username,
				'passwd' =>$password,
				'email' =>$email,
				'qq' =>$qq,
				'sign_time' =>$time,
				'login_time'=>$time,
				'login_style'=>$loginWay,
				);
			$user = D('user');
			$result = $user->data($data)->add();
			if($result){
				$this->success('注册成功','/home/Login/index');
			}else{
				$this->error('注册失败');
			}
		}else{
			$this->error('验证码错误');
		}
	}
}