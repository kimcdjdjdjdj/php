<?php
	$file_name = 'dictionary.txt';
	
	$file_handle = fopen ($file_name, 'r');
	
	while (true){ 
			
			$line = fgets($file_handle);
			
			if ($line === false){
				
				break;
			
			}

		$wordAndrank = explode ("\t", $line);
		
			if (count($wordAndrank) === 2){
				
				$word = $wordAndrank[0];
				
				$rank = intval($wordAndrank[1]);
				
				$arr[$word] = $rank;
				
			}
				
	}
	fclose ($file_handle); 
	
	ksort ($arr);
	
	$file_name2 = 'result.txt';
	
	$file_handle2 = fopen($file_name2, 'a');
	
	foreach($arr as $key => $value){
		
		$line = $key."\t".$value."\n";
		
		fwrite ($file_handle2, $line);
		
	}
		
	fclose($file_handle2);

?>