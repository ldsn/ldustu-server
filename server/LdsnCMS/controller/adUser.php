<?php
class adUser extends spController
{
	// 关于管理员 和权限的操作 对管理员进行增加、改变、增加权限
	// On the permissions of the administrator and the administrator to increase, change, add rights
	function adminControl(){  //Control all function
		echo "this is adminControl";
		echo "<br/>";
		echo "<a href='index.php?c=main&a=pageSign'>add one mannger<a>";
		echo "<br/>";
		echo "<a href='index.php?c=main&a=pageDeleteUser'>delete one mannger<a>";
	}
	function adminSignin(){   //add mannger
		$ldsnAdmin = spClass('ldsn_admin');
		$name = $this->spArgs('name');
		$passwd = $this->spArgs('passwd');
		$originConfirm = $this->spArgs('originConfirm');
		$confirm = $this->spArgs('confirm');
		$pw_lv = $this->spArgs('UserLevel');
		if($originConfirm == $confirm){
			$timeIn = time();
			$newrow=array(
				'ad_name'=>$name,
				'ad_pawd'=>$passwd,
				'ad_time'=>$timeIn,
				'ad_pw'=>$pw_lv,
				);
			$result = $ldsnAdmin->create($newrow);
			if($result){
				$this->success('add a record',spUrl('main','pageLogin'));
			}else{
				$this->error('false to add',spUrl('main','pageLogin'));
			}
		}else{
			$this->error('the confirm is wrong',spUrl('main','pageLogin'));
		}
		
	}
	function adminLogin(){ 
		$ldsnAdmin = spClass('ldsn_admin');
		$name = $this->spArgs('name');
		$passwd = $this->spArgs('passwd');
		$searchCondition = array(
			'ad_name'=>$name,
			'ad_pawd'=>$passwd,
			);
		$searchRusult = $ldsnAdmin->find($searchCondition);
		if($searchRusult){
			$this->success('login success',spUrl('adUser','adminControl'));
		}else{
			$this->error('login failed',spUrl('main','pageLogin'));
		}

	}

	function adminDelete(){

	}
	function adminChange(){

	}
	function adminLogout(){

	}
	// function powerAdd(){

	// }
	// function powerDelete(){

	// }
	// function powerChange(){

	// }
	
}