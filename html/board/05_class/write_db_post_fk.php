<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body class="bo">

<div class="wrap_write">

<table class="table_write">
<h1>나의 게시판</h1>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$board = $_GET['board'];
	}
	
	echo '<form action = "write_processes_db_fk.php" method = "post">';
	echo '<tr>';
	echo '<th class="th_write">제목</th>';
	echo '<td class="td_wirte"><input class="text" type="text" name="title"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th class="th_write">글쓴이</th>';
	echo '<td class="td_wirte"><input class="text" type="text" name="writer"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th class="th_write">내용</th>';
	echo '<td class="td_wirte"><textarea class="text" type="text" name="comment" rows="10" cols="100%"></textarea></td>';
	echo '</tr>';
	echo '</table>';
	echo "<input type=\"hidden\" value=\"$board\" name=\"board\">";
	echo '<input class="submit_btn" type="submit" value="제출">';	
	echo '</form>';
	echo '<form action="index_db_fk.php" method="get">';
	echo "<input type=\"hidden\" value=\"$board\" name=\"id\">";
	echo '<input style="float:right; margin-top:15px; margin-right:20px; background:#AFEEEE; color:#000;" type="submit" value="목록">';
	echo '</form>';
?>	
	
</div>	
</body>	
</html>