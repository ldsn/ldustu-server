<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class PublicController extends Controller {
    /*
    *验证码
    *点赞
    */
    public function verify($config=array('imageW'=>200,'imageH'=>50,'length'=>4,'useNoise'=>false,'codeSet'=>'0123456789')){
        $Verify =new \Think\Verify($config);
        $Verify->entry();
    }
    public function favour(){
        $msgNO          = array(
            'need_login'            => -1,//需要登录
            'need_article_id'       => -2,//需要文章id
            'has_favour'            => -3,//已赞过
            'add_favour_failed'     => -4,
            'add_favour_success'           => 1
        );
        //检查是否登录
        if(!authLogin()){
            $r      = array(
                'data'      => array(),
                'msg'       => 'need_login',
                'status'    => $msgNO['need_login']
            );
            $this->ajaxReturn($r);
        }
        $user_id            = $_SESSION['user_info']['user_id'];

        $aid = I('get.aid');
        if(!$aid){
            $r      = array(
                'data'      => array(),
                'msg'       => 'need_article_id',
                'status'    => $msgNO['need_article_id']
            );
            $this->ajaxReturn($r);
        }

        $where = array(
            'user_id'       => $user_id,
            'article_id'    => $aid,
        );

        $favourModel        = D('favour');
        if($favourModel->checkFavour($aid, $user_id)){
            $r      = array(
                'data'      => array(),
                'msg'       => 'has_favour',
                'status'    => $msgNO['has_favour']
            );
            $this->ajaxReturn($r);
        }

        $num    = $favourModel->addFavour($aid, $user_id);
        if($num){
            $r      = array(
                'data'      => $num,
                'msg'       => 'add_favour_success',
                'status'    => $msgNO['add_favour_success']
            );
            $this->ajaxReturn($r);
        } else {
            $r      = array(
                'data'      => array(),
                'msg'       => 'add_favour_failed',
                'status'    => $msgNO['add_favour_failed']
            );
            $this->ajaxReturn($r);
        }
    }
}