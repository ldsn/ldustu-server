<?php
namespace Wap\Model;
use Think\Model;
class UserModel extends Model{   
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