<?php
namespace Api\Model;
use Think\Model;
class ColumnModel extends Model{
    public function getall(){
        $column         = $this ->field('column_id,column_name')->select();
        return $column;
    }
    public function catchColumn($conditions=array()){
        $result     = $this ->where($conditions)
                            ->select();
        return $result[0]['column_name'];
    }
}