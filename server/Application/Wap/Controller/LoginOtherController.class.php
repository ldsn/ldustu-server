<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class LoginOtherController extends Controller {
	/*
	*登陆首页
	*登陆功能页面
	*退出
	*/
	public function login(){
		$qqopenid = I('get.qqopenid');
		$cookieTime = I('post.cookieTime');
		$user = D('user');
		if(!isset($qqopenid)){
				$returnJson = array(
				'error' => 1001,//未注册
				);
		}else{
				$where['qqopenid'] = $qqopenid;
				$userResult = $user->where($where)->find();
				session('id',$userResult['id']);
				if($cookieTime){
						$data = $userResult['id'];
						cookie('data',$data,$cookieTime);
					}
				if($userResult&&$userResult!=''){
					$returnJson['error'] = 0;
				}else{
					$returnJson['error'] = 1002;//登录出错
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