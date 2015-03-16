<?php
require_once("qiniu/rs.php");

$bucket = $_SERVER['LDSN_QINIU_BUCKET'];
$accessKey = $_SERVER['LDSN_QINIU_ACCESSKEY'];
$secretKey = $_SERVER['LDSN_QINIU_SECRETKEY'];

Qiniu_SetKeys($accessKey, $secretKey);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
$upToken = $putPolicy->Token(null);
$arr=array(
        "uptoken"=>$upToken,
        );

print_r(json_encode($arr));
