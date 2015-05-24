<?php
namespace Wap\Model;
//use Think\Model;
use Think\Model\RelationModel;
class CommentModel extends RelationModel{
    protected $_link = array(
        'UserInfo'  => array(
            'mapping_type'      => self::HAS_ONE,
            'class_name'        => 'User',
            'mapping_name'      => 'user_info',
            'mapping_key'       => 'user_id',
            'mapping_fields'    => 'user_id, username, head_pic',
            'foreign_key'       => 'user_id'
        )
    );
    /**
     * 获取评论列表
     * @param   conditions          查询条件
     * @param   offset              开始条数
     * @param   count               每页条数
     * @param   order               排序条件
     * @return  false|array
     */
    public function catchComment($conditions=array(), $offset=0, $count=20, $order='comment_id asc'){
        $offset     = (int)$offset;
        $count      = (int)$count;
        $result     = $this->relation(true)
                            ->where($conditions)
                            ->order($order)
                            ->limit($offset, $count)
                            ->select();
        return $result;
    }

    /**
     * 添加评论
     * @param   user_id         用户id
     * @param   article_id      文章id
     * @param   content         评论内容
     * @return  boolean
     */
    public function addComment($user_id, $article_id, $content ){
        if( !isset($user_id)||!isset($article_id)||!isset($content) ){
            return false;
        }
        $time = time();
        $data = array(
            'user_id'           => $user_id,
            'article_id'        => $article_id,
            'content'           => $content,
            'create_time'       => $time,
        );
        $result = $this->add($data);
        if($result){
            M('Article')->where(array('article_id'=>$article_id))->setInc('comment_num');
            M('User')->where(array('user_id'=>$user_id))->setInc('comment_num');
        }
        return $result;
    }

    /**
     * 删除评论
     * @param   comment_id      评论id
     * @return  boolean
     */
    public function deleteComment($comment_id){ //删除留言
        if(!isset($comment_id)){
            return false;
        }
        $where['comment_id']    = $comment_id;
        $where['user_id']       = $_SESSION['user_info']['user_id'];        
        $result                 = $this->where($where)->delete();

        if($result){
            $article_model  = M('Article');
            $info           = $article_model->field('comment_num')->find($article_id);
            if($info['comment_num']>0){
                $article_model->where(array('article_id'=>$article_id))->setDec('comment_num');
            }

            $user_model     = M('User');
            $info           = $user_model->field('comment_num')->find($user_id);
            if($info['comment_num']>0){
                $user_model->where(array('user_id'=>$user_id))->setDec('comment_num');
            }
        }
        
        return $result;
    }
}