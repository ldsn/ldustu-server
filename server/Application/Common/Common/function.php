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
    $get_sign       = hash('sha256',$r['username'].$r['passwd']);
    if($get_sign == $sign){
        unset($r['passwd']);
        $_SESSION['user_info']  = $r;
        return true;
    } else {
        return false;
    }

}
