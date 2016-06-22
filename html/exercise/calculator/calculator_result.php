<html>

<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			
			$number = $_POST['num'];
			
			$Numbers = explode('+', $number);
			
							
			function sum ($Numbers){//어레이 -> 함수 -> 정수(총합)
				
				$sum = 0;
				
				foreach($Numbers as $key => $value){
				
					$int_value = intval($value);
				
					$sum += $int_value;		
				
				}				
				
			return $sum;
			}	
			
			
		} 
		
		
		echo '결과는 '.sum($Numbers).' 입니다.';
		
			
	
	
	?>









<html>