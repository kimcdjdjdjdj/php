<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<style type="text/css">

.wrap {margin:0 auto; width:50%; margin-top:50px;}
table {width:100%; border:1px solid #000000;
	border-collapse:collapse;margin-top:100px;}
th {background:#0099ff;}
.num {width:15%;}
td, th {border:1px solid #000000; padding:10px;
	text-align:center;}
#name {text-align:center;}
.bo {margin:0 auto; width:70%; background:#ADFF2F}
a:link {color:red;}
a:visited {color:red;}
a:hover {color:blue;}
</style>

<body class="bo">
<div class="wrap">

<h1 id="name">나의 게시판</h1>

	<?php		
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$view_number = $_GET['number'];
		}
			
		$file_name = 'data.txt';
		$file_handle = fopen ($file_name, 'r');
			
		while (($line = fgets ($file_handle)) !== false) {
			$lines = explode ("\t", $line);
			if (count($lines) === 4) {
				$number = $lines[0];
			}
			if ($view_number === $number) {
				//echo $view_number; 
				$title = $lines[1];
				$writer = $lines[2];
				$comment = $lines[3];
				$num = $lines[0];					
			}
		}
		fclose ($file_handle);	
		
		echo '<table>';
		echo '<tr>';
		echo '<th class="num">번호</th>';
		echo '<td>'.$num.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th>제목</th>';
		echo '<td>'.$title.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th>글쓴이</th>';
		echo '<td>'.$writer.'</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th>내용</th>';
		echo '<td>'.$comment.'</td>';
		echo '</tr>';
		echo '</table>';
		echo '<div style="margin:0 auto;width:0%;">';
		echo '<form action = "index.php" method = "get">';
		echo '<input style="margin-top:15px;background:#0099ff;color:#000;" type="submit" value="메인으로">';
		echo '</form>';
		echo '</div>';
		
	
	?>
	

	
</div>
</body>	





</html>