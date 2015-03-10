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
	public function favour(){
		$aid = I('get.aid');
		if($aid&&$aid!=''){
			$uid = session('id');
			if($uid&&$uid!=''){
				$where = array(
				'uid' => $uid,
				'aid' => $aid,
					);
				$favour = M('favour');
				$result = $favour->where($where)->select();
				$whereNum['aid'] = $aid;
				$resultNum = $favour->where($whereNum)->select();
				//dump($resultNum);
				$article = D('article');
				$where1['id'] = $aid;
				//dump($where1);
				$favourNum = count($resultNum);	
				if($result&&$result!=''){
					$data['id'] = $aid;		
					$data['favour'] = $favourNum-1;
					//dump($data);
					$artResult1 = $article->data($data)->where($where1)->save();
					$favour->where($where)->delete();
					//dump($artResult1);
					if($artResult1){
						$outData['error'] = '1009';
					}else{
						$outData['error'] = '1002';
					}

				}else{	//echo '否则';
					$faResult = $favour->add($where);
					$data['favour'] = $favourNum+1;
					$artResult1 = $article->where($where1)->save($data);
					$outData['error'] = '1008';
				}
			}else{
				$outData['error'] = 1003;
			}
		}else{
			$outData['error'] = 1001;
		}
		
		
		$this->ajaxReturn($outData);
	}
}