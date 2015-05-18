<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller{
    /**
     * 网站首页
     * @author Jason
     */
    public function index(){
        $p              = I('post.p',1,'int');
        $p              = $p?$p:1;
        $count          = 20;
        $offset         = ($p-1)*$count;
        //栏目
        $column_id      = I('post.column_id',0,'int');
        if($column_id){
            $conditions['column_id']    = $column_id;
        }
        //用户
        $user_id        = I('post.user_id',0,'int');
        if($user_id){
            $conditions['user_id']      = $user_id;
        }
        //只列出已审核文章
        $conditions['status']       = 1;

        $article_model      = D('Article');
        $result             = $article_model->getList($conditions,$offset,$count);
        $result_total       = $article_model->getList($conditions,0,0,'',true);
        $page               = array(
            'total'             => $result_total,
            'total_page'        => ceil($result_total/$count)
        );
        $r                  = array(
            'list'      => $result,
            'page'      => $page
        );
        //var_dump($result);
        if($result){
           $this->result =$result;
        } 
        $this->display('index/index');
    }
    /**
     * 文章列表页
     * @author Jason
     */
    public function listArticle(){
        $p              = I('post.p',1,'int');
        $p              = $p?$p:1;
        $count          = 20;
        $offset         = ($p-1)*$count;
        //栏目
        $column_id      = I('post.column_id',0,'int');
        if($column_id){
            $conditions['column_id']    = $column_id;
        }
        //用户
        $user_id        = I('post.user_id',0,'int');
        if($user_id){
            $conditions['user_id']      = $user_id;
        }
        //只列出已审核文章
        $conditions['status']       = 1;

        $article_model      = D('Article');
        $result             = $article_model->getList($conditions,$offset,$count);
        $result_total       = $article_model->getList($conditions,0,0,'',true);
        $page               = array(
            'total'             => $result_total,
            'total_page'        => ceil($result_total/$count)
        );
        $r                  = array(
            'list'      => $result,
            'page'      => $page
        );

        if($result){
           $this->result = $result;
        } 
        $this->display('article/list');
    }
    /**
     * 文章内容页
     * @author Jason
     */
    public function articleArticle(){
        $article_id         = 10;//I('post.aid',0,'int');

        $article_model      = D('Article');
        $result             = $article_model->getDetail($article_id);
        //var_dump($result);
        if($result){

            $this->result = $result;
        }
        $this->display('article/article');
    }
}
