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
            'up_faild'  => 0;
            'up_success'=> 1;
            'no_auth'   => 2;
            );
        $user      = D('User');
        $user_id   = session('user_info.user_id');
        $usercheck = $user->where('user_id='.$user_id)->find();
        if(!$usercheck){
            $r  = array(
                'msg'       => 'no_auth',
                'status'    => 2
            );
            $this->ajaxReturn($r);
        }
        $data = array(
            'username' => I('post.username');
            'password' => I('post.password');
            'head_pic' => I('post.head_pic');
            'qq'       => I('post.qq');
            'telphone' => I('post.telphone');
            'email'    => I('post.email');
            );
        if(!$data['password']){
            unset($data['password']);
        }
        
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