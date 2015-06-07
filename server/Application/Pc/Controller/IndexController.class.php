<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller{
    public function __construct(){
        parent::__construct();

        authLogin();        // 保持用户登录

        $is_mobile = is_mobile_request();
        if(!$is_mobile)
        {
            return;
        }
        $main_url = "http://www.ldustu.com/";
        $column = $_GET['column_id'];
        $aid    = $_GET['aid'];

        if($column){
            $url = $main_url.'#column='.$column;

        } 
        if ($aid) {
            $url = $main_url.'#article='.$aid;
        }
        header("Location:$url");
    }
    /**
     * 网站首页
     * @author Jason
     */
    public function index(){
        //实例化栏目
        $columnModel            = D('Column');
        $column                 = $columnModel->getall();

        //var_dump($result);
        //取出用户信息user_info
        if($_SESSION['user_info']['user_id']){
                $user_info          = M('User')->where('user_id='.$_SESSION['user_info']['user_id'])->select();
                $user_info          = $user_info[0];
                unset($user_info['password']);
            }
        //实例化用户对象取出用户数据
        $user                   = D('User');
        $userinfo               = $user->userinfo($_SESSION['user_info']['user_id']);
        $this->assign('level_status',$userinfo['level_status']);


        $is_mobile = is_mobile_request();
        if($is_mobile){
            $this->assign('user_info', json_encode($user_info));
            $this->assign('column', json_encode($column));
            $this->display('ldsn-wap/page/index');
            return;
        }

        $article_model      = D('Article');
        $ad_model           = D('Ad');

        $conditions['status']       = 1;
        $articleList             = $article_model->getList($conditions);

        foreach ($articleList as $k => $v) {
            $articleList[$k]['create_time_string'] = date('<b>m/d</b><b>H:i更新</b>', $articleList[$k]['create_time']);
        }

        $hotList                = $article_model->getList(array('status'=>1),null,6,'view_num desc');
        $ad_aside     = $ad_model->getad('aside');
        $ad_header     = $ad_model->getad('header');
        $head_article = $article_model->gethead_article();//取出首页顶部10条
        $head_pic_two = $article_model->gethead_pic_two();//取出首页顶部图片2条
        $this->assign('json_user_info', json_encode($user_info));
        $this->assign('json_column', json_encode($column));
        $this->assign('ad_aside',$ad_aside);
        $this->assign('ad_header',$ad_header);
        $this->assign('head_article',$head_article);
        $this->assign('head_pic_two',$head_pic_two);
        $this->assign('hotList', $hotList);
        $this->assign('articleList', $articleList);
        $this->assign('user_info', $user_info);
        $this->assign('column', $column);
        $this->assign('column_id', 0);
        $this->display('ldsn-pc/page/index');
    }
    /**
     * 文章列表页
     * @author Jason
     */
    public function listArticle(){
        $column_id      = I('get.column_id',0,'int');
        $conditions['status']       = 1;
        if($column_id){
            $conditions['column_id']    = $column_id;
        }
        //实例化栏目
        $columnModel            = D('Column');
        $column                 = $columnModel->getall();

        $current_column         = $columnModel->where(array('column_id'=>$column_id))->find();
        $current_column         = $current_column['column_name'];

        $article_model          = D('Article');
        $articleList            = $article_model->getList($conditions);

        $user                   = D('User');
        foreach ($articleList as $k => $v) {
            $articleList[$k]['create_time_string'] = date('<b>m/d</b><b>H:i更新</b>', $articleList[$k]['create_time']);
        }
        
        $hotList                = $article_model->getList(array('status'=>1),null,6,'view_num desc');

        //var_dump($result);
        //取出用户信息user_info
        if(session('user_info.user_id')){
                $user_id  = session('user_info.user_id')?session('user_info.user_id'):0;
                $user_info = $user->userinfo($user_id);
        }
        //实例化用户对象取出用户数据
        $user                   = D('User');
        $userinfo               = $user->userinfo($_SESSION['user_info']['user_id']);
        $this->assign('level_status',$userinfo['level_status']);
        
        $head_pic_two = $article_model->gethead_pic_two();//取出首页顶部图片2条

        $ad_model           = D('Ad');
        $ad_aside     = $ad_model->getad('aside');
        $ad_header     = $ad_model->getad('header');


        $this->assign('json_user_info', json_encode($user_info));
        $this->assign('json_column', json_encode($column));
        $this->assign('ad_aside',$ad_aside);
        $this->assign('ad_header',$ad_header);
        $this->assign('head_pic_two',$head_pic_two);
        $this->assign('hotList', $hotList);
        $this->assign('articleList', $articleList);
        $this->assign('user_info', $user_info);
        $this->assign('column', $column);
        $this->assign('current_column', $current_column);
        $this->assign('column_id', $column_id);
        $this->display('ldsn-pc/page/category');

    }
    /**
     * 文章内容页
     * @author Jason
     */
    public function articleArticle(){

        $article_id             = I('get.aid',0,'int');
        $columnModel            = D('Column');
        $column                 = $columnModel->getall(); //获取所有栏目


        $article_model       = D('Article');
        $user                = D('User');
        $hotList             = $article_model->getList(array('status'=>1),null,6,'view_num desc');

        $article             = $article_model->getDetail($article_id);
        if ($article) {
            $article['create_time_string'] = date('m-d H:i:s', $article['create_time']);
            foreach ($article['comment_list'] as $k => $v) {
                $article['comment_list'][$k]['create_time_string'] = date('m-d H:i:s', $v['create_time']);
            }
        }

        //取出用户信息user_info
        if(session('user_info.user_id')){
                $user_id  = session('user_info.user_id')?session('user_info.user_id'):0;
                $user_info = $user->userinfo($user_id);
        }
        //将更新信息提出
        $update         = M('Article_update');
        //$user           = M('User');
        $tb_update      = $update->where()->select();
        foreach($tb_update as $k => $v)
        {
          $tb_update[$k]['user_id'] = $user->where('user_id='.$tb_update[$k]['user_id'])->field('username')->find();
        }
        //获取广告
        $ad_model           = D('Ad');
        $ad_aside     = $ad_model->getad('aside');
        $ad_header     = $ad_model->getad('header');

        $this->assign('tb_update',$tb_update); 

        $this->assign('json_user_info', json_encode($user_info));
        $this->assign('json_column', json_encode($column));
        $this->assign('level_status',$userinfo['level_status']);

        $this->assign('ad_aside',$ad_aside);
        $this->assign('ad_header',$ad_header);

        $this->assign('article', $article);
        $this->assign('hotList', $hotList);
        $this->assign('user_info', $user_info);
        $this->assign('column', $column);
        $this->assign('column_id', $article['column_id']);


        $this->display('ldsn-pc/page/article');
    }
    /*
     * 发表文章页面
     */
    public function publishArticle () {

        //取出用户信息user_info
        if(session('user_info.user_id')){
                $user_id  = session('user_info.user_id')?session('user_info.user_id'):0;
                $user_info = $user->userinfo($user_id);
        } else {
            echo "<script>alert('登陆后即可发布文章！');location.href='/'</script>";
        }

        //获取广告
        $ad_model           = D('Ad');
        $ad_aside     = $ad_model->getad('aside');
        $ad_header     = $ad_model->getad('header');

        $column                 = $columnModel->getall(); //获取所有栏目

        $this->assign('json_user_info', json_encode($user_info));
        $this->assign('json_column', json_encode($column));
        $this->assign('level_status',$userinfo['level_status']);
        $this->assign('user_info', $user_info);
        $this->assign('column', $column);
        $this->assign('ad_aside',$ad_aside);
        $this->assign('ad_header',$ad_header);
        $this->display('ldsn-pc/page/publish');
    }
}
