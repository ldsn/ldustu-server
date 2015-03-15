<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class RegisterOtherController extends Controller {
	/*
	*注册页面
	*注册功能
	*/
	public function register(){
		// var_dump($this->checktelphone(I('post.tel')));
		if($this->checktelphone(I('post.tel')) == 0){ //判断手机
			if($this->checkMail(I('post.email')) == 0){
				if($this->checkPswd(I('post.password')) == 0){
					if($this->checkName(I('post.username')) == 0){
					$data = array(
						'username' =>I('post.username'),
						'passwd' =>md5(I('post.passwd')),
						'email' =>I('post.email'),
						'qq' =>I('post.qq'),
						'telphone' =>I('post.telphone'),
						'sign_time' =>I('post.sign_time'),
						'head_pic' =>I('post.sign_time'),
						'qqopenid' =>I('post.qqopenid'),
						'login_time'=>I('post.login_time'),
						'login_style'=>I('post.login_style'),
						);
					// var_dump($data);
					$user = M('user');
					$result = $user->data($data)->add();
					session('id',$result);
					$returnJson['error'] = 0;
				}else{
					$returnJson['error'] = 1002;
				}
				}else{
					$returnJson['error'] = 1006;
				}
				
			}else{
				$returnJson['error'] = 1007;
			}
			
		}else{
			$returnJson['error'] = 1012;
		}
		$this->ajaxReturn($returnJson);
	}
	public function checktelphone($tel){
		$pattern_test = "/^1[3|4|5|7|8][0-9]\d{8}$/";
		$result = preg_match($pattern_test,$tel);
		if($result = 1){
			$returnJson['error'] = 0;
		}else{
			$returnJson['error'] = 1012;
		}
		return $returnJson[error];
	}
	public function checkName(){
		$username  = I('get.username');
		$user = D('user');
		$where['username'] = $username; 
		$result = $user->where($where)->count();
		if($result == 0){
			$returnJson['error'] = 0;
		}else{
			$returnJson['error'] = 1002;
		}
		return $returnJson[error];
	}
	public function checkMail($email){
		$pattern_test = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
		$result = preg_match($pattern_test,$mail);
		if($result = 1){
			$user = D('user');
			$where['email'] = $email; 
			$result2 = $user->where($where)->count();
			if($result2 == 0){
				$returnJson['error'] = 0;
			}else{
				$returnJson['error'] = 1002;
			}
		}
		return $returnJson[error];
	}
	public function checkPswd($pass){
		if(strlen($pass) >= 6){
			$returnJson['error'] = 0;
		}else{
			$returnJson['error'] = 1006;
		}
		return $returnJson[error];
	}

}