<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class UserController extends Controller{
	/**
	 * 用户后台首页，提取用户信息
	 * @author Jason
	 */
	public function index()
	{	
		//提取用户信息
		$user     = D('User');
		$user_id  = session('user_info.user_id')?session('user_info.user_id'):0;
		$user_info= $user->userinfo($user_id);
		//提取用户发表文章
		$article  = M('Article');
		$article  = $article->where('user_id='.$user_id)->select();
		var_dump($article);
		//用户信息打到模版变量
		$this->assign('article',$article);
		$this->assign('user_info',$user_info);
		$this->display();
	}
	/**
	 * 用户个人中心
	 */
	public function info_center()
	{
		$user     = D('User');
		$user_id  = session('user_info.user_id')?session('user_info.user_id'):0;
		$user_info = $user->userinfo($user_id);
		//用户信息打到模版变量
		$this->assign('user_info',$user_info);
		$this->display();
	}
}