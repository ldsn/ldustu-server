<?php
	function extract_keywords($str, $minWordLen = 3, $minWordOccurrences = 2, $asArray = false)
	{
	    function keyword_count_sort($first, $sec)
	    {
	        return $sec[1] - $first[1];
	    }
	    $str = preg_replace('/[^\\w0-9 ]/', ' ', $str);
	    $str = trim(preg_replace('/\s+/', ' ', $str));
	  
	    $words = explode(' ', $str);
	    $keywords = array();
	    while(($c_word = array_shift($words)) !== null)
	    {
	        if(strlen($c_word) <= $minWordLen) continue;
	  
	        $c_word = strtolower($c_word);
	        if(array_key_exists($c_word, $keywords)) $keywords[$c_word][1]++;
	        else $keywords[$c_word] = array($c_word, 1);
	    }
	    usort($keywords, 'keyword_count_sort');
	  
	    $final_keywords = array();
	    foreach($keywords as $keyword_det)
	    {
	        if($keyword_det[1] < $minWordOccurrences) break;
	        array_push($final_keywords, $keyword_det[0]);
	    }
	    return $asArray ? $final_keywords : implode(', ', $final_keywords);
	}

?>