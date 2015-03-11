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
	function substr_cut($str_cut,$length)   //字符串截取
	{
	    if (strlen($str_cut) > $length)
	    {
	        for($i=0; $i < $length; $i++){
	        	if (ord($str_cut[$i]) > 128)    {
	        		$i++;
	        	}
	        }
	        
	        $str_cut = substr($str_cut,0,$i)."..";
	    }
	    return $str_cut;
	}
	function inject_check($sql_str) {  //防注入过滤
		return eregi ( 'select|inert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|UNION|into|load_file|outfile', $sql_str ); 
	}
	function check_verify($code, $id = ''){
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	}

	/**
	 * 对提交的富文本进行过滤 <default7@zbphp.com>
	 *
	 * @param $str
	 *
	 * @return string
	 */
	function HtmlFilter($str)
	{
	    $str = stripslashes($str);
	    $str = preg_replace("/<[\/]{0,1}style([^>]*)>(.*)<\/style>/i", '', $str);
	    $str = preg_replace("/[\r\n\t ]{3,}/", '\\1', $str); //过滤过长的换行变成1个
	    $str = preg_replace("/script/i", 'ｓｃｒｉｐｔ', $str);//过滤类似 href="javascript:
	    $str = preg_replace("/<[\/]{0,1}(link|meta|ifr|fra)[^>]*>/i", '', $str);
	    $str = preg_replace('/display\s*:\s*none/i', 'ｄｉｓｐｌａｙ:', $str); //过滤 style="display:none

	    return addslashes($str);
	}


	 
	/**
	 * 安全获取 GET/POST 的参数
	 *
	 * @param  String $request_name
	 * @param  Mixed  $default_value
	 * @param  String $method 'post', 'get', 'all' default is 'all'
	 * @return String
	 */
	function getRequestParam($request_name, $default_value = null, $method = "all")
	{
	    $magic_quotes = ini_get("magic_quotes_gpc") ? true : false;
	    $method = strtolower($method);

	    switch (strtolower($method)) {
	    default:
	    case "all":
	        if (isset($_POST[$request_name])) {
	            return $magic_quotes ? stripslashes($_POST[$request_name]) : $_POST[$request_name];
	        } else if (isset($_GET[$request_name])) {
	            return $magic_quotes ? stripslashes($_GET[$request_name]) : $_GET[$request_name];
	        } else {
	            return $default_value;
	        }
	        break;

	    case "get":
	        if (isset($_GET[$request_name])) {
	            return $magic_quotes ? stripslashes($_GET[$request_name]) : $_GET[$request_name];
	        } else {
	            return $default_value;
	        }
	        break;

	    case "post":
	        if (isset($_POST[$request_name])) {
	            return $magic_quotes ? stripslashes($_POST[$request_name]) : $_POST[$request_name];
	        } else {
	            return $default_value;
	        }
	        break;

	    default:
	        return $default_value;
	        break;
	    }
	}
