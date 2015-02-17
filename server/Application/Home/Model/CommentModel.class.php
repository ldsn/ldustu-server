<?php
namespace Home\Model;
use Think\Model;
class CommentModel extends Model{
	public function comment($uid,$aid,$content ){	//评论动作
		$time = time();
		$data = array(
			'uid' => $uid,
			'aid' =>$aid,
			'content' =>$content,
			'time' =>$time,
			);
		$result = $this->add($data);
		if($result){
			$SmartyOutput = json_encode('评论成功！');
		}else{
			$SmartyOutput = json_encode('评论失败！');
		}
		return $SmartyOutput;
	}
	public function deleteComment($com_id){ //删除留言
		
		$where['com_id'] = $com_id;
		$result = $this ->where($where)->delete();
		if($result){
			$SmartyOutput = json_encode('删除成功');
		}else{
			$SmartyOutput = json_encode('删除失败');
		}
		return $SmartyOutput;
	}
}