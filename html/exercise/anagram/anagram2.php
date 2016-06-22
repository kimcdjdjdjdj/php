<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<h1>anagram 단어</h1>
<?php
		$file_name = 'result.txt';
		$file_handle = fopen ($file_name, 'r');		
		$arr2 = array();
		$index = 0;
		while (($line = fgets ($file_handle)) !== false) {
			$arr = explode ("\t", $line);
			if (count ($arr) === 2){
				$words = $arr[0];
				$arr2[$index] = $words;
				$index += 1;
			}			
		}
		fclose($file_handle);
		
		function get_split($value){
			$explod_word = str_split ($value);
			natcasesort ($explod_word);
			$implode_word = implode ("", $explod_word);
			return $implode_word;
		}		
		
		foreach ($arr2 as $value) {
			$arr3[$value] = get_split($value);
		}
		 
		foreach ($arr3 as $word => $ana) {
			$arr4[$ana][] = $word; 
		}		
		
		$token = ', ';		
		foreach ($arr4 as $ana2 => $word) {
			if(count($arr4[$ana2]) !== 1) {
				$main = $word[0];				
				$arr5 = array();
				for($index = 1; $index < count($word); $index += 1) {
					$arr5[$index] = $word[$index];				
				}
				echo $main.'의 anagram은<br>'.implode ($token, $arr5).'입니다.<br><br>';				
			}			
		}
?>
</html>

