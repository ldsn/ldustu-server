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
	public function pageArticle($style){
		$username = cookie('username');
		if($username&$username!= ''){
			if($style == 1){
				$this->display('Article/index');   //信息填写传文章
			}else{
				$this->display('Article/index');   //发表链接传文章
			}
		}
		
	}
	public function getArticle($startid = 0,$getnum = 10,$cid = 1,$comStartId = 0,$comGetNum = 3){
	              $article = D('article');
	              print_r($article->getArticle($startid,$getnum,$cid,$comStartId,$comGetNum));
        	  }
        	public function showArticle($aid){//文章内容页
        		$article = D('article');
        		$result = $article->articleArticle($aid);
        		print_r(json_encode($result));
	}
	public function Article(){ //发布文章页面
	   	$id = cookie('id');
    		if($id&&$id!=''){ //判断是否登陆过
    			$this->display('Article/Article');
    		}else{
    			redirect('/home/login',2,'请登录');
    		}
	   }
	public function publish(){ //发布文章动作
		//文章主表 字段构造
		$article = D('article');  // 初始化文章模型
		$user = D('user'); //初始化用户模型
		$uid = $user->userid(cookie('username'));
		$cid =$_POST['cid'];
		$title = $_POST['title'];
		$content =$_POST['content'];
		$description = $_POST['description']?$_POST['description']:null;
		$image =$_POST['image']?$_POST['image']:null;
		$time = time();
		$from =$_POST['from']?$_POST['from']:null;
		$tag = $_POST['tag'];
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
				)
			);
		$result = $article->publishArticle($data);

		if($result){ //如果存在文章ID和文章细节ID
			print_r(写入成功);
		}else{
			print_r(写入失败);
		}
	}
	

	public function curlArticle(){
                  $request_url = getRequestParam("url",  "");
                  echo $request_url;
                  $output_type = strtolower(getRequestParam("type", "html"));
                  echo $output_type;
                  if (!preg_match('/^http:\/\//i', $request_url) ||
	   	 !filter_var($request_url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED)) {
	  	 $this->display('Article/form');
		    exit;
		}
                	// 1. 初始化
		$ch = curl_init();
		// 2. 设置选项，包括URL
		curl_setopt($ch, CURLOPT_URL, $request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		// 3. 执行并获取HTML文档内容
		$source = curl_exec($ch);
		//print_r($source);
		// 4. 释放curl句柄
		curl_close($ch);

                  preg_match("/charset=([\w|\-]+);?/", $source, $match);
                  $charset = isset($match[1]) ? $match[1] : 'utf-8';

                  /**
                   * 获取 HTML 内容后，解析主体内容
                   */
                  $Readability = new \Readability($source,$charset);
                  /*$Readability->source = $source;
                  $Readability->input_char = $charset;*/
                  //$Readability = new Readability($source, $charset);
                  $Data = $Readability->getContent();
                  dump($Data);
                  echo $output_type;
                  switch($output_type) {
                      case 'json':
                          header("Content-type: text/json;charset=utf-8");
                          $Data['url'] = $request_url;
                          echo json_encode($Data);
                          break;

                      case 'html': default:
                          header("Content-type: text/html;charset=utf-8");
                          $this->title   = $Data['title'];
                           $this->content = $Data['content'];
                         $this->display('Article/test');
                  }
            }	
}