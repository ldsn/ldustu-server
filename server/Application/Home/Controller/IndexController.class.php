<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
       public function index(){//测试页面
              $user = D('User');
              $username = cookie('username');
              echo $_GET[cate_id];
              if($username&&$username != ''){
              		echo $username;
                      echo '<br/>';
                      echo '<a href=/home/login/logout>退出</a>';
                      echo $user->userip($username);
                       echo '<a href=/home/article/showarticle/art_id/3>查看3号文章</a>';
                      // $where['username'] =$username;
                      // dump($user->where($where)->select());
              }else{
              		redirect('/home/login/index',1,'请先登陆');
              	         echo '登陆/注册';
              }


          }
}