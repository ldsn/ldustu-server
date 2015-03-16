<?php
namespace Wap\Model;
use Think\Model;
class CommentModel extends Model{
    public function catchComment($conditions=array(), $startid=0, $count=20, $order='id desc'){
        if(!$conditions)return false;
        $result     = $this->limit($startid, $count)
                            ->where($conditions)
                            ->order($order)
                            ->select();
        return $result;
    }

    public function comment($uid,$aid,$content ){   //评论动作
        if( !isset($uid)||!isset($aid)||!isset($content) ){
            $returnJson=array(
            'error'=>1001,
            );
        }else{
            $time = time();
            $data = array(
                'uid' => $uid,
                'aid' =>$aid,
                'content' =>$content,
                'time' =>$time,
                );
            $result = $this->add($data);
            if($result&&$result!=''){
                $returnJson=array(
                'error'=>0,
                );
            }else{
                $returnJson=array(
                'error'=>1002,
                );
            }
        }           
        return $returnJson;
        
    }
    public function deleteComment($com_id){ //删除留言
        if(!isset($com_id)){
            $returnJson=array(
            'error'=>1001,
            );
        }else{
            $where['id'] = $com_id;
            $result = $this ->where($where)->delete();
            if($result&&$result!=''){
                $returnJson=array(
                'error'=>0,
                );
            }else{
                $returnJson=array(
                'error'=>1002,
                );
            }
        }
        
        return $returnJson;
    }
}