<?php
/**
 * 评论首页
 * 获取评论
 * 写入评论功能
 * 删除评论功能
 */
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class CommentController extends Controller {
    
    public function index(){
        
    }

    public function _empty(){
        $this->index();
    }

    public function get(){
        $msgNO          = array(
            'article_id_not_empty'      => -1,
            'get_comments_empty'        => 0,
            'get_comments_success'      => 1
        );

        $article_id     = (int)I('post.aid');
        $p              = (int)I('post.p');
        $p              = $p?$p:1;
        $count          = 5;
        $offset         = ($p-1)*$count;

        if(!$article_id){
            $r      = array(
                'data'      => array(),
                'msg'       => 'article_id_not_empty',
                'status'    => $msgNO['article_id_not_empty']
            );
            $this->ajaxReturn($r);
        }

        $conditions     = array(
            'article_id'    => $article_id
        );

        $commentModel   = D('Comment');
        $result         = $commentModel->catchComment($conditions,$offset,$count);
        if($result){
            $r      = array(
                'data'      => $result,
                'msg'       => 'get_comments_success',
                'status'    => $msgNO['get_comments_success']
            );
        } else {
            $r      = array(
                'data'      => $result,
                'msg'       => 'get_comments_empty',
                'status'    => $msgNO['get_comments_empty']
            );
        }
        $this->ajaxReturn($r);
    }

    public function add(){
        $msgNO          = array(
            'need_login'            => -1,//需要登录
            'comment_too_long'      => -2,
            'add_failed'            => -3,
            'add_success'           => 1
        );
        //检查是否登录
        if(!authLogin()){
            $r      = array(
                'data'      => array(),
                'msg'       => 'need_login',
                'status'    => $msgNO['need_login']
            );
            $this->ajaxReturn($r);
        }

        $user_id        = $_SESSION['user_info']['user_id'];
        $article_id     = (int)I('post.aid');
        $content        = trim(addslashes(htmlspecialchars(strip_tags(I('post.content')))));

        //字数判断
        if(iconv_strlen($content,"UTF-8")>200){
            $r      = array(
                'data'      => array(),
                'msg'       => 'comment_too_long',
                'status'    => $msgNO['comment_too_long']
            );
            $this->ajaxReturn($r);
        }

        $commentModel   = D('Comment');
        $result         = $commentModel->addComment($user_id, $article_id, $content);
        if($result){
            $r      = array(
                'data'      => $result,
                'msg'       => 'add_success',
                'status'    => $msgNO['add_success']
            );
        } else {
            $r      = array(
                'data'      => array(),
                'msg'       => 'add_failed',
                'status'    => $msgNO['add_failed']
            );
        }

        $this->ajaxReturn($r);
    }

    public function del(){
        $msgNO          = array(
            'need_login'            => -1,//需要登录
            'need_comment_id'       => -2,
            'has_no_auth_to_del'    => -3,//没有删除权限
            'del_comment_failed'    => -4,
            'del_comment_success'   => 1
        );

        //检查是否登录
        if(!authLogin()){
            $r      = array(
                'data'      => array(),
                'msg'       => 'need_login',
                'status'    => $msgNO['need_login']
            );
            $this->ajaxReturn($r);
        }

        $user_id            = $_SESSION['user_info']['user_id'];
        $comment_id         = (int)I('post.com_id');
        if(!$comment_id){
            $r      = array(
                'data'      => array(),
                'msg'       => 'need_comment_id',
                'status'    => $msgNO['need_comment_id']
            );
            $this->ajaxReturn($r);
        }

        $conditions         = array(
            'comment_id'        => $comment_id
        );

        $commentModel       = D('Comment');
        $comment_info       = $commentModel->catchComment($conditions);

        if($user_id!=$comment_info['user_id']){
            $r      = array(
                'data'      => array(),
                'msg'       => 'has_no_auth_to_del',
                'status'    => $msgNO['has_no_auth_to_del']
            );
            $this->ajaxReturn($r);
        }

        $result     = $comment->deleteComment($comment_id);
        if($result){
            $r      = array(
                'data'      => $result,
                'msg'       => 'del_comment_success',
                'status'    => $msgNO['del_comment_success']
            );
        } else {
            $r      = array(
                'data'      => array(),
                'msg'       => 'del_comment_failed',
                'status'    => $msgNO['del_comment_failed']
            );
        }
        
        $this->ajaxReturn($r);
    }
}