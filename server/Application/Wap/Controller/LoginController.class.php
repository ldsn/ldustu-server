<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class LoginController extends Controller {
	/*
	*登陆首页
	*登陆功能页面
	*退出
	*/
	public function login(){
		$username = I('post.username');
		$password = I('post.password');
		$openid = I('post.openid');
		if(!isset($username)||!isset($password)){
			if(!isset($openid)){
				$returnJson = array(
				'error' => 1001,
				);
			}
			else{
				$user = D('user');
				$where['openid'] = $openid;
				$userResult = $user->where($where)->find();
				//dump($userResult);
				if($userResult&&$userResult!=''){
					$returnJson['error'] = 0;
				}else{
					$returnJson['error'] = 1002;
				}
			}
		}else{	
			$where['username'] = $username;
			$result = $user->where($where)->find();
			if($result&&$result['passwd']==md5($password)){
				session('id',$result['id']);
			}
			$more['login_time'] = time();
			$more['login_style'] = LoginStyle();
			$user->where($where)->data($more)->save();
			if($result&&$result!=''&&cookie('id')){
				//dump($more);
				$returnJson = array(
					'error'=>0,
					);
			}elseif(!$result||$result = ''){
				$returnJson = array(
					'error'=>1002,
					);
			}	
		}
		
		$this->ajaxReturn($returnJson);
	}
	public function logout(){
		session('id',null);
		$returnJson = array(
				'error'=>0,
				);
		$this->ajaxReturn($returnJson);
	}
	public function loginJudge(){ 
	   	$id = session('id');
    		if($id&&$id!=''){ //判断是否登陆过
    			$returnJson = array(
    				'error' =>0,
    				);
    		}else{
    			$returnJson = array(
    				'error' =>1003,
    				);
    		}
    		$this->ajaxReturn($returnJson);
	   }
}