<?php
class ldsn_column extends spModel
{
  var $pk = "clu_id"; // 每个留言唯一的标志，可以称为主键
  var $table = "ldsn_column"; // 数据表的名称
  var $linker = array(
                array(
                        'type' => 'hasone',   // 一对一关联
                        'map' => 'detail',    // 关联的标识
                        'mapkey' => 'clu_id',
                        'fclass' => 'user_detail', 
                        'fkey' => 'clu_id',    
                        'enabled' => false     
                ),
                array(
                        'type' => 'hasmany',   // 一对多关联
                        'map' => 'art_content',    // 关联的标识
                        'mapkey' => 'clu_id', 
                        'fclass' => 'art_content',
                        'fkey' => 'clu_id',
                        'enabled' => true
                ),
        );
}