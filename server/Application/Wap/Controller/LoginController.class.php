<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class LoginController extends Controller {
    /*
    *登陆首页
    *登陆功能页面
    *退出
    */
    public function auth(){
        $msgNO          = array(
            'need_params'       => -1,
            'login_failed'      => -2,
            'openid_not_reg'    => -3,
            'login_success'     => 1
        );

        $username           = I('post.username');
        $password           = I('post.password');
        $openid             = I('post.openid');

        $userModel          = D('user');

        if($openid){
            $where['qqopenid']  = $openid;
            $userResult         = $userModel->where($where)->find();
            if($userResult){
                $sign                   = createSignature($userResult);
                cookie('signature', $sign, 3600*24*7);
                unset($userResult['passwd']);
                $_SESSION['user_info']  = $userResult;
                $r      = array(
                    'data'      => $userResult,
                    'msg'       => 'login_success',
                    'status'    => $msgNO['login_success']
                );
            } else {
                $r      = array(
                    'data'      => array(),
                    'msg'       => 'openid_not_reg',
                    'status'    => $msgNO['openid_not_reg']
                );
            }
            $this->ajaxReturn($r);
        }

        if(!$username||!$password){
            $r      = array(
                'data'      => array(),
                'msg'       => 'need_params',
                'status'    => $msgNO['need_params']
            );
            $this->ajaxReturn($r);
        }

        $where['username']  = $username;
        $result             = $userModel->where($where)->find();
        if($result['passwd']!=md5($password)){
            $r      = array(
                'data'      => array(),
                'msg'       => 'login_failed',
                'status'    => $msgNO['login_failed']
            );
            $this->ajaxReturn($r);
        }

        $sign                   = createSignature($result);
        cookie('signature', $sign, 3600*24*7);
        unset($result['passwd']);
        $_SESSION['user_info']  = $result;

        $r      = array(
            'data'      => $result,
            'msg'       => 'login_success',
            'status'    => $msgNO['login_success']
        );

        $this->ajaxReturn($r);
    }

    public function logout(){
        session('user_info',null);
        cookie('signature',null);
        $r      = array(
            'data'      => array(),
            'msg'       => 'logout_success',
            'status'    => 1
        );
        $this->ajaxReturn($r);
    }
}