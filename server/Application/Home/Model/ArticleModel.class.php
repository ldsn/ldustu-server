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
            $user = M('user');
            $error = 0;
            $where = array(
                'ismake' => 1,
                'clu_id' =>$cid,
               );
            $result =  $this->limit($startid,$getnum)->where($where)->order('time desc')->select();
            $listNum = count($result);
            if($listNum<$getnum){
              $end = true;
            }else{
              $end = false;
            }
            foreach($result as $key=> $value){    
                       $new[$key]['art_id'] = (int)$value['art_id'];
                       $new[$key]['user_id'] = (int)$value['user_id'];
                       $new[$key]['clu_id'] = (int)$value['clu_id'];
                       $new[$key]['ismake'] = (int)$value['ismake'];
                       $new[$key]['favour'] = (int)$value['favour'];
                       $new[$key]['visit'] = (int)$value['visit']; 
                       $new[$key]['comment'] = (int)$value['comment']; 
                       $new[$key]['title'] = $value['title'];
                       $new[$key]['desription'] = $value['desription'];
                       $new[$key]['time'] = (int)$value['time'];
                       $new[$key]['from'] = $value['from'];
                       $where['user_id'] = $new[$key]['user_id'];
                       $userinfo = $user->where($where)->field('username')->find();
                       $new[$key]['username'] = $userinfo['username'] ;
            }
            if(!$result||$result ==''){
               $error = 1;
               $new = '取不到数据';
            }
            $Output = array(
                      'error'=>$error,
                      'data' =>$new,
                      'end' =>$end,
                      'listNum' =>$listNum,
                );	

           return  $result1 = json_encode($Output);
           
        	}	
        	public function favour($art_id,$user_id){
        		$where = array(
                            'art_id' => $art_id,
                            'user_id' => $user_id,
                          );
        		$this->where($where)->select();
        	}
            
} 