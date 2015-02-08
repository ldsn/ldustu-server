<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{   //用户对象 验证用户名和邮箱方法
	public function checkname($username){
		$where['username'] = $username;
		if(!$this->where($where)->count()){
			$JsonOutput = json_encode('用户名符合要求');
		}else{
			$JsonOutput = json_encode('用户名已存在');
		}
		return $JsonOutput;
	}
	public function checkemail($email)
		{
		    if(eregi("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)){
		    	$JsonOutput = json_encode('邮箱格式符合要求');
		    }else{
		    	$JsonOutput = json_encode('邮箱格式不符合要求');
		    }
		    return $JsonOutput;
		}
	public function userinfo($username){
		$where['username'] = $username;
		$result =$this->where($where)->select();
		return json_encode($result);
	}
}