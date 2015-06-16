<?php
/**
 * 验证手机
 * @author jason
 */
function is_mobile_request()  
{  
 $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';  
 $mobile_browser = '0';  
 if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))  
  $mobile_browser++;  
 if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))  
  $mobile_browser++;  
 if(isset($_SERVER['HTTP_X_WAP_PROFILE']))  
  $mobile_browser++;  
 if(isset($_SERVER['HTTP_PROFILE']))  
  $mobile_browser++;  
 $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));  
 $mobile_agents = array(  
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',  
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',  
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',  
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',  
    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',  
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',  
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',  
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',  
    'wapr','webc','winw','winw','xda','xda-'
    );  
 if(in_array($mobile_ua, $mobile_agents))  
  $mobile_browser++;  
 if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)  
  $mobile_browser++;  
 // Pre-final check to reset everything if the user is on Windows  
 if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)  
  $mobile_browser=0;  
 // But WP7 is also Windows, with a slightly different characteristic  
 if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)  
  $mobile_browser++;  
 if($mobile_browser>0)  
  return true;  
 else
  return false;
}
/**
 * 验证是否登录
 * @author  ety001
 * @return  boolean
 */
function authLogin() {
    if(session('user_info.user_id')){
        return true;
    } else {
        $signature      = cookie('signature');
        if(!$signature){
            return false;
        }
        if(authSignature($signature)){
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 验证签名
 * @author  ety001
 * @return  boolean
 */
function authSignature($signature){
    if(!$signature)return false;
    $sign           = substr($signature, 0, 64);
    $user_id        = substr($signature, 64);
    $condition      = array('user_id'=>$user_id);
    $r              = M('User')->where($condition)
                               ->find();
    $get_sign       = hash('sha256',$r['username'].$r['password']);
    if($get_sign == $sign){
        unset($r['password']);
        session('user_info', $r);
        return true;
    } else {
        return false;
    }

}

/**
 * 签名
 * @author  ety001
 * @return  string
 */
function createSignature($arr){
    return hash('sha256',$arr['username'].$arr['password']) . $arr['user_id'];
}

/**
 * ajax方法返回
 * @author ety001
 * @param mixed $data 要返回的数据
 * @param string $msg 返回的消息
 * @param int $status 返回的错误码
 */ 
function ajaxReturn($data, $msg, $status){
    $r              = array(
        'data'      => $data,
        'msg'       => $msg,
        'status'    => $status
    );
    header('Content-Type:application/json; charset=utf-8');
    exit(json_encode($r));
}

/**
 * 字符串截取
 * @author ety001
 * @param string $strCut 要截取的字符串
 * @param int $length 要截取的长度
 * @param string $encode 要截取字符串的编码
 */
function substrCut($strCut,$length=0,$encode='utf-8')
{
    if (mb_strlen($strCut,$encode) > $length)
    {
        $strCut = mb_substr($strCut,0,$length,$encode)."...";
    }
    return $strCut;
}
/* 
 * 
 * @desc URL安全形式的base64编码 
 * @param string $str 
 * @return string 
 */  
  
  
function urlsafe_base64_encode($str){  
    $find = array("+","/");  
    $replace = array("-", "_");  
    return str_replace($find, $replace, base64_encode($str));  
}  
  
/** 
 * generate_access_token 
 * 
 * @desc 签名运算 
 * @param string $access_key 
 * @param string $secret_key 
 * @param string $url 
 * @param array  $params 
 * @return string 
 */  
function generate_access_token($access_key, $secret_key, $url, $params = ''){  
    $parsed_url = parse_url($url);  
    $path = $parsed_url['path'];  
    $access = $path;  
    if (isset($parsed_url['query'])) {  
        $access .= "?" . $parsed_url['query'];  
    }  
    $access .= "\n";  
    if($params){  
        if (is_array($params)){  
            $params = http_build_query($params);  
        }  
        $access .= $params;  
    }  
    $digest = hash_hmac('sha1', $access, $secret_key, true);  
    return $access_key.':'.urlsafe_base64_encode($digest);  
} 
/**
 * qiniu_send
 * @param string $url
 * @param array  $header
 */
function qiniu_send($url, $header = '') {  
    $curl = curl_init($url);  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
    curl_setopt($curl, CURLOPT_HEADER,0);  
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);  
    curl_setopt($curl, CURLOPT_POST, 1);  
  
    $con = curl_exec($curl);  
    if ($con === false) {  
        echo 'CURL ERROR: ' . curl_error($curl);  
    } else {  
        return $con;  
    }  
}  