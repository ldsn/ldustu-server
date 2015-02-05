<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class PublicController extends Controller {
	/*
	*验证码
	*/
	public function verify($config=array('imageW'=>200,'imageH'=>50,'length'=>4,'useNoise'=>false,'codeSet'=>'0123456789')){
		$Verify =new \Think\Verify($config);
		$Verify->entry();
	}
}