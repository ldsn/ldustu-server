<?php
namespace Wap\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
Vendor('Test.Readability');
class ArticleController extends Controller {
    /**
     * 获取文章列表
     * @author ety001
     */
    public function getList(){
        $msgNO          = array(
            'get_article_empty'        => 0,
            'get_article_success'      => 1
        );
        //翻页
        $p              = I('post.p',1,'int');
        $count          = 5;
        $offset         = ($p-1)*$count;
        //栏目
        $column_id      = I('post.column_id',0,'int');
        if($column_id){
            $conditions['column_id']    = $column_id;
        }
        //用户
        $user_id        = I('post.user_id',0,'int');
        if($column_id){
            $conditions['user_id']      = $user_id;
        }
        //只列出已审核文章
        $conditions['status']       = 1;

        $article_model      = D('Article');
        $result             = $article_model->getList($conditions,$offset,$count);
        if($result){
            $r      = array(
                'data'      => $result,
                'msg'       => 'get_article_success',
                'status'    => $msgNO['get_article_success']
            );
        } else {
            $r      = array(
                'data'      => $result,
                'msg'       => 'get_article_empty',
                'status'    => $msgNO['get_article_empty']
            );
        }
        $this->ajaxReturn($r);
    }

    /**
     * 获取当个文章详情
     * @author ety001
     */
    public function show(){//文章内容页
        $article_id         = I('get.aid');
        
        if($aid&&$aid!=''){
            $article = D('article');
            $result = $article->articleArticle($aid);
        }else{
            $result['error'] = 1001;
        }

        $this->ajaxReturn($result);
    }

    /**
     * 发表文章
     * @author ety001
     */
    public function publish(){ //发布文章动作
        //文章主表 字段构造
        $uid =session('id');
        if($uid){
            $article = D('article');  // 初始化文章模型
            $user = D('user'); //初始化用户模型
            $cid =I('post.cid');
            $title = I('post.title');
            $content =I('post.content','','HtmlFilter');
            $contentCut = substr_cut($content,120);
            $description = I('post.description')?I('post.description'):$contentCut;
            $image =I('post.image')?I('post.image'):null;
            $time = time();
            $from =I('post.from')?I('post.from'):null;
            $tag = I('post.tag')?I('post.tag'):null;
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
                    ),
                );
            $result = $article->publishArticle($data);

            if($result){ //如果存在文章ID和文章细节ID
                $returnJson['error'] = 0;
            }else{
                $returnJson['error'] = 1002;
            }
        }else{
            $returnJson['error'] = 1003;
        }
        
        $this->ajaxReturn($returnJson);
    }
    
    /**
     * 获取远程文章
     */
    public function curlArticle(){
        $request_url = getRequestParam("url",  "");
        if($request_url&&$request_url!=''){
            $output_type = strtolower(getRequestParam("type", "html"));

            //curl 抓取网页内容
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $source = curl_exec($ch);
            curl_close($ch);
            //对抓取的内容进行整理
            preg_match("/charset=([\w|\-]+);?/", $source, $match);
            $charset = isset($match[1]) ? $match[1] : 'utf-8';
            $Readability = new \Readability($source,$charset);
            $Data = $Readability->getContent();
        }else{
            $Data['error'] = 1001;
        }
        $this->ajaxReturn($Data);
    }
}