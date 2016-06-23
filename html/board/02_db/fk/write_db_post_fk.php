<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<style type="text/css">

.wrap {margin:0 auto; width:60%; margin-top:50px;}
table {width:100%; border:1px solid #AFEEEE;
	border-collapse:collapse;}
th {background:#AFEEEE; width:20%;}
td {background:#E0FFFF;}
td, th {border:1px solid #000000; padding:10px;}
.text {border:1px solid #000000;}

.submit_btn {float:right; margin-top:15px; background:#AFEEEE;
	color:#000;}
.bo {margin:0 auto; width:70%;}

</style>

<body class="bo">

<div class="wrap">

<table>
<h1>나의 게시판</h1>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$board = $_GET['board'];
	}
	
	echo '<form action = "write_processes_db_fk.php" method = "post">';
	echo '<tr>';
	echo '<th>제목</th>';
	echo '<td><input class="text" type="text" name="title"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>글쓴이</th>';
	echo '<td><input class="text" type="text" name="writer"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>내용</th>';
	echo '<td><textarea class="text" type="text" name="comment" rows="10" cols="100%"></textarea></td>';
	echo '</tr>';
	echo '</table>';
	echo "<input type=\"hidden\" value=\"$board\" name=\"board\">";
	echo '<input class="submit_btn" type="submit" value="제출">';	
	echo '</form>';
?>	
	<form action="index_db.php" method="get">
		<input style="float:right; margin-top:15px; margin-right:20px; background:#AFEEEE;
	color:#000;" type="submit" value="목록">
	</form>
</div>	
</body>	
</html>