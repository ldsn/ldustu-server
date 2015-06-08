<?php
namespace Api\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class UserController extends Controller {
    /*
    *用户中心
    *获取用户信息
    */
    public function index(){      //用户个人中心
        $id = session('id');
        if($id&&$id!=''){
            //执行用户操作
            $returnJson['error'] = 0;
        }else{
            $returnJson['error'] = 1003;
        }
        $this->ajaxReturn($returnJson);
    }
    public function userinfo(){
        $user = D('User');
        // session('id',1);
        $id  = session('id');
        if(isset($id)){
            $result = $user->userinfo($id);
            $result['error'] = 0;
        }else{
            $result['error'] = 1003;
        }
        $this->ajaxReturn($result);
    }
    public function up_info()
    {
        $msgNO = array(
            'up_faild'              => 0,
            'up_success'            => 1,
            'auth_code_err'         => -1,
            'need_auth_code'        => -2,
            'repassword_err'        => -3,
            'email_err'             => -4,
            'email_has_existed'     => -5,
            'username_has_existed'  => -6,
            'need_password'         => -7,
            'pass_not_long'         => -8,//密码不够长
            'no_auth'               => -9
        );
        $user      = D('User');
        $user_id   = session('user_info.user_id');
        if (!$user_id) {
            $r  = array(
                'msg'       => 'no_auth',
                'status'    => -1
            );
            $this->ajaxReturn($r);
        }
        $usercheck = $user->where('user_id='.$user_id)->find();
        if(!$usercheck){
            $r  = array(
                'msg'       => 'no_auth',
                'status'    => -1
            );
            $this->ajaxReturn($r);
        }
        $data = array(
            'username' => I('post.username'),
            'password' => I('post.password'),
            'head_pic' => I('post.head_pic'),
            'qq'       => I('post.qq'),
            'telphone' => I('post.telphone'),
            'email'    => I('post.email')
        );
        $auth = $user->create($data);

        if(!$auth){
            $err    = $user->getError();
            $r      = array(
                'data'      => array(),
                'msg'       => $err,
                'status'    => $msgNO[$err]
            );
            $this->ajaxReturn($r);
        }

        if(!$data['password']){
            unset($data['password']);
        }
        $data['password'] = md5(I('post.password'));
        $result = $user->up_info($data,$user_id);
        if($result)
        {
            $r  = array(
                'msg'       => 'up_success',
                'status'    => 1
            );
            $this->ajaxReturn($r);
        }
        else
        {
            $r  = array(
                'msg'       => 'up_faild',
                'status'    => 0
            );
            $this->ajaxReturn($r);
        }
    }
}