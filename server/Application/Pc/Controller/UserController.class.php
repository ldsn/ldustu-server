<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class UserController extends Controller{
	public function index()
	{
		$user_id = session('user_info.user_id')?session('user_info.user_id'):0;
		$this->display();
	}
}