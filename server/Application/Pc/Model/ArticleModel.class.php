<?php
namespace Pc\Model;
use Think\Model\RelationModel;
class ArticleModel extends RelationModel{
    /*
    *关联配置
    *文章内容页获取文章信息
    *获取主页、列表获取文章信息
    */
    protected $_link = array(
        'ArticleDetail' =>array(
            'mapping_type'=>self::HAS_ONE,
            'mapping_name'=>'detail',
            'class_name'=>'ArticleDetail',
            'foreign_key'=>'article_id',
        ),
        'UserInfo'  => array(
            'mapping_type'      => self::HAS_ONE,
            'class_name'        => 'User',
            'mapping_name'      => 'user_info',
            'mapping_key'       => 'user_id',
            'mapping_fields'    => 'user_id, username, head_pic',
            'foreign_key'       => 'user_id'
        ),
        'FavInfo'  => array(
            'mapping_type'      => self::HAS_MANY,
            'class_name'        => 'Favour',
            'mapping_name'      => 'favour_info',
            'foreign_key'       => 'article_id'
        )
    );
    public function one()
    {
        echo 'aaa';
    }
    /**
     * 获取指定文章id的文章内容
     * @author      ety001
     * @param int $aid 文章id
     * @return false|array 返回结果或者false
     */
    public function getDetail($aid){
        if(!$aid)return false;
        $user_id        = $_SESSION['user_info']['user_id']?$_SESSION['user_info']['user_id']:0;
        $this->_link['FavInfo']['condition']    = "user_id={$user_id}";
        $result = $this->relation(true)->where(array('article_id'=>$aid))->find();
        if($result){
            $comment_model                  = D('Comment');
            $conditions['article_id']       = $result['article_id'];
            $result['comment_list']         = $comment_model->catchComment($conditions, 0, 5);
        }
        return $result;
    }
        /**
     * 获取文章列表
     * @author      ety001
     * @param array $conditions 条件数组
     * @param int $offset 查询起始条
     * @param int $count 每次查询条数
     * @param string $order 排序规则
     * @param boolean $is_count 是否返回总数
     * @return array|false|int 返回文章列表|false|或者符合条件的文章总数
     */
    public function getList($conditions=array(), $offset=0, $count=20, $order='article_id desc', $is_count=false){

        if($is_count){
            $result = $this->where($conditions)->count();
        } else {
            $user_id        = $_SESSION['user_info']['user_id']?$_SESSION['user_info']['user_id']:0;
            $this->_link['FavInfo']['condition']    = "user_id={$user_id}";
            $result = $this->limit($offset,$count)
                        ->where($conditions)
                        ->order($order)
                        ->relation(true)
                        ->select();
            if($result){
                $comment_model      = D('Comment');
                $column_model = D('Column');
                foreach ($result as $k => $v) {
                    $conditions['article_id']       = $v['article_id'];
                    $result[$k]['comment_list']     = $comment_model->catchComment($conditions, 0, 5);
                    $conditions['column_id'] = $v['column_id'];
                    $result[$k]['column_name']     = $column_model->catchColumn($conditions);
                    $result[$k]['create_time_string'] = date('<b>m/d</b><b>H:i更新</b>', $result[$k]['create_time']);
                }
            }
        }
        return  $result;
    }
}