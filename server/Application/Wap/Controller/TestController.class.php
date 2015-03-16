<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class TestController extends Controller {
    
    public function index(){
        
    }

    public function _empty(){
        $this->index();
    }

    public function testComment(){
        
    }
}