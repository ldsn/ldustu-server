<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class IndexController extends Controller{
    public function __construct(){
        parent::__construct();
        $is_mobile = is_mobile_request();
        if(!$is_mobile)
        {
            return;
        }
        $main_url = "http://test.ldustu.com/wap";
        $column = $_GET['column'];
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
        $columnModel            = D('column');
        $column                 = $columnModel->getall();


        $article_model      = D('Article');

        $conditions['status']       = 1;
        $articleList             = $article_model->getList($conditions);

        foreach ($articleList as $k => $v) {
            $result[$k]['create_time_string'] = date('<b>m/d</b><b>H:i更新</b>', $result[$k]['create_time']);
        }

        $hotList                = $article_model->getList(null,null,6,'view_num desc');

        //var_dump($result);
        //取出用户信息user_info
        if($_SESSION['user_info']['user_id']){
                $user_info          = M('User')->where('user_id='.$_SESSION['user_info']['user_id'])->select();
                $user_info          = $user_info[0];
                unset($user_info['password']);
            }
        $is_mobile = is_mobile_request();
        if($is_mobile){
            $this->assign('user_info', json_encode($user_info));
            $this->assign('column', json_encode($column));
            $this->display('ldsn-wap/page/index');
            return;
        }
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
        $columnModel            = D('column');
        $column                 = $columnModel->getall();


        $article_model          = D('Article');
        $articleList            = $article_model->getList($conditions);
        $hotList                = $article_model->getList(null,null,6,'view_num desc');

        //var_dump($result);
        //取出用户信息user_info
        if($_SESSION['user_info']['user_id']){
                $user_info          = M('User')->where('user_id='.$_SESSION['user_info']['user_id'])->select();
                $user_info          = $user_info[0];
                unset($user_info['password']);
            }
        $this->assign('hotList', $hotList);
        $this->assign('articleList', $articleList);
        $this->assign('user_info', $user_info);
        $this->assign('column', $column);
        $this->assign('column_id', $column_id);
        $this->display('ldsn-pc/page/category');

    }
    /**
     * 文章内容页
     * @author Jason
     */
    public function articleArticle(){
        $article_id         = I('get.aid',0,'int');
        $columnModel            = D('column');
        $column                 = $columnModel->getall();


        $article_model      = D('Article');
        $hotList                = $article_model->getList(null,null,6,'view_num desc');

        $article             = $article_model->getDetail($article_id);

        //取出用户信息user_info
        if($_SESSION['user_info']['user_id']){
                $user_info          = M('User')->where('user_id='.$_SESSION['user_info']['user_id'])->select();
                $user_info          = $user_info[0];
                unset($user_info['password']);
            }
        $this->assign('article', $atricle);
        $this->assign('hotList', $hotList);
        $this->assign('user_info', $user_info);
        $this->assign('column', $column);
        $this->assign('column_id', $article['column_id']);
        $this->display('ldsn-pc/page/article');
    }
}
