<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
       public function index(){//测试页面
              echo '这是首页';
          }
          public function userinfo(){
              $user = D('User');
              $username =jason;
              print_r($user->userinfo($username));
          }
          public function getArticle($startid = 0,$getnum = 10,$cid = 1){
              $article = D('article');
              print_r($article->getArticle($startid,$getnum,$cid));
          }
          public function getColumn(){
               $column = D('column');
                print_r($column ->getall());
          }
          


}