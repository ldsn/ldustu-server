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
               echo "this is wap index";
               $this->display('index');
          }
          public function test(){
          	$content = '然后访问  checklogin ，就检测是否存在cookie ， 对比 取出来的skey ，如果正确，取出ID ,然后ID 搜索数据库是否存在，如果存在，将用户的ID 写入SESSION';
          	$data = extract_keywords($content);
          	dump($data);
          }
          


}