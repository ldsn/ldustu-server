<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ArticleModel extends RelationModel{
	protected $_link = array(
		'Article_detial' =>array(
				'mapping_type'=>self::HAS_ONE,
				'mapping_name'=>'Article_detial',
				'class_name'=>'Article_detial',
				'foreign_key'=>'art_id',
				
			),
		);
	public function getArticle($getPage){ //获取文章页面
            $num = $getPage*10;
            $result = $this->limit($num,20)->where('ismake=1')->order('art_time desc')->select();
            $Output = array(
                      'error'=>0,
                      'data' =>array(
                              $result
                        ),
                );	

           return  $result1 = json_encode($Output);
           
        	}	
        	public function favour($art_id){
        		$where['art_id'] = $art_id;
        		$this->where($where)->select();
        	}
} 