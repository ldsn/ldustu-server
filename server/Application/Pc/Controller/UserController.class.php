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
		$article_model  = D('Article');
		$user_id  = I('get.user_id')?I('get.user_id'):0;
		//判断权限
		if($user_id == session('user_info.user_id')){
			$is_me = true;
			$this->assign('is_me',$is_me);
			//提取评论你
		}
		$comment_dom  = D('Comment');
		$comment = $comment_dom->where(array('user_id'=>$user_id))->getList();
		foreach ($comment as $key => $value) {
			$article_com 				  = $article_model->where(array('article_id'=>$comment[$key]['article_id']))->select();
			$comment[$key]['article_title'] = $article_com[0]['title'];
            $comment[$key]['create_time_string'] = date('<b>m/d</b> <b>H:i</b>', $article[$k]['create_time']);
		}
		$home_info= $user->userinfo($user_id);
		$user_info= $user->userinfo(session('user_info.user_id'));
		//提取用户发表文章
		
		$article = $article_model->where(array('user_id'=>$user_id))->getList();
        foreach ($article as $k => $v) {
            $article[$k]['create_time_string'] = date('<b>m/d</b> <b>H:i</b>', $article[$k]['create_time']);
        }

// 通用
        $columnModel            = D('Column');
        $column                 = $columnModel->getall();
        
        $ad_model           = D('Ad');


        $hotList                = $article_model->getList(array('status'=>1),null,6,'view_num desc');
        $ad_aside     = $ad_model->getad('aside');
        $ad_header     = $ad_model->getad('header');


        $this->assign('json_user_info', json_encode($user_info));
        $this->assign('ad_aside',$ad_aside);
        $this->assign('ad_header',$ad_header);
        $this->assign('hotList', $hotList);
// 通用结束


		//信息打到模版变量
		$this->assign('comment',$comment);
		$this->assign('articleList',$article);
		$this->assign('home_info',$home_info);
		$this->assign('user_info',$user_info);
        $this->assign('level_status',$user_info['level_status']);
		$this->display('ldsn-pc/page/home');
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
			$is_me = true;
			$this->assign('is_me',$is_me);
		}
		$home_info = $user->userinfo($user_id);
		$user_info = $user->userinfo(session('user_info.user_id'));



// 通用
        $columnModel            = D('Column');
        $column                 = $columnModel->getall();
        
        $ad_model           = D('Ad');


        $hotList                = $article_model->getList(array('status'=>1),null,6,'view_num desc');
        $ad_aside     = $ad_model->getad('aside');
        $ad_header     = $ad_model->getad('header');


        $this->assign('json_user_info', json_encode($user_info));
        $this->assign('ad_aside',$ad_aside);
        $this->assign('ad_header',$ad_header);
        $this->assign('hotList', $hotList);
// 通用结束

		//用户信息打到模版变量
		$this->assign('home_info',$home_info);
		$this->assign('user_info',$user_info);
        $this->assign('level_status',$user_info['level_status']);
		$this->display('ldsn-pc/page/info');
	}
}