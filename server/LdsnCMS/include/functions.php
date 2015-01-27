<?php
function GetIp(){
	$getIp =  ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	return $getIp;
}

?>