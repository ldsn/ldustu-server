<?php
class main extends spController
{
	function index(){
		echo "Enjoy, Speed of PHP!";
		echo "<br/>";
		echo  "<a href='index.php?c=main&a=pageLogin'>login<a>";
		
	}
	function  pageLogin(){
		echo "this is the page of login";
		$this->display('pageLogin.htm');
	}
	function pageSign(){
		$time = md5(time()); //add a confirm
		$this->confirm = $time;

		$this->display('pageSign.htm');
	}
	function pageDeleteUser(){
		echo "it's pageDeleteUser<br/>";
		$ldsnAdmin = spClass('ldsn_admin');
		$ldsnPower = spClass('ldsn_power');
		//$condition = array();
		$searchUser = $ldsnAdmin->findall();
		$num = count($searchUser);
		echo 	$num;
		dump($searchUser);
		for($i = 0; $i < $num; $i++){
			//echo $searchUser["$i"]['ad_pw'];
			$pwSearchCondition = array(
				'pw_id'=>$searchUser["$i"]['ad_pw'],
			);
		$pw_searchOut = $ldsnPower ->find($pwSearchCondition);
		//echo $pw_searchOut['pw_name'];
		$searchOut[$i] = array(
						'name' => $searchUser["$i"]['ad_name'],
						'time' => $searchUser["$i"]['ad_time'],
						'levelName'=>$pw_searchOut['pw_name'],
					);
		}
		
		$this->SmartyOutput = $searchOut;
		$this->display('pageDeleteUser.htm');
	}
	
}