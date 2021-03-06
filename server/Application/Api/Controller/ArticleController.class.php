<?php
namespace Api\Controller;
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
        $p              = $p?$p:1;
        $count          = 20;
        $offset         = ($p-1)*$count;
        //栏目
        $column_id      = I('post.column_id',0,'int');
        if($column_id){
            $conditions['column_id']    = $column_id;
        }
        //用户
        $user_id        = I('post.user_id',0,'int');
        if($user_id){
            $conditions['user_id']      = $user_id;
        }
        //只列出已审核文章
        $conditions['status']       = 1;

        $article_model      = D('Article');
        $result             = $article_model->getList($conditions,$offset,$count);
        $result_total       = $article_model->getList($conditions,0,0,'',true);
        $page               = array(
            'total'             => $result_total,
            'total_page'        => ceil($result_total/$count)
        );
        $r                  = array(
            'list'      => $result,
            'page'      => $page
        );

        if($result){
            ajaxReturn($r, 'get_article_success', $msgNO['get_article_success']);
        } else {
            ajaxReturn($result, 'get_article_empty', $msgNO['get_article_empty']);
        }
    }

    /**
     * 获取当个文章详情
     * @author ety001
     */
    public function showArticle(){//文章内容页
        $msgNO          = array(
            'article_id_empty'          => -1,
            'no_article'                => 0,
            'get_article_success'       => 1
        );
        $article_id         = I('post.aid',0,'int');
        if(!$article_id){
            ajaxReturn(array(), 'article_id_empty', $msgNO['article_id_empty']);
        }

        $article_model      = D('Article');
        $result             = $article_model->getDetail($article_id);
        if($result){
            ajaxReturn($result, 'get_article_success', $msgNO['get_article_success']);
        } else {
            ajaxReturn(array(), 'no_article', $msgNO['no_article']);
        }
    }

    /**
     * 发表文章
     * @author ety001
     */
    public function publish(){ //发布文章动作
        $msgNO          = array(
            'not_login'                 => -1,
            'need_title'                => -2,
            'need_content'              => -3,
            'add_failed'                => -4,
            'need_column_id'            => -5,
            'add_success'               => 1
        );
        
        if(!authLogin()){
            ajaxReturn(array(), 'not_login', $msgNO['not_login']);
        }
        $user_id            = session('user_info.user_id');
        
        $article_model      = D('Article');  // 初始化文章模型

        $content = $_POST['content'];
        $content = preg_replace('/<script>.*?<\/script>/is', '', $content);
        $content_str = preg_replace ( "/(\<[^\<]*\>|\r|\n|\s|\[.+?\])/is", ' ', $content);
        $description = mb_substr($content_str,0,140,'utf-8');
        $description = str_replace('&nbsp;', '', $description);
        $thumbnail   = I('post.thumbnail','');
        $goal_url    = '/http/';
        $preg_result = preg_match($goal_url, $thumbnail);
        if($preg_result){
                $access_key = '-whDl59QdzDoavrzKrQy1YOCRWG6Cho_N5i7IYlf';
                $secret_key = 'updP5BOIsUlLh5MlOCEpSDpfT9oktxs0-KbCAru6';
                $qiniu_bucket = 'ldsnv6'; 
                  
                  
                $fetch     = urlsafe_base64_encode($thumbnail);
                $suffix    = strrchr($thumbnail,'.');
                switch ($suffix) {
                    case '.jpg':
                        break;
                    case '.png':
                        break;
                    case '.gif':
                        break;
                    case '.jpeg':
                        break;
                    default:
                        $suffix = '';
                        break;
                }
                $file_name = 'userUpload/'.time().'000_'.$user_id.$suffix; 
                $to        = urlsafe_base64_encode($qiniu_bucket.':'.$file_name);
                  
                $url  = 'http://iovip.qbox.me/fetch/'. $fetch .'/to/' . $to;  
                  
                $access_token = generate_access_token($access_key, $secret_key, $url);
                  
                $header[] = 'Content-Type: application/json';  
                $header[] = 'Authorization: QBox '. $access_token;  
                  
                  
                $con = qiniu_send('iovip.qbox.me/fetch/'.$fetch.'/to/'.$to, $header);

                $re_con = json_decode($con,true);
                if($re_con['error']){
                    $thumbnail = '';
                }else{
                    $thumbnail = $file_name;
                }
        }else{
            $thumbnail   = I('post.thumbnail','');
        }

        $data       = array(
            'user_id'           => session('user_info.user_id'),
            'column_id'         => I('post.column_id',0,'int'),
            'status'            => 1,
            'title'             => I('post.title'),
            'description'       => substrCut(I('post.content'),50),
            'thumbnail'         => $thumbnail,
            'create_time'       => time(),
            'from_device'       => 'wap',
            'description'       => $description,
            'detail'            => array(
                'content'           => $content,
                'tag'               => I('post.tag','')//这个功能的数据库结构让人很疑惑，不建议先使用
            )
        );

        if(!$data['title']){
            ajaxReturn(array(), 'need_title', $msgNO['need_title']);
        }

        if(!$data['column_id']){
            ajaxReturn(array(), 'need_column_id', $msgNO['need_column_id']);
        }

        if(!$data['detail']['content']){
            ajaxReturn(array(), 'need_content', $msgNO['need_content']);
        }

        $result                 = $article_model->publish($data);
        if($result){
            ajaxReturn($result, 'add_success', $msgNO['add_success']);
        } else {
            ajaxReturn(array(), 'add_failed', $msgNO['add_failed']);
        }
    }

    /**
     * 删除文章
     * @author ety001
     */
    public function remove(){
        $msgNO          = array(
            'need_article_id'   => -1,
            'has_no_auth'       => -2,//没有权限
            'remove_failed'     => -3,
            'remove_success'    => 1
        );
        $article_id     = I('post.aid',0,'int');
        if(!$article_id){
            ajaxReturn(array(), 'need_article_id', $msgNO['need_article_id']);
        }
        $article_model  = D('Article');
        $user_id            = session('user_info.user_id');
        $user_model         = D('User');
        $user_info          = $user_model->where(array('user_id'=> $user_id))
                                         ->field('level_status')
                                         ->select();
        $admin = !!($user_info[0]['level_status'] > 0);
        $result         = $article_model->changeStatus($article_id, -1, $admin);
        switch ($result) {
            case '-1':
                ajaxReturn(array(), 'has_no_auth', $msgNO['has_no_auth']);
                break;
            case false:
                ajaxReturn(array(), 'remove_failed', $msgNO['remove_failed']);
                break;
            default:
                ajaxReturn(array(), 'remove_success', $msgNO['remove_success']);
                break;
        }
    }
    /**
     * 更新文章信息
     * @author Jason
     */
    public function update_article()
    {
        $msgNO          = array(
            'not_login'                 => -1,
            'need_title'                => -2,
            'need_content'              => -3,
            'update_failed'             => -4,
            'need_column_id'            => -5,
            'need_article_id'           => -6,
            'update_success'            => 1
        );
        
        if(!authLogin()){
            ajaxReturn(array(), 'not_login', $msgNO['not_login']);
        }
        $user_id            = session('user_info.user_id');
        
        $article_model      = D('Article');  // 初始化文章模型

        $content = $_POST['content'];
        $content = preg_replace('/<script>.*?<\/script>/is', '', $content);
        $content_str = preg_replace ( "/(\<[^\<]*\>|\r|\n|\s|\[.+?\])/is", ' ', $content);
        $description = mb_substr($content_str,0,140,'utf-8');
        $description = str_replace('&nbsp;', '', $description);
        $article_id  = I('post.article_id');
        if(!$article_id){
            ajaxReturn(array(), 'need_article_id', $msgNO['need_article_id']);
        }
        $data       = array(
            'column_id'         => I('post.column_id',0,'int'),
            'status'            => 1,
            'title'             => I('post.title'),
            'description'       => substrCut(I('post.content'),50),
            'thumbnail'         => I('post.thumbnail',''),
            'from_device'       => 'wap',
            'description'       => $description,
            'detail'            => array(
                'content'           => $content,
                'tag'               => I('post.tag','')//这个功能的数据库结构让人很疑惑，不建议先使用
            )
        );

        if(!$data['title']){
            ajaxReturn(array(), 'need_title', $msgNO['need_title']);
        }

        if(!$data['column_id']){
            ajaxReturn(array(), 'need_column_id', $msgNO['need_column_id']);
        }

        if(!$data['detail']['content']){
            ajaxReturn(array(), 'need_content', $msgNO['need_content']);
        }

        $result                 = $article_model->update_article($data,$article_id);
        if($result !== false){
            ajaxReturn($result, 'update_success', $msgNO['update_success']);
        } else {
            ajaxReturn(array(), 'update_failed', $msgNO['update_failed']);
        }
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