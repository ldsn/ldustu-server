<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class RegisterController extends Controller {
    /*
    *注册页面
    *注册功能
    */
    public function save(){
        $msgNO      = array(
            'auth_code_err'         => -1,
            'need_auth_code'        => -2,
            'repassword_err'        => -3,
            'email_err'             => -4,
            'email_has_existed'     => -5,
            'username_has_existed'  => -6,
            'need_password'         => -7,
            'pass_not_long'         => -8,//密码不够长
            'reg_failed'            => -9,
            'reg_success'           => 1
        );

        $arr['verify']          = I('post.verify');
        $arr['password']        = I('post.password');
        $arr['repassword']      = I('post.repassword');
        $arr['email']           = I('post.email');
        $arr['username']        = I('post.username');
        $arr['qq']              = I('post.qq');
        $arr['qqopenid']        = I('post.openid');
        $arr['head_pic']        = I('post.head_pic');
        $arr['sign_time']       = time();
        $arr['telphone']        = I('post.telphone');
        $user_model             = D('user');

        //数据验证
        $auth       = $user_model->create($arr);
        if(!$auth){
            $err    = $user_model->getError();
            $r      = array(
                'data'      => array(),
                'msg'       => $err,
                'status'    => $msgNO[$err]
            );
            $this->ajaxReturn($r);
        }
        $arr['password']        = md5($arr['password']);
        $info                   = $user_model->add($arr);

        $arr['user_id']         = $info;     
        $sign                   = createSignature($arr);
        cookie('signature', $sign, 3600*24*7);
        unset($arr['password']);
        unset($arr['repassword']);
        $_SESSION['user_info']  = $arr;

        if($info){
            $r      = array(
                'data'      => $info,
                'msg'       => 'reg_success',
                'status'    => $msgNO['reg_success']
            );
        } else {
            $r      = array(
                'data'      => array(),
                'msg'       => 'reg_failed',
                'status'    => $msgNO['reg_failed']
            );
        }
        $this->ajaxReturn($r);
    }

    public function checkName(){
        $username           = I('post.username');
        $user_model         = D('user');
        $where['username']  = $username; 
        $result             = $user_model->where($where)->count();
        if($result){
            $r  = array(
                'data'      => array(),
                'msg'       => 'username_has_existed',
                'status'    => -1
            );
        }else{
            $r  = array(
                'data'      => array(),
                'msg'       => 'can_reg',
                'status'    => 1
            );
        }
        $this->ajaxReturn($r);
    }

    public function checkMail(){
        $email          = I('post.email');
        $pattern_test   = "/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
        $result         = preg_match($pattern_test,$email);
        if(!$result){
            $r  = array(
                'data'      => array(),
                'msg'       => 'email_err',//格式不对
                'status'    => -1
            );
            $this->ajaxReturn($r);
        }
        $user_model             = D('user');
        $where['email']         = $email; 
        $result                 = $user_model->where($where)->count();

        if($result){
            $r  = array(
                'data'      => array(),
                'msg'       => 'email_has_existed',
                'status'    => -1
            );
        }else{
            $r  = array(
                'data'      => array(),
                'msg'       => 'can_reg',
                'status'    => 1
            );
        }
        $this->ajaxReturn($r);
    }

}