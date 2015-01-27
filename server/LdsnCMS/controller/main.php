<?php
class main extends spController
{
	function index(){
		header("Content-Type:text/html; charset=utf-8");
		echo "Enjoy, Speed of PHP!";
		echo "<br/>";
		echo  "<a href='".spUrl('main','pageLogin')."'>登陆<a>";
		echo "<br/>";
		echo  "<a href='".spUrl('main','pageArticleEdit')."'>发布文章<a>";
		echo "<br/>";
		echo  "<a href='".spUrl('main','pageArticleChange')."'>更改文章<a>";
		// echo "<br/>";
		// echo  "<a href='".spUrl('main','pageColumnAdd')."'><a>";
		echo "<br/>";
		echo  "<a href='".spUrl('article','articleArticle')."'>文章内容页<a>";
		echo "<br/>";
		echo  "<a href='".spUrl('article','articleDelete')."'>删除2号文章<a>";
		echo "<br/>";
		echo  "<a href='".spUrl('adUser','addUser')."'>增加用户<a>";
	}
//文章相关页面

	function pageArticleEdit(){   //发布文章页
		echo "发布文章页面";
		header("Content-Type:text/html; charset=utf-8");
		//$this->display('pageArticleEdit.htm');
		$ldsn_column = spClass('ldsn_column');
		$columnsearch = $ldsn_column->findall();
		$this->data = json_encode($columnsearch);
		$this->display('pageArticleEdit.htm');
	}
	function pageArticleChange(){ //文章更改页
		echo "文章更改页";
		header("Content-Type:text/html; charset=utf-8");
		$ldsn_article = spClass('ldsn_article');
		print_r(json_encode($ldsn_article->spLinker()->find(array('art_id'=>2))));
		$this->display('pageArticleChange.htm');
	}
	function pageArticleContent(){ //文章内容页
		header("Content-Type:text/html; charset=utf-8");
		echo '文章内容页';
		$ldsn_article = spClass('ldsn_article');
		print_r(json_encode($ldsn_article->spLinker()->find(array('art_id'=>2))));
		$this->display('pageArticleContent.htm');
	}

	//用户相关页面 

	function pageAddUser(){ //用户注册页
		header("Content-Type:text/html; charset=utf-8");
		$this->display('pageAddUser.htm');

	}

	
}