<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<h1>angram 단어</h1>
<?php
	function get_anagram ($ana) {
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
		$arr3 = array();
		$index = 0;
		foreach ($arr2 as $value){
			if (count_chars($ana, 1) === count_chars($value, 1)){
				if ($ana !== $value) {
				$arr3[$index] = $value;
				$index += 1; 
				}
			}			
		}
		
		$token = ', ';
		$result = implode ($token, $arr3);
		echo $ana.'의 anagram 단어는<br><br>'.$result.'<br><br>총 '.count ($arr3).'개 입니다.';	
	
		return;
	}
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$word = $_POST['word'];
			echo get_anagram($word);
		}
	
	


?>
</html>

