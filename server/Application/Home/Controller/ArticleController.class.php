<?php
namespace Home\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class ArticleController extends Controller {
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
}