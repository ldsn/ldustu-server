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
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(!isset($username)||!isset($password)){
			$returnJson = array(
				'error' => 1001,
				);
		}else{
			$where = array(
			'username'=>$username,
			'password'=>$password,
			);
			$user = D('user');
			$result = $user->where($where)->field('passwd',true)->find();
			
			cookie('id',$result['id'],3600);
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
		
		print_r(json_encode($returnJson));
	}
	public function logout(){
		cookie('id',null);
		$returnJson = array(
				'error'=>0,
				);
		print_r(json_encode($returnJson));
	}
	public function loginJudge(){ 
	   	$id = cookie('id');
    		if($id&&$id!=''){ //判断是否登陆过
    			$returnJson = array(
    				'error' =>0,
    				);
    		}else{
    			$returnJson = array(
    				'error' =>1003,
    				);
    		}
    		print_r(json_encode($returnJson));
	   }
}