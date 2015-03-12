<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
          /*
          *得到栏目
          */
          public function index(){
          	   $column = D('column');
               $this->column = json_encode($column ->getall());
               $this->display('ldsn-wap/page/index');
          }
          
          


}