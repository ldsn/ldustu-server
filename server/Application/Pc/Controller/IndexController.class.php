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
        echo U();
        //实例化栏目
        $columnModel            = D('column');
        $column                 = $columnModel->getall();


        $article_model      = D('Article');

        $conditions['status']       = 1;
        $articleList             = $article_model->getList($conditions);

        foreach ($articleList as $k => $v) {
            $articleList[$k]['create_time_string'] = date('<b>m/d</b><b>H:i更新</b>', $articleList[$k]['create_time']);
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

        $current_column         = $columnModel->where(array('column_id'=>$column_id))->find();
        $current_column         = $current_column['column_name'];

        $article_model          = D('Article');
        $articleList            = $article_model->getList($conditions);

        foreach ($articleList as $k => $v) {
            $articleList[$k]['create_time_string'] = date('<b>m/d</b><b>H:i更新</b>', $articleList[$k]['create_time']);
        }
        
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
        $this->assign('current_column', $current_column);
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
        if ($article) {
            $article['create_time_string'] = date('m-d H:i:s', $article['create_time']);
        }

        //取出用户信息user_info
        if($_SESSION['user_info']['user_id']){
                $user_info          = M('User')->where('user_id='.$_SESSION['user_info']['user_id'])->select();
                $user_info          = $user_info[0];
                unset($user_info['password']);
            }
        $this->assign('article', $article);
        $this->assign('hotList', $hotList);
        $this->assign('user_info', $user_info);
        $this->assign('column', $column);
        $this->assign('column_id', $article['column_id']);
        $this->display('ldsn-pc/page/article');
    }
    /**
     *写入广告
     * @author Jason
     * 请接收前端传入的变量替换静态数据
     */
    public function setad()
    {

        $ad = D('Ad');
        $data = array(
            'ad_type'       => 'index',//I(post.ad_type);
            'ad_index'      => '1',//I(post.ad_index);
            'ad_name'       => 'jason',//I(post.ad_name);
            'create_time'   => '4119874428',//I(post.create_time);
            'start_time'    => '4271893131',//I(post.start_time);
            'end_time'      => '7281973811',//I(post.end_time);
            'ad_content'    => 'rhwaoijdoi',//I(post.ad_content);

            );
        $result = $ad->setad($data);
        if($result)
        {
            $this->redirect('写入成功','index/setad');
            //echo '<script>alert("写入成功");</script>';
        }else{
            $this->redirect('写入失败','index/setad');
        }
    }
    /**
     * 取出广告
     * @author Jason
     * @param  $type 
     * 请把应该接受的数据替换成动态接收
     */
    public function getad()
    {
        $ad     = D('Ad');
        $ad_type  = 'index';//I(post.ad_id);
        $result = $ad->getad($ad_type);
        var_dump($result);
    }
    /**
     * 更改广告信息
     * @author Jason
     * @param $ad_id
     * @param $data
     *请把静态数据改成动态接收
     */
    public function changead()
    {
        $ad     = D('Ad');
        $ad_id  = 1;//I(post.ad_id);
        $data   = array(
            'create_time'   => '4119874428',//I(post.create_time);
            'start_time'    => '4271893131',//I(post.start_time);
            'end_time'      => '7281973811',//I(post.end_time);
            'ad_content'    => 'rhwaoijdoi',//I(post.ad_content);
            ); 
        $result = $ad->changead($ad_id,$data);
        var_dump($result);
    }
    /**
     * 删除广告
     * @author Jason
     * @param $ad_id
     * 请把静态数据改成动态接收
     */
    public function deletead()
    {
        $ad     = D('Ad');
        $ad_id  = 1;//I(post.ad_id);
        $result = $ad->deletead($ad_id);
        var_dump($result);
    }
}
