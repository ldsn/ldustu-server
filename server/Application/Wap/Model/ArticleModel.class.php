<?php
namespace Wap\Model;
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
				'foreign_key'=>'aid',		
			),
		);

      public function articleArticle($aid){
            if(!isset($aid)){
                    $returnJson=array(
                      'error'=>1001,
                      );
            }else{
                 $result = $this->relation(true)->find($aid);
                 $result['content']= $result['Article_detial']['content'];
                 $result['tag'] = $result['Article_detial']['tag']; 
                 $result['Article_detial'] = null;
                 if($result&&$result!=''){
                      $returnJson=array(
                      'error'=>0,
                      );
                    }else{
                      $returnJson=array(
                      'error'=>1002,
                      );
                    }
            }
            $result['error'] =$returnJson['error'];
            return $result;
      }
      public function publishArticle($data){
            $uid = session('id');
            if($uid&&$uid!=''){
              $result = $this->relation(true)->add($data);
           }else{
            $resultU['error'] = 1003;
            $this->ajaxReturn($resultU);
           }
            return $result;
      }
	public function getArticle($startid,$getnum,$cid,$comGetNum){ 
            $user = M('user');
            $comment = M('comment');
            $error = 0;
            $where = array(   //构造取值条件
                'ismake' => 1,
                'clu_id' => $cid,
               );
            $result =  $this->limit($startid,$getnum)->where($where)->order('time desc')->select();
            $listNum = count($result);
            if($listNum<$getnum){   //判断文章能够再取 ，true 不能继续取
              $end = true;
            }else{
              $end = false;
            }
            foreach($result as $key=> $value){    
                       $new[$key]['aid'] = (int)$value['id'];
                       $new[$key]['uid'] = (int)$value['uid'];
                       $new[$key]['cid'] = (int)$value['cid'];
                       $new[$key]['ismake'] = (int)$value['ismake'];
                       $new[$key]['favour'] = (int)$value['favour'];
                       $new[$key]['visit'] = (int)$value['visit']; 
                       $new[$key]['comment'] = (int)$value['comment']; 
                       $new[$key]['title'] = $value['title'];
                       $new[$key]['desription'] = $value['desription'];
                       $new[$key]['image'] = $value['image'];
                       $new[$key]['time'] = (int)$value['time'];
                       $new[$key]['from'] = $value['from'];
                       $where['id'] = $new[$key]['uid'];
                       $userinfo = $user->where($where)->field('username')->find();
                       $new[$key]['username'] = $userinfo['username'];
                       $where1['aid'] = $new[$key]['aid'];
                       $cominfo = $comment->where($where1)->limit(0,$comGetNum)->order('time desc')->select();
                       $comListNum = count($cominfo);
                       if($comListNum<=$comGetNum){
                            $comEnd = true;
                        }else{
                          $comEnd = false;
                        }
                       $new[$key]['cominfo'] = $cominfo;
                       $new[$key]['comEnd'] = $comEnd;
                       $new[$key]['comListNum'] = $comListNum;
            }
                        if(!$result||$result ==''){
                           $error = 1002;
                        }
                        $Output = array(
                                  'error'=>$error,
                                  'data' =>$new,
                                  'artEnd' =>$end,
                                  'artListNum' =>$listNum,
                            );	
                         return  $Output;
           
        	}
            
} 