<?php
/**
 * 验证是否登录
 * @author  ety001
 * @return  boolean
 */
function authLogin() {
    if($_SESSION['user_info']['user_id']){
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
    $r              = M('User')->find($condition);
    $get_sign       = hash('sha256',$r['username'].$r['password']);
    if($get_sign == $sign){
        unset($r['password']);
        $_SESSION['user_info']  = $r;
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