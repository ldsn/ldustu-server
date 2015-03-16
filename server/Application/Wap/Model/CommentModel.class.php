<?php
namespace Wap\Model;
use Think\Model;
class CommentModel extends Model{
    /**
     * 获取评论列表
     * @param   conditions          查询条件
     * @param   startid             开始条数
     * @param   count               每页条数
     * @param   order               排序条件
     * @return  false|array
     */
    public function catchComment($conditions=array(), $startid=0, $count=20, $order='id desc'){
        $startid    = (int)$startid;
        $count      = (int)$count;
        $result     = $this->limit($startid, $count)
                            ->where($conditions)
                            ->order($order)
                            ->select();
        return $result;
    }

    /**
     * 添加评论
     * @param   uid         用户id
     * @param   aid         目标用户id
     * @param   content     评论内容
     * @return  boolean
     */
    public function comment($uid, $aid, $content ){
        if( !isset($uid)||!isset($aid)||!isset($content) ){
            return false;
        }

        $time = time();
        $data = array(
            'uid'       => $uid,
            'aid'       => $aid,
            'content'   => $content,
            'time'      => $time,
        );
        $result = $this->add($data);
        return $result;
    }

    /**
     * 添加评论
     * @param   com_id      评论id
     * @return  boolean
     */
    public function deleteComment($com_id){ //删除留言
        if(!isset($com_id)){
            return false;
        }
        $where['id'] = $com_id;
        $result = $this ->where($where)->delete();
        return $result;
    }
}