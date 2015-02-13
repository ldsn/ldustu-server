<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class CommentController extends Controller { //评论模块

	/*评论首页
	*写入评论功能
	*删除评论功能
	*/
	public function index(){
		echo "评论首页";	
	}
	public function getComment(){
              $comment = D('comment');
              $comment->catchComment($aid = 4,$startid = 0,$count =1);
        	  }
	public function comment(){	//评论动作
		$comment = M('comment');
		$userid = 3;
		$beuserid = $postbeuserid?$postbeuserid:0;
		$art_id = 4;
		$commentContent = '213789217938点击打我ijo';
		$com_time = time();
		$data = array(
			'user_id' => $userid,
			'beuser_id' =>$beuserid,
			'art_id' =>$art_id,
			'coment_content' =>$commentContent,
			'com_time' =>$com_time,
			);
		$result = $comment->add($data);
		if($result){
			$SmartyOutput = json_encode('评论成功！');
		}else{
			$SmartyOutput = json_encode('评论失败！');
		}
		print_r($SmartyOutput);
	}
	public function deleteComment(){ //删除留言
		$com_id = 1;
		$where['com_id'] = $com_id;
		$comment = M('comment');
		$result = $comment ->where($where)->delete();
		if($result){
			$SmartyOutput = json_encode('删除成功');
		}else{
			$SmartyOutput = json_encode('删除失败');
		}
		print_r($SmartyOutput);
	}
	public function showcomment(){

	}

}