<?php
namespace Wap\Model;
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
        ''
    );

    /**
     * 获取指定文章id的文章内容
     * @author      ety001
     * @param int $aid 文章id
     * @return false|array 返回结果或者false
     */
    public function getDetail($aid){
        if(!$aid)return false;
        $result = $this->relation(true)->where(array('article_id'=>$aid))->find();
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
                'user_id'           => $_SESSION['user_info']['user_id'],
                'column_id'         => I('post.column_id',1,'int'),
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
            if(!$data['user_id'] || !$data['title'] || !$data['detail']['content'])return false;
        }
        $result = $this->relation('detail')->add($data);
        return $result;
    }


    public function getList($conditions=array(), $offset=0, $count=20, $order='article_id desc'){
        $user = M('user');
        $comment = M('comment');
        $error = 0;
        $where = array(   //构造取值条件
            'ismake' => 1,
            'clu_id' => $cid,
        );
        $result =  $this->limit($offset,$count)->where($where)->order($order)->select();
        $listNum = count($result);
        if($listNum<$getnum){   //判断文章能够再取 ，true 不能继续取
            $end = true;
        }else{
            $end = false;
        }
        foreach($result as $key=> $value){
            $new[$key]['aid'] = (int)$value['id'];
            $new[$key]['uid'] = (int)$value['uid'];
            $new[$key]['cid'] = (int)$value['cid'];
            $new[$key]['ismake'] = (int)$value['ismake'];
            $new[$key]['favour'] = (int)$value['favour'];
            $new[$key]['visit'] = (int)$value['visit']; 
            $new[$key]['comment'] = (int)$value['comment']; 
            $new[$key]['title'] = $value['title'];
            $new[$key]['desription'] = $value['desription'];
            $new[$key]['image'] = $value['image'];
            $new[$key]['time'] = (int)$value['time'];
            $new[$key]['from'] = $value['from'];
            $where['id'] = $new[$key]['uid'];
            $userinfo = $user->where($where)->field('username')->find();
            $new[$key]['username'] = $userinfo['username'];
            $where1['aid'] = $new[$key]['aid'];
            $cominfo = $comment->where($where1)->limit(0,$comGetNum)->order('time desc')->select();
            $comListNum = count($cominfo);
            if($comListNum<=$comGetNum){
            $comEnd = true;
            }else{
            $comEnd = false;
            }
            $new[$key]['cominfo'] = $cominfo;
            $new[$key]['comEnd'] = $comEnd;
            $new[$key]['comListNum'] = $comListNum;
        }
        if(!$result||$result ==''){
        $error = 1002;
        }
        $Output = array(
        'error'=>$error,
        'data' =>$new,
        'artEnd' =>$end,
        'artListNum' =>$listNum,
        );  
        return  $Output;

    }
            
} 