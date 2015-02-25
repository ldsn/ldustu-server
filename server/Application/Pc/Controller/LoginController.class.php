<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class LoginController extends Controller {
	/*
	*登陆首页
	*登陆功能页面
	*退出
	*/
	public function index(){
		$this->display('Login/Login');
	}
	public function login(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$where = array(
			'username'=>$username,
			'password'=>$password,
			);
		$user = D('user');
		$result = $user->where($where)->count();
		cookie('username',$username,3600);
		$more['login_time'] = time();
		$more['login_style'] = LoginStyle();
		$user->where($where)->data($more)->save();
		if($result&&$result!=''&&cookie('username')){
			//dump($more);
			$this->success('登陆成功','/home/index/index');
		}else{
			$this->error('登陆失败');
		}
	}
	public function logout(){
		cookie('username',null);
		redirect('/home/index/index', 2, ' 退出成功，页面跳转中 ...');
	}
}