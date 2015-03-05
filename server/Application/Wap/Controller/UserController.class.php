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
    	       $id = cookie('id');
    		if($id&&$id!=''){
          		//执行用户操作
          		  $returnJson['error'] = 0;
          		}else{
          		  $returnJson['error'] = 1003;
          		}
              print_r(json_encode($returnJson));
   	      }
            public function userinfo(){
                      $user = D('User');
                      cookie('id','3',3600);
                      $id  = cookie('id');
                      if(isset($id)){
                          $result = $user->userinfo($id);
                          $result['error'] = 0;
                        }else{
                          $result['error'] = 1003;
                        }
                        print_r(json_encode($result));         
            }
}