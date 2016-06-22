<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<h1>검색 결과</h1>
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$word = $_POST['word'];
		}		
		
		$file_name = 'result.txt';
		$file_handle = fopen ($file_name, 'r');
		$arr2 = array();
		$index = 0;
		while (($line = fgets($file_handle)) !== false) {
			$arr = explode ("\t", $line);
			if (count ($arr) === 2) {
				$words = $arr[0];
				if ((strpos($words, $word)) !== false)	{
					$arr2[$index] = $words;
					$index += 1;
				}
			}			
		}
		fclose ($file_handle);
		
		if ((count ($arr2)) !== 0) {
			$token = ', ';		
			echo $word.' 를 포함하고있는 단어는<br><br>';
			echo implode ($token, $arr2).'<br><br>';
			echo '총 '.count ($arr2).'개 입니다.';			
		} else {
			echo $word.' 를 포함하고있는 단어는<br><br>';
			echo '총 '.count ($arr2).'개 입니다.';
		}	
	?>
</html>