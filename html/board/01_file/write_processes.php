<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<style>
.wrap {margin:0 auto; width:20%; margin-top:350px;}
.btn {float:right; text-decoration:none; padding:5px 20px;
	margin-top:10px; background:#0099ff; color:#000;}
.bo {margin:0 auto; width:70%; background:#ADFF2F}
</style>



<body class="bo">
<div class="wrap">
	<?php		
		function get_number() {		
			$file_name2 = 'data.txt';	
			$file_handle2 = fopen ($file_name2, 'r');	
			
			$num = 0;
			$total_number = 0;
			
			while (($line = fgets($file_handle2)) !== false){	
				
				$lines = explode ("\t", $line);	
				//var_dump($lines);
				//echo '통과3';
				//echo $line;
				if (count ($lines) === 4) {
					//print_r ($lines);
					$num = $lines[0];
					//echo '통과';
					//echo $total_number;
					//echo $num;
					if ($total_number !== $num) {					
						$total_number = $num;
						//echo $total_number;
					} else {
						
					}
				} else{
					//die('못읽음');
					//echo 'dkdkdkd';
				}					
			}
			fclose($file_handle2);
			//echo $total_number = intval($total_number);
			//echo $total_number + 1;
			return intval($total_number + 1);
		}		// 여기까지 번호 함수
				
		//data에 쓰기
		$file_name = 'data.txt'; 	
		
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {			
			$num = get_number();
			//echo $num;
			$title = $_POST['title'];
			$writer = $_POST['writer'];
			$comment = $_POST['comment'];			
			$board = "".$num."\t".$title."\t".$writer."\t".$comment."\n";
			
			$file_handle = fopen($file_name, 'a');	
			if (!(fwrite ($file_handle, $board) === false)) {
				echo '<table>';
				echo '<tr>';
				echo '<td>글이 등록 되었습니다.</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><a class="btn"  href="index.php">목록으로</a></td>';	
				echo '</tr>';
				echo '</table>';
				
			}
			fclose($file_handle);	
		} 		
							
	?>
</div>
</body>	
</html>
