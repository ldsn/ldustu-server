<?php
class article extends spController
{	
	function articleInput(){	//文章发布动作
		header("Content-Type:text/html; charset=utf-8");
		//1、提取关键字
		echo "发布文章动作";
		$time = time();
		$user_id =1;  // 模拟一个用户的id，之后删掉
		$ismake = 0;
		$vit_num = 0;
		$content = $this->spArgs('content');
		if($this->spArgs('keyword') == '')   //检查是否有关键字，没有则从文章内容提取
			$keyword = $content; //从content中提取相关字符
		else{
			 $keyword = $this->spArgs('keyword');
		}
		$description = '（提取content中的前二十个字）';
		$newrow = array(
			'user_id'=>$user_id,
			'clu_id'=>$this->spArgs('column'),
			'art_time'=>$time,
			'ismake'=>$ismake,
			'keyword'=>$keyword,
			'detail'=>array(
				'vit_num'=>$vit_num,
				'art_title'=>$this->spArgs('title'),
				'art_des'=>$description,
				'content'=>$this->spArgs('content'),
				'href_pic'=>$this->spArgs('href_pic'),
				'source'=>$this->spArgs('source'),
				),
			);
		$ldsn_article = spClass('ldsn_article');
		$ArticleIN = $ldsn_article->spLinker()->create($newrow);
		if($ArticleIN){
			$SmartyOutput = 'login seccess';
		}else{
			$SmartyOutput = 'login faild';
		}
		print_r(json_decode($SmartyOutput));
	}
	function articleChange(){  //文章更改动作
		header("Content-Type:text/html; charset=utf-8");
		echo "文章更改动作";
		$ldsn_article = spClass('ldsn_article');
		$condition = array(
			'art_id'=>2,
			);
		$title = '更改title';
		$content = '更改内容';
		$href_pic = '';
		$source = '';
		$newrow = array(
			'detail'=>array(
				'art_title'=>$this->spArgs('title'),
				'content'=>$this->spArgs('content'),
				'href_pic'=>$this->spArgs('href_pic'),
				'source'=>$this->spArgs('source'),
				)
			);
		$result = $ldsn_article->spLinker()->update($condition,$newrow);
		if($result){
			$SmartyOutput = '修改成功';
		}else{
			$SmartyOutput = '修改失败';
		}
		print_r(json_encode($SmartyOutput));

	}
	function articleDelete(){ //文章删除动作
		header("Content-Type:text/html; charset=utf-8");
		echo '文章删除动作';
		$art_id = 2;
		$ldsn_article = spClass('ldsn_article');
		$condition = array(
			'art_id'=>$art_id,
			);
		$result =  $ldsn_article->spLinker()->delete($condition);
		if($result){
			$SmartyOutput = '修改成功';
		}else{
			$SmartyOutput = '修改失败';
		}
		print_r(json_encode($SmartyOutput));
	}
	
}