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
		$cookieTime = I('post.cookieTime');
		$user = D('user');
		if(!$username||!$password){
			if(!isset($openid)){
				$returnJson = array(
				'error' => 1001,
				);
			}else{
				$where['openid'] = $openid;
				$userResult = $user->where($where)->find();
				//dump($userResult);
				//echo '1';
				session('id',$userResult['id']);
				if($cookieTime&&$cookieTime!=''){
						$skey  = $userResult['username'];
						$data = md5($skey).$userResult['id'];
						cookie('data',$data,$cookieTime);
					}
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
			if($result&&$result!=''&&session('id')){
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
		cookie('id',null);
		$returnJson = array(
				'error'=>0,
				);
		$this->ajaxReturn($returnJson);
	}
	   public function checkLogin(){
	   	$data = cookie('data');
	   	$getSkey = substr($data, 0,32);
	   	$userId = substr($data,32);
	   	//$skey  = md5('ldsnwangluobu');
	   	if(session('id')){
		   		$result['error'] = 0;
		   }else{	
		   			$user = M('user');
			   		$where['id'] = $userId;
			   		$resultUser = $user->where($where)->field('id,username')->find();
			   		$skey = md5($resultUser['username']);
			   		if($skey == $getSkey){
			   			session('id',$resultUser['id']);
			   			$result['error'] = 0;
			   		}else{
			   			$result['error'] = 1003;
			   		}	
	   		}
	   	   $this->ajaxReturn($result);
	   }
}