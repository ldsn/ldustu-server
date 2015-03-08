<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class CommentController extends Controller { //评论模块
	/*评论首页
	*获取评论
	*写入评论功能
	*删除评论功能
	*/
	public function getComment($aid,$count){
	              $comment = D('comment');
	              $result = $comment->catchComment($aid,$count);
	              $this->ajaxReturn($result);
        	  }
	public function commentin($uid,$aid,$content){
		$comment = D('comment');
		$result = $comment->comment($uid,$aid,$content);
		$this->ajaxReturn($result);
	}
	public function commentdelete($com_id){
		$comment = D('comment');
		$result = $comment->deleteComment($com_id);
		$this->ajaxReturn($result);
	}

}