<?php
namespace Pc\Controller;
use Think\Controller;
header('Content-Type: text/html; charset=utf-8;');
class AdController extends Controller{
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