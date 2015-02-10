<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
Vendor('Test.Readability');
class ArticleController extends Controller {
	 // const USER_AGENT = "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 5.2; Trident/4.0)";
	/*
	*文章首页
	*文章发布页面
	*文章发布功能
	*文章内容页
	*/
	public function index(){
		echo "文章首页";
	}
	public function Article(){ //发布文章页面
	   	$username = cookie('username');
    		if($username&&$username!=''){ //判断是否登陆过
    		$column = M('column');
		$this->clu_id = $column->select();

    		$this->display('Article/Article');
    		}else{
    			redirect('/home/login',2,'请登录');
    		}
	   	
	   }
	public function publish(){ //发布文章动作
		//文章主表 字段构造
		$user = D('user');
		$user_id = $user->userip(cookie('username'));
		$time = time();
		$keyword = keyword;
		$art_des = $_POST['description'];
		$content =$_POST['content'];
		$href_pic = $_POST['href_pic'];
		$source = $_POST['source'];
		$clu_id = $_POST['column'];
		$article = M('article');  // 初始化文章表
		$detial = M('article_detial');
		
		$articleIn = array(
			'user_id' =>$user_id,
			'clu_id' =>$clu_id,
			'art_time'=>$time,
			'keywor d'=>$keyword,
			);
		$art_id = $article->add($articleIn); //插入文章主表
		$detialIn = array(
			'art_id' => $art_id,
			'art_title' => inject_check($_POST['title']),
			'art_des' =>$art_des,
			'content' =>$content,
			'href_pic' =>$href_pic,
			'source' =>$source, 
			);
		$de_id = $detial->add($detialIn);
		if($art_id&&$de_id){ //如果存在文章ID和文章细节ID
			$this->success('文章发布成功','/home/user/index');
		}else{
			$this->error('文章发布失败');
		}
	}
	public function showArticle(){//文章内容页
		/*$username = cookie('username');
		if($username&&$username!=''){
			//判断是否登陆，显示登陆菜单操作
		}*/
		$art_id = $_GET['art_id'];
		$article = M('article');
		$detial = M('article_detial');
		$where['art_id']  = $art_id;
		$result = $article->where($where)->find();
		$detialResult = $detial->where($where)->find();
		$data['vit_num'] = $detialResult['vit_num'] +1;
		$detial->where($where)->save($data);
		dump($result);
		dump($detialResult);
		$this->display('Article/showArticle');
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