<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
          /*
          *得到栏目
          */
          public function getColumn(){
               $column = D('column');
               $this->column = $column ->getall();
               print_r($column ->getall());
          }

          


}