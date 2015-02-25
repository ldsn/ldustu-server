<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
          /*
          *得到栏目
          */
          public function index(){
          	echo 'this is  index';
          }
          public function getColumn(){
               $column = D('column');
                print_r($column ->getall());
          }
}