<?php
namespace Common\Model;
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

    /**
     * 获取指定文章id的文章内容
     * @author      ety001
     * @param int $aid 文章id
     * @return false|array 返回结果或者false
     */
    public function getDetail($aid){
        if(!$aid)return false;
        $user_id        = session('user_info.user_id')?session('user_info.user_id'):0;
        $this->_link['FavInfo']['condition']    = "user_id={$user_id}";
        $conditions     = array('article_id'=>$aid);
        $result         = $this
                          ->relation(true)
                          ->where($conditions)
                          ->find();
        $update         = M('Article_update');
        $user           = M('User');
        $tb_update      = $update->where()->select();
        foreach($tb_update as $k => $v)
        {
          $tb_update[$k]['user_id'] = $user->where('user_id='.$tb_update[$k]['user_id'])->field('username')->find();
        }
        $this->where($conditions)->setInc('view_num',1);
        if($result){
            $comment_model                  = D('Comment');
            $column_model                   = D('Column');

            $conditions['article_id']       = $result['article_id'];
            $result['comment_list']         = $comment_model->catchComment($conditions, 0, 10);
            $conditions['column_id']        = $result['column_id'];
            $result['column_name']          = $column_model->catchColumn($conditions);
            $result['update_list']          = $tb_update;
        }
        return $result;
    }

    /**
     * 发布文章
     * @author      ety001
     * @param array $data 文章数据
     * @return false|int 返回插入后的文章id或者false
     */
    public function publish($data){
        if(!$data){
            $data       = array(
                'user_id'           => session('user_info.user_id'),
                'column_id'         => I('post.column_id',0,'int'),
                'status'            => 1,
                'title'             => I('post.title'),
                'description'       => I('post.desc',''),
                'thumbnail'         => I('post.thumbnail',''),
                'create_time'       => time(),
                'from_device'       => 'wap',
                'detail'            => array(
                    'content'           => I('post.content'),
                    'tag'               => I('post.tag','')//这个功能的数据库结构让人很疑惑，不建议先使用
                )
            );
            if(!$data['user_id'] || !$data['column_id'] || !$data['title'] || !$data['detail']['content'])return false;
        }
        $result = $this->relation('detail')->add($data);
        if($result){
            M('User')->where('user_id='.$data['user_id'])->setInc('article_num');
        }
        return $result;
    }
    /**
     * 更新文章
     * @author Jason
     * @param  $data | 更新的文章数据
     * @return 返回更新文章ID或者FALSE
     */
    public function update_article($data,$article_id)
    {
      if(!$article_id)
      {
        $article_id = I('post.article_id');
      }
      if(!$data)
      {
            $data       = array(
                'column_id'         => I('post.column_id',0,'int'),
                'status'            => 1,
                'title'             => I('post.title'),
                'description'       => I('post.desc',''),
                'thumbnail'         => I('post.thumbnail',''),
                'from_device'       => 'wap',
                'detail'            => array(
                    'content'           => I('post.content'),
                    'tag'               => I('post.tag','')//这个功能的数据库结构让人很疑惑，不建议先使用
                )
            );
            if(!$data['user_id'] || !$data['column_id'] || !$data['title'] || !$data['detail']['content'])return false;
        }
        $where['article_id'] = $article_id;
        
        $result = $this->where($where)->relation('detail')->save($data);
        if($result){
            $upinfo = array(
              'article_id' =>$article_id,
              'user_id'    =>session('user_info.user_id'),
              'update_time'=>time()
              );
            M('Article_update')->data($upinfo)->add();
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
            $user_id        = session('user_info.user_id')?session('user_info.user_id'):0;
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
                    $result[$k]['comment_list']     = $comment_model->catchComment($conditions, 0, 10);
                    $conditions['column_id'] = $v['column_id'];
                    $result[$k]['column_name']     = $column_model->catchColumn($conditions);
                }
            }
        }
        return  $result;
    }
    
    /**
     * 改变文章状态
     * @author  ety001
     * @param int $article_id 文章id
     * @param int $status 修改的状态值
     * @param int $admin 是否管理员操作
     */
    public function changeStatus($article_id, $status=-1, $admin=false){
        if(!$article_id)return false;
        $info               = $this->where(array('article_id'=>$article_id))->select();
        $current_user_id    = session('user_info.user_id');
        if($info[0]['user_id']==$current_user_id || $admin){
            $data['status'] = $status;
            return $this->where(array('article_id'=>$article_id))->save($data);
        } else {
            return '-1';
        }
    }
    /**
     * 取出顶部10篇文章
     * @author Jason
     * 
     */
    public function gethead_article()
    {
        $where['index_status'] = 1;
        $where['status']       = 1;
        $result = $this
                  ->where($where)
                  ->limit(10)
                  ->order('article_id desc')
                  ->select();
        return $result;
    }
    /**
     * 取出顶部两篇图片文章
     * @author Jason
     */
    public function gethead_pic_two()
    {
        $where['index_pic_status'] = 1;
        $where['status']           = 1;
        $result = $this
                  ->where($where)
                  ->limit(2)
                  ->order('article_id desc')
                  ->select();
        return $result;
    }

} 