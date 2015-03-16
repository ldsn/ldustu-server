<?php
/**
 * 验证是否登录
 * @author  ety001
 * @return  boolean
 */
function authLogin() {
    if(session('id')){
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
    $condition      = array('id'=>$user_id);
    $r              = M('User')->find($condition);
    $get_sign       = hash('sha256',$r['username'].$r['passwd']);
    if($get_sign == $sign){
        unset($r['passwd']);
        session('id', $r['id']);
        return true;
    } else {
        return false;
    }

}
