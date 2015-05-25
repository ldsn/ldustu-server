<?php
namespace Pc\Model;
use Think\Model;
class ColumnModel extends Model{
    public function getall(){
        $column         = $this ->field('column_id,column_name')->select();
        return $column;
    }
    /**
     * 获取评论列表
     * @param   conditions          查询条件
     */
    public function catchColumn($conditions=array()){
        $result     = $this ->where($conditions)
                            ->select();
        return $result[0]['column_name'];
    }
}