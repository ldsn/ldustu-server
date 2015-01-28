<?php
function GetIp(){
	$getIp =  ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	return $getIp;
}
function loginStyle(){
	$forasp =  strtolower($_SERVER['HTTP_USER_AGENT']); 
	if(preg_match("/mobile/",$forasp)){
	$loginWay = 'mobile';
	}else{
	$loginWay = 'computer';
	}
	return $loginWay;
}

?>