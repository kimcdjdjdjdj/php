<?php
	require_once '../../includes/mylib.php';
	
	if(isset($_GET['input'])){
		$input = $_GET['input'];
	}	
	
	echo get_words2($input, 20);
	
	function get_words($input, $num){ //text
		$file_name = '100k_combined.txt';
		$number_of_total_lines = 1000000;
		
		$words = array();
		
		$file_handle = fopen($file_name, 'r');
		if (!$file_handle) {
			die('file could not be opened!');
		}
		for ($line_number = 1; $line_number <= $number_of_total_lines; $line_number += 1) {
			// fgets는 파일의 다음 한 줄을 읽어서 그 문자열을 리턴한다.
			// 만약 더 이상 읽을 라인이 없다면, false 을 리턴한다.
			$line = fgets($file_handle);
			if ($line === false) {
				break;
			}			
			
			$wordAndRank = explode("\t", $line);
			if (count($wordAndRank) === 2) {
				$word = $wordAndRank[0];
				$rank = intval($wordAndRank[1]);
				$words[$word] = $rank;
			} else {//카운트가 1일때
				$words[$word] = 6000;
			}									
		}	
		fclose($file_handle);		
		asort($words); //랭크 순위순 정렬
		
		$selected = array();
		foreach ($words as $word => $rank){
			if(strpos($word, $input) !== false){
				$selected[]= $word;
			}
		}
		
		return implode (' ', array_slice($selected, 0, $num));
	}
	//echo implode (' ', get_words());	
	
	function get_words2($input, $num){ //db
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		
		$create_query = sprintf("CREATE OR REPLACE VIEW kimjongchan.temp2 
		AS (SELECT word FROM calvin.dictionary2
		WHERE word LIKE '%%%s%%' 
		ORDER BY (CASE WHEN rank IS NULL THEN 6000 ELSE rank END) 
		LIMIT %d);", $input, $num);
		$select_query = "SELECT * FROM kimjongchan.temp2 ORDER BY word";
		
		mysqli_multi_query($conn, $create_query.$select_query);
		mysqli_next_result($conn);	
		$result = mysqli_store_result($conn);
	
		$words = array();
		while ($row = mysqli_fetch_assoc ($result)){
			$words[] = $row['word'];
		}
		mysqli_close($conn);
		
		$auto_complete_word = json_encode($words);
		return $auto_complete_word;
	}
