<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller {
    public function index(){
        $columnModel            = D('column');
        $column                 = $columnModel->getall();
        if($_SESSION['user_info']['user_id']){
            $user_info          = $_SESSION['user_info'];
            unset($user_info['passwd']);
            $this->assign('user_info', $user_info);
        }
        $this->assign('column', $column);
        var_dump(getenv('debug'));die();
        if(getenv('debug')==1){
            $this->display('index/index.tpl');
        } else {
            $this->display('ldsn-wap/page/index');
        }
    }
}
