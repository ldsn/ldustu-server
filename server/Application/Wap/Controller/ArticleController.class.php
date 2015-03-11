<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
Vendor('Test.Readability');
class ArticleController extends Controller {
	/*
	*获取文章列表
	*
	*/
	public function getArticle(){
	              $article = D('article');
	              $startid = I('get.startid')?I('get.startid'):0;
	              $getnum = I('get.getnum')?I('get.getnum'):10;
	              $cid =I('get.cid')?I('get.cid'):1;
	              $comGetNum = I('get.comGetNum')?I('get.comGetNum'):3;
	              $comStartId = 0;
	              if($getnum>50){
	              	$getnum = 50;
	              	$result['error'] = 1010;
	              }
	              if($comGetNum>50){
	              	$comGetNum = 50; 
	              	$result['error'] = 1010;
	              }
	              $result = $article->getArticle($startid,$getnum,$cid,$comStartId,$comGetNum);
	
	              $this->ajaxReturn($result);
        	  }
        	public function showArticle(){//文章内容页
        		$aid = I('get.aid');
        		if($aid&&$aid!=''){
        			$article = D('article');
        			$result = $article->articleArticle($aid);
        		}else{
        			$result['error'] = 1001;
        		}
        		
        		$this->ajaxReturn($result);
	}
	public function publish(){ //发布文章动作
		//文章主表 字段构造
		$uid =session('id');
		if($uid){
			$article = D('article');  // 初始化文章模型
			$user = D('user'); //初始化用户模型
			$cid =I('post.cid');
			$title = I('post.title');
			$content =I('post.content','','HtmlFilter');
			$contentCut = substr_cut($content,120);
			$description = I('post.description')?I('post.description'):$contentCut;
			$image =I('post.image')?I('post.image'):null;
			$time = time();
			$from =I('post.from')?I('post.from'):null;
			$tag = I('post.tag')?I('post.tag'):null;
			$data = array(
				'uid'=>$uid ,
				'cid'=>$cid,
				'title' =>$title,
				'description' => $description,
				'image' =>$image,
				'time' =>$time,
				'from' =>$from,
				'Article_detial'=>array(
					'content'=>$content,
					'tag' =>$tag,
					),
				);
			$result = $article->publishArticle($data);

			if($result){ //如果存在文章ID和文章细节ID
				$returnJson['error'] = 0;
			}else{
				$returnJson['error'] = 1002;
			}
		}else{
			$returnJson['error'] = 1003;
		}
		
		$this->ajaxReturn($returnJson);
	}
	

	public function curlArticle(){
                  $request_url = getRequestParam("url",  "");
                  if($request_url&&$request_url!=''){
                  	 $output_type = strtolower(getRequestParam("type", "html"));

	                  //curl 抓取网页内容
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $request_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$source = curl_exec($ch);
			curl_close($ch);
		     //对抓取的内容进行整理
	                  preg_match("/charset=([\w|\-]+);?/", $source, $match);
	                  $charset = isset($match[1]) ? $match[1] : 'utf-8';
	                  $Readability = new \Readability($source,$charset);
	                  $Data = $Readability->getContent();
                  }else{
                  	$Data['error'] = 1001;
                  }
                 $this->ajaxReturn($Data);
            }	
}