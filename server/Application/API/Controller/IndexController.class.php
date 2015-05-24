<?php
namespace Api\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
    public function index(){
        $columnModel            = D('column');
        $column                 = $columnModel->getall();
        if($_SESSION['user_info']['user_id']){
            $user_info          = M('User')->where('user_id='.$_SESSION['user_info']['user_id'])->select();
            $user_info          = $user_info[0];
            unset($user_info['password']);
            $this->assign('user_info', json_encode($user_info));
        }
        $this->assign('column', json_encode($column));
        if(getenv('debug')==1){
            $this->display('index/index');
        } else {
            $this->display('ldsn-wap/page/index');
        }
    }
}
