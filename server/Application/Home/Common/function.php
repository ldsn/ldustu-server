<?php
	function LoginStyle(){
		$way = strtolower($_SERVER['HTTP_USER_AGENT']);
		if(preg_match("/mobile", $way)){
			$LoginWay = 'mobile';
		}else{
			$LoginWay = 'computer';	
		}
		return $LoginWay;

	}
	function inject_check($sql_str) {  //防注入过滤
		return eregi ( 'select|inert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|UNION|into|load_file|outfile', $sql_str ); 
	}
	function check_verify($code, $id = ''){
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	}	 