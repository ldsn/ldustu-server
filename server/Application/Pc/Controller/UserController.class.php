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
		$article  = D('Article');
		$user_id  = I('get.user_id')?I('get.user_id'):0;
		//判断权限
		if($user_id == session('user_info.user_id')){
			$is_me = true;
			$this->assign('is_me',$is_me);
			//提取评论你
		}
		$comment  = M('Comment');
		$com_info = $comment->where(array('user_id'=>$user_id))->select();
		foreach ($com_info as $key => $value) {
			$article_com 				  = $article->where(array('article_id'=>$com_info[$key]['article_id']))->getList();
			$com_info[$key]['article_title'] = $article_com['title'];
		}
		$this->assign('com_info',$com_info);
		$user_info= $user->userinfo($user_id);
		//提取用户发表文章
		
		$art_info = $article->where(array('user_id'=>$user_id))->getList();

		//信息打到模版变量
		$this->assign('art_info',$art_info);
		$this->assign('user_info',$user_info);
		$this->display();
	}
	/**
	 * 用户个人信息
	 * @author Jason
	 */
	public function info_center()
	{
		$user     = D('User');
		$user_id  = I('get.user_id')?I('get.user_id'):0;
		//判断权限
		if($user_id == session('user_info.user_id')){
			$is_me = 'is_me';
			$this->assign('is_me',$is_me);
		}
		$user_info = $user->userinfo($user_id);
		//用户信息打到模版变量
		$this->assign('user_info',$user_info);
		$this->display();
	}
}