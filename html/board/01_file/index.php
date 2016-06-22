<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style type="text/css">

.wrap {margin:0 auto; width:50%; margin-top:50px;}
table {width:100%; border:1px solid #000000; 
	border-collapse:collapse;margin-top:50px;}
th {background:#0099ff;}
.num {width:10%}
td, th {border:1px solid #000000; padding:10px;
	text-align:center;}
.w_btn {float:right; text-decoration:none; padding:5px 20px;
	margin-top:10px; background:#0099ff; color:#000;}
.bo {margin:0 auto; width:70%;}
#name {text-align:center;}
a {text-decoration:none;}
a:link {color:red;}
a:visited {color:red;}
a:hover {color:blue;}

</style>

<body class="bo">

<div class="wrap">

<h1 id="name">나의 게시판</h1>

<table>
<tr>
<th class="num">번호</th><th>제목</th><th>글쓴이</th>
</tr>
	<?php		
		$file_name ='data.txt';			
		$file_handle = fopen($file_name, 'r');
		
		while (($line = fgets($file_handle)) !== false) {			
			$lines = explode ("\t", $line);					
			if (count ($lines) === 4) {
				$num = $lines[0];
				$title = $lines[1];
				$writer = $lines[2];
				echo "<tr>";
				echo "<td>".$num."</td>";
				echo "<td> <a href=\"view_post.php?number=$num\"> $title</a> </td>";
				echo "<td>".$writer."</td>";
				echo "</tr>";	
				
			}
			
		}			
		fclose ($file_handle);
	?> 
</table>

<a class="w_btn" href="write_db_post">글쓰기</a>

</div>

</body>

</html>