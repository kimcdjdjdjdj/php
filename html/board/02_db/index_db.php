<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style type="text/css">

.wrap {margin:0 auto; width:60%; margin-top:50px;}
table {width:100%; border:1px solid #000000; 
	border-collapse:collapse;margin-top:50px;}
th {background:#AFEEEE;}
td {background:#E0FFFF;}
.num {width:10%;}
.date {width:20%;}
.writer {width:15%;}
td, th {border:1px solid #000000; padding:10px;
	text-align:center;}
.w_btn {float:right; text-decoration:none; padding:5px 20px;
	margin-top:10px; background:#AFEEEE; color:#000;}
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
<th class="num">글번호</th><th>제목</th><th class="writer">글쓴이</th><th class="date">수정일</th>
</tr>
	<?php		
		$hostname = 'kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
		$username = 'kimjongchan';
		$password = 'password';
		$dbname = 'kimjongchan';
		$conn = mysqli_connect($hostname,$username, $password, $dbname);
		mysqli_query($conn, "SET NAMES 'utf8'");
		if (!$conn) {
		die('Mysql connection failed: '.mysqli_connect_error());
		} 	
		
		$select_query = 'SELECT post_id, title, writer, last_update FROM kimjongchan.post;'; 
		$result = mysqli_query ($conn, $select_query);
		
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>".$row['post_id']."</td>";
			printf ("<td><a href=\"view_db_post.php?number=%d\">%s</a></td>", $row['post_id'], $row['title']);
			echo "<td>".$row['writer']."</td>";
			echo "<td>".$row['last_update']."</td>";
			echo "</tr>";
		}			
	?> 
</table>

<form action="write_db_post.php" method="get">
	<input style="float:right; margin-top:15px; background:#AFEEEE;
	color:#000;" type="submit" value="글쓰기">
</form>

</div>

</body>

</html>