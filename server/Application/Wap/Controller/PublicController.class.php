<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class PublicController extends Controller {
	/*
	*验证码
	*点赞
	*/
	public function verify($config=array('imageW'=>200,'imageH'=>50,'length'=>4,'useNoise'=>false,'codeSet'=>'0123456789')){
		$Verify =new \Think\Verify($config);
		$Verify->entry();
	}
	public function favour($uid,$aid){
		$where = array(
			'uid' => $uid,
			'aid' => $aid,
			);
		$favour = M('favour');
		$result = $favour->where($where)->select();
		//dump($result);
		$article = M('article');
		$where1['aid'] = $aid;
		if($result&&$result!=''){
			$favourNum = count($result);	
			//dump($favourNum);			
			$data['favour'] = $favourNum-1;
			$artResult1 = $article->where($where1)->save($data);
			$favour->where($where)->delete();
			//dump($artResult1);
			if($artResult1){
				$outData = '赞';
			}

		}else{	//echo '否则';
			$faResult = $favour->add($where);
			//dump($faResult);
			$data['favour'] = 1;
			$artResult1 = $article->where($where1)->save($data);
			$outData = '不赞';
		}
		print_r($outData);
	}
}