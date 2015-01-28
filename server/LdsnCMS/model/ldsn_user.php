<?php
class ldsn_user extends spModel
{
  var $pk = "user_id"; // 每个留言唯一的标志，可以称为主键
  var $table = "ldsn_user"; // 数据表的名称
  var $verifier = array(
  	"rules"=>array(
  		'username' => array(
  			'notnull' =>TRUE,
  			'minlength' =>5,
  			'maxlength' =>20,
  			),
  		'password'=>array(
  			'notnull' =>TRUE,
  			'minlength' =>5,
  			'maxlength' =>12,
  			),
  		'confirm_password'=>array(
  			'equalto' => 'password',
  			),
  		'email' =>array(
  			'notnull' =>TRUE,
  			'email' =>TRUE,
  			'minlength' =>8,
  			'maxlength' =>20,
   			),
        ),
      "messages" =>array(
                      'username' =>array(
                        'notnull' =>"姓名不能为空",
                        'minlength' =>"姓名不能少于5个字符",
                        'maxlength' =>"姓名不能大于20个字符"
                        ),
                      'password' =>array(
                        'notnull' =>"密码不能为空",
                        'minlength' =>"密码不能少于5个字符",
                        'maxlength' =>"密码不能大于20个字符",
                        ),
                     'confirm_password' =>array(
                                      'equalto' => "两次密码不同",
                                ),
                      'email' =>array(
                                'notnull'=>"邮箱不能为空",
                                'minlength' =>"邮箱不能小于8个字符",
                                'maxlength' =>"邮箱不能大于20个字符",
                                'email'=>"请输入正确地邮箱格式",
                        ),
          ),
  	);

}