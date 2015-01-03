<?php
class ldsn_power extends spModel
{
  var $pk = "pw_id"; // 每个留言唯一的标志，可以称为主键
  var $table = "ldsn_power"; // 数据表的名称
  var $linker = array(
                array(
                        'type' => 'hasone',   // 一对一关联
                        'map' => 'detail',    // 关联的标识
                        'mapkey' => 'pw_id',
                        'fclass' => '', 
                        'fkey' => 'pw_id',    
                        'enabled' => false     
                ),
                array(
                        'type' => 'hasmany',   // 一对多关联
                        'map' => 'ldsn_admin',    // 关联的标识
                        'mapkey' => 'pw_id', 
                        'fclass' => 'ldsn_admin',
                        'fkey' => 'pw_id',
                        'enabled' => true
                ),
        );
}