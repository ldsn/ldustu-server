<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
       public function index(){//测试页面
              echo '这是首页';
              $user = D('User');
              $username =jason;
              print_r($user->userinfo($username));
             $article = D('article');
              print_r($article->getArticle(0));

          }
          


}