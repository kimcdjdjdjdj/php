<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<h1>문자열의 합</h1>

<?php
    // 초기 문자열 -> 1
    function get_value($char){
    
        $get_number = ord($char) - ord('a') + 1;
    
    return $get_number;
    }
 	
?>

<?php
    // 문자열의 합
    function get_value_sum($cha){
    	
		$sum = 0;
		
		while($cha !== false){  
			
			$get_number = get_value($cha);
			$sum += $get_number;
			$cha = substr($cha, 1);
			
		}
		    
		return $sum;
		
    }
	   
?>

<?php
	// 문자열의 합과 같은 단어들
	$file_name ='dictionary.txt';
			
	$file_handle = fopen($file_name, 'r'); 
	
	$words = array(); // 문자열과 같은 단어들의 어레이
	
	$index = 0;	// 어레이의 시작 지점
		
		while (true){ 
			
			$line = fgets($file_handle);
			
			if ($line === false){
				
				break;
			
			}
					
		$wordAndRank = explode ("\t", $line);
			
			if(count($wordAndRank) === 2){
				
				$word = $wordAndRank[0]; // 단어와 랭크를 분리해 단어만 word 어레이에
								
			} else {
				
				die('count was'.count($wordAndRank).' Error occured!');
			
			}			
						
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
				$num = get_value_sum($word); // num = 단어들의 합
				
				$number = $_POST['word']; // 입력된 단어를 number에
				
				$numbers = get_value_sum($number); // numbers = 입력된 단어의 합
				
				if ($num === $numbers){ // 입력된 단어와 저장되있는 단어의 합이 같다면
					
					$words[$index] = $word; 
					// 입력된 단어와 저장되있는 단어의 합이 같은 단어들을 words 어레이에
					
					$value = $num; // 입력된 단어와 저장되있는 단어가 같다면 그 합을 value에
					
					$index += 1;
						
				
				} 
			}
		
		}
		
	fclose ($file_handle);	
	
	natsort ($words); // 알파벳순 정렬
	
	$token = ', '; 
	
	echo $number.'의 값은 '.$numbers.'이고<br><br>';
	
	echo implode ($token, $words); // 토큰 추가
	
	echo '<br><br>의 값은 '.$value.' 으로 총 '.count($words).'개의 단어가 같습니다.<br><br>';	
	
?>

</html>