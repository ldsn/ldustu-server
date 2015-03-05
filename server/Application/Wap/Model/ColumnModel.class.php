<?php
namespace Wap\Model;
use Think\Model;
class ColumnModel extends Model{
	public function getall(){
		$colu = $this ->field('id,name')->select();
		$result = json_encode($colu);
		if($colu&&$colu!=''){
			$result['error'] = 0;
		}else{
			$result['error'] = 1002;
		}

		return $result;
	}	
} 