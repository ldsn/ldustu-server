<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class UserController extends Controller {
   	 public function index(){		//用户个人中心
    	$username = cookie('username');
    		if($username&&$username!=''){
    		//执行用户操作
    			echo $username;
    		}else{
    			redirect('/home/login',5,'请登录');
    		}
   	}

	   
}