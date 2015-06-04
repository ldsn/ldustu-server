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
		$art_info = $article->where('user_id='.$user_id)->select();
		//提取评论你
		$comment  = M('Comment');
		$com_info = $comment->where('user_id='.$user_id)->select();
		foreach ($com_info as $key => $value) {
			$article_com 				  = $article->where('article_id='.$com_info[$key]['article_id'])->find();
			$com_info[$key]['article_title'] = $article_com['title'];
		}
		//信息打到模版变量
		$this->assign('com_info',$com_info);
		$this->assign('art_info',$art_info);
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