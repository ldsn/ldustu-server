<?php
namespace Pc\Model;
use Think\Model;
class AdModel extends Model{
    /**
     * 广告数据获取
     * @author Jason
     */
    public function getad($type)
    {
        $time = 2;//time();
        $where['start_time'] = array('lt',$time);
        $where['end_time']   = array('gt',$time);
        $where['ad_type']    = $type;
        $result = $this
                  ->where($where)
                  ->order("ad_index asc")
                  ->select();
        return $result;
    }
    /**
     * 广告数据写入
     * @author Jason
     * @param $data 数组 {$ad_type,$ad_name,$create_time,$start_time,$end_time,$ad_content};
     */
    public function setad($data)
    {
        $result = $this
                  ->data($data)
                  ->add();
        return $result;
    }
    /**
     * 广告数据更改
     * @author Jason
     * @param $data 数组 {$ad_type,$ad_name,$create_time,$start_time,$end_time,$ad_content};
     */
    public function changead($ad_id,$data)
    {
        $where['ad_id']  = $ad_id;
        $result          = $this
                           ->where($where)
                           ->save($data);
        return $result;
    }
    /**
     * 广告数据删除
     * @author Jason
     * @param $ad_id  广告ID
     */
    public function deletead($ad_id)
    {
        $where['ad_id'] = $ad_id;
        $result         = $this
                          ->where($where)
                          ->delete();
        return $result;
    }

} 