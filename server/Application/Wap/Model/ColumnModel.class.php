<?php
namespace Wap\Model;
use Think\Model;
class ColumnModel extends Model{
	public function getall(){
		$colu = $this ->field('colu_id,colu_name')->select();
		$result = json_encode($colu);
		return $result;
	}	
} 