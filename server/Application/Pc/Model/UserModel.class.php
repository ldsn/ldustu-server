<?php
namespace Pc\Model;
use Think\Model;
class UserModel extends Model{   
	/*
	*检查用户名
	*检查邮箱格式
	*请求用户信息
	*/
	public function userid($username){
		$where['username'] = $username;
		$result = $this->where($where)->find();
		return $result['uid'];
	}
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
		$result =$this->field('passwd',true)->where($where)->select();
		return json_encode($result);
	}
}