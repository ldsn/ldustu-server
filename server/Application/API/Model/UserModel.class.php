<?php
namespace Wap\Model;
use Think\Model;
class UserModel extends Model{
    protected $_validate = array(
        //array('verify','require','need_auth_code'), //验证码
        array('password','require','need_password'), //密码
        array('password','6,16','pass_not_long',1, 'length'), //密码
        //array('verify','check_verify','auth_code_err', 1, 'function' ), //验证码
        array('username','','username_has_existed',1,'unique',1), // 在新增的时候验证username字段是否唯一
        array('email','email','email_err',1), // 邮箱格式
        array('email','','email_has_existed',1,'unique',1), // 在新增的时候验证email字段是否唯一
        array('repassword','password','repassword_err',0,'confirm'), // 验证确认密码是否和密码一致
    );
    /*
    *检查用户名
    *检查邮箱格式
    *请求用户信息
    */
    public function userinfo($id){
        $where['id'] = $id;
        $result =$this->field('passwd',true)->where($where)->find();
        return $result;
    }
}