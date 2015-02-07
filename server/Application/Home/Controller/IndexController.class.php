<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
       public function index(){//测试页面
              $user = D('User');
              $username = cookie('username');
              echo '这是首页';

          }
          public function getArticle(){ //获取文章页面
            $article =D('Article');
            $result = $article->relation(true)->select();
            dump($result);
          }
}