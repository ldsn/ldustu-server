<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
           //前置操作方法
          // public function _before_index(){
          //      $id = session('id');
          //      // cookie('data','1',3600);
          //      $cookie_id = cookie('data');
          //      if($id||$cookie_id){
          //           $user = D('user');
          //           $where['id'] = isset($id) ? $id : $cookie_id;
          //           $userResult = $user->where($where)->select();
          //           session('id',$userResult['id']);
          //           if($cookieTime){
          //                     $data = $userResult['id'];
          //                     cookie('data',$data,$cookieTime);
          //                }
          //           if($userResult&&$userResult!=''){
          //                $returnJson['error'] = 0;
          //           }else{
          //                $returnJson['error'] = 1002;//登录出错
          //           }
          //      }
               
          // }
          public function index(){
               $id = session('id');
               $cookie_id = cookie('data');
               if($id||$cookie_id){
                    $user = D('user');
                    $where['id'] = isset($id) ? $id : $cookie_id;
                    $userResult = $user->where($where)->select();
                    $userInfo = $userResult[0];
                    unset($userInfo['passwd']);
                    session('id',$userResult['id']);
                    if($cookieTime){
                              $data = $userResult['id'];
                              cookie('data',$data,$cookieTime);
                         }
                    if($userResult&&$userResult!=''){
                         $returnJson['error'] = 0;
                         $returnJson['userResult'] = $userInfo;
                    }else{
                         $returnJson['error'] = 1002;//登录出错
                    }
               }
          	$column = D('column');
               $returnJson['column'] = $column ->getall();
               // $this->returnJson = json_encode($returnJson);
               // var_dump($returnJson);
               // $this->ajaxReturn($returnJson);
               $this->assign('column',json_encode($returnJson['column']));
               $this->assign('userResult',json_encode($returnJson['userResult']));
               $this->display('ldsn-wap/page/index');
          }
}