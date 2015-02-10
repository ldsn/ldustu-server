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
	public function getArticle($startid,$getnum,$cid){ //获取文章页面
            $where = array(
                'ismake' => 1,
                'clu_id' =>$cid,
               );
            $result = $this->limit($startid,$getnum)->where($where)->order('art_time desc')->select();
            $listNum = count($result);
            if($listNum<$getnum){
              $end = false;
            }else{
              $end = true;
            }
            $Output = array(
                      'error'=>0,
                      'data' =>$result,
                      'end' =>$end,
                      'listNum' =>$listNum,
                );	

           return  $result1 = json_encode($Output);
           
        	}	
        	public function favour($art_id){
        		$where['art_id'] = $art_id;
        		$this->where($where)->select();
        	}
            
} 