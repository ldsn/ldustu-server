<?php
namespace Wap\Model;
use Think\Model;
class ColumnModel extends Model{
    public function getall(){
        $column         = $this ->field('column_id,column_name')->select();
        return $column;
    }
}