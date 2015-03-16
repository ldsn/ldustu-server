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
    public function login(){
        $msgNO          = array(
            'need_params'       => -1,
            'login_failed'      => -2,
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
                unset($userResult['passwd']);
                $r      = array(
                    'data'  => $userResult,
                    'msg'   => 'login_success'
                    'status' => $msgNO['login_success'],
                );
                $_SESSION['user_info']  = $userResult;
                $sign                   = createSignature($userResult);
                cookie('signature', $sign, 3600*24*7);
            } else {
                $r      = array(
                    'data'  => array(),
                    'msg'   => 'login_failed'
                    'status' => $msgNO['login_failed'],
                );
            }
            $this->ajaxReturn($r);
        }

        if(!$username||!$password){
            $r      = array(
                'data'  => array(),
                'msg'   => 'need_params'
                'status' => $msgNO['need_params'],
            );
            $this->ajaxReturn($r);
        }

        $where['username']  = $username;
        $result             = $userModel->where($where)->find();
        if($result['passwd']!=md5($password)){
            $r      = array(
                'data'  => array(),
                'msg'   => 'login_failed'
                'status' => $msgNO['login_failed'],
            );
            $this->ajaxReturn($r);
        }

        $_SESSION['user_info']  = $result;
        $sign                   = createSignature($result);
        cookie('signature', $sign, 3600*24*7);

        $more['login_time']     = time();
        $more['login_style']    = LoginStyle();
        $userModel->where($where)->data($more)->save();

        $r      = array(
            'data'      => $result,
            'msg'       => 'login_success'
            'status'    => $msgNO['login_success'],
        );

        $this->ajaxReturn($r);
    }
    
    public function logout(){
        session('user_info',null);
        cookie('signature',null);
        $r      = array(
            'data'      => array(),
            'msg'       => 'logout_success'
            'status'    => 1,
        );
        $this->ajaxReturn($r);
    }
}