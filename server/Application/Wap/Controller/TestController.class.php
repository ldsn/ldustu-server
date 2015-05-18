<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class TestController extends Controller {
    
    public function index(){
        $user_id    = 18;
        $user_info  = M('user')->find($user_id);
        $_SESSION['user_info']  = $user_info;
    }

    public function _empty(){
        $this->index();
    }

    public function testComment(){
        
    }

    public function add(){
        var_dump( D('Article')->getList() );
    }
}