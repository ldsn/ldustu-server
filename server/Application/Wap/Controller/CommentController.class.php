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
	public function commentin($aid,$content){
		$comment = D('comment');
		$uid = session('id');
		if($uid&&$uid!=''){
			$result = $comment->comment($uid,$aid,$content);
			
		}else{
			$result = array(
				'error'=>1003,
				);
		}
		$this->ajaxReturn($result);
	}
	public function commentdelete($com_id){
		$comment = D('comment');
		if($uid&&$uid!=''){
			$result = $comment->deleteComment($com_id);
		}else{
			$result = array(
				'error'=>1003,
				);
		}
		$this->ajaxReturn($result);
	}

}