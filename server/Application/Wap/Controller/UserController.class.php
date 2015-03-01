<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class UserController extends Controller {
            /*
            *用户中心
            *获取用户信息
            */
   	      public function index(){		//用户个人中心
    	       $username = cookie('username');
    		if($username&&$username!=''){
          		//执行用户操作
          		  $returnJson['error'] = 0;
          		}else{
          		  $returnJson['error'] = 1003;
          		}
              print_r(json_encode($returnJson));
   	      }
            public function userinfo(){
                      $user = D('User');
                      $username =cookie('username');
                      if(isset($username)){
                          $result = $user->userinfo($username);
                          $returnJson['error'] = 0;
                        }else{
                          $returnJson['error'] = 1003;
                        }
                        print_r(json_encode($returnJson));         
            }

	   
}