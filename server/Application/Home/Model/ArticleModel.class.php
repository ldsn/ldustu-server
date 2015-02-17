<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ArticleModel extends RelationModel{
      /*
      *关联配置
      *文章内容页获取文章信息
      *获取主页、列表获取文章信息

      */
    
	protected $_link = array(
		'Article_detial' =>array(
				'mapping_type'=>self::HAS_ONE,
				'mapping_name'=>'Article_detial',
				'class_name'=>'Article_detial',
				'foreign_key'=>'art_id',		
			),
		);

      public function articleArticle($aid){
              $result = $this->relation(true)->find($aid);
              return $result;
      }
      public function publishArticle($data){
        $result = $this->relation(true)->add($data);
        return $result;
      }
	public function getArticle($startid,$getnum,$cid,$comStartId,$comGetNum){ 
            $user = M('user');
            $comment = M('comment');
            $error = 0;
            $where = array(   //构造取值条件
                'ismake' => 1,
                'clu_id' =>$cid,
               );
            $result =  $this->limit($startid,$getnum)->where($where)->order('time desc')->select();
            $listNum = count($result);
            if($listNum<$getnum){   //判断文章能够再取 ，true 不能继续取
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
                       $new[$key]['image'] = $value['image'];
                       $new[$key]['time'] = (int)$value['time'];
                       $new[$key]['from'] = $value['from'];
                       $where['user_id'] = $new[$key]['user_id'];
                       $userinfo = $user->where($where)->field('username')->find();
                       $new[$key]['username'] = $userinfo['username'];
                       $where1['art_id'] = $new[$key]['art_id'];
                       $cominfo = $comment->where($where1)->limit($comStartId,$comGetNum)->order('com_time desc')->select();
                       $new[$key]['cominfo'] = array(
                                  $cominfo,
                        );
            }
            $comListNum = count($cominfo);
            if($comListNum<$comGetNum){
                $comEnd = true;
            }else{
              $comEnd = false;
            }
            if(!$result||$result ==''){
               $error = 1;
               $new = '取不到数据';
            }
            $Output = array(
                      'error'=>$error,
                      'data' =>$new,
                      'artEnd' =>$end,
                      'artListNum' =>$listNum,
                      'comEnd' =>$comEnd,
                      'comListNum' =>$comListNum,
                );	

           return  $result1 = json_encode($Output);
           
        	}
            
} 