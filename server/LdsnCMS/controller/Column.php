<?php
class Column extends spController
{
	function ColumnAdd(){
		$ldsn_column = spClass('ldsn_column');
		$title = $this->spArgs('title');
		$descript = $this->spArgs('descript');
		$time = time();
		$newrow = array(
			'clu_title' => $title,
			'clu_descript' => $descript,
			'clu_time' => $time,
			);
		$ColumnInput = $ldsn_column->create($newrow);
		if($ColumnInput){
			$this->success('yeah , you add a column',spUrl('main','pageColumnAdd'));
		}else{
			$this->error('sorry ,add colunm faild',spUrl('main','pageColumnAdd'));
		}
	}
}