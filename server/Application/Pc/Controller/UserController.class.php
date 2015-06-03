<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class UserController extends Controller{
	public function index()
	{	
		$user     = D('User');
		$user_id  = session('user_info.user_id')?session('user_info.user_id'):0;
		$userinfo = $user->userinfo($user_id);
		var_dump($userinfo);
		$this->display();
	}
}