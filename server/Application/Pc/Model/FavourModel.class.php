<?php
namespace Wap\Model;
use Think\Model;
class FavourModel extends Model{
    public function addFavour($article_id, $user_id){
        if(!$article_id||!$user_id){
            return $arr;
        }
        $conditions     = array(
            'article_id'        => $article_id,
            'user_id'           => $user_id
        );
        $result         = $this->add($conditions);
        if($result){
            //返回当前文章的点赞总数
            $result         = $this->where(array('article_id'=>$article_id))->select();
            $num            = count($result);
            $data['favour_num']     = $num;
            M('Article')->where(array('article_id'=>$article_id))->save($data);
            M('User')->where(array('user_id'=>$user_id))->save($data);
            return $num;
        } else {
            return false;
        }
    }

    public function removeFavour($article_id, $user_id){
        if(!$article_id||!$user_id){
            return $arr;
        }
        $conditions     = array(
            'article_id'        => $article_id,
            'user_id'           => $user_id
        );
        $result         = $this->where($conditions)->delete();
        if($result){
            //返回当前文章的点赞总数
            $result         = $this->where(array('article_id'=>$article_id))->select();
            $num            = count($result);
            $data['favour_num']     = $num;
            M('Article')->where(array('article_id'=>$article_id))->save($data);
            M('User')->where(array('user_id'=>$user_id))->save($data);
            return $num;
        } else {
            return false;
        }
    }

    public function checkFavour($article_id, $user_id){
        if(!$article_id||!$user_id){
            return $arr;
        }
        $conditions     = array(
            'article_id'        => $article_id,
            'user_id'           => $user_id
        );
        $result     = $this->where($conditions)->select();
        if($result){
            return true;
        } else {
            return false;
        }
    }
}