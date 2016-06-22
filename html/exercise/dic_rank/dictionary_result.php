

<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>

	<?php
		$file_name ='dictionary.txt';
			
		$file_handle = fopen($file_name, 'r');
		
		$dic = array();
		
		if (!$file_handle) {
			die('file could not be opened!');
		}
		
		while (true){
			
			$line = fgets($file_handle);
			
			if ($line === false){
				break;
			}
		
			
			$wordAndRank = explode ("\t", $line);
		
			if(count($wordAndRank) === 2){
				$word = $wordAndRank[0];
				$rank = intval($wordAndRank[1]);
				
				$dic[$word] = $rank; // word, rank를 어레이에 
			} else {
				die('count was'.count($wordAndRank).' Error occured!');
			}
			
		}
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			
			$post_word = $_POST['word'];
						
			
			echo $post_word.'는 '.$dic[$post_word].' 번째 단어입니다';

		}
	
	
	
		fclose ($file_handle);
	
	?>



</html>



