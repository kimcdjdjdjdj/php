<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body class="bo">
<?php
	require_once '../../../includes/session.php';
	start_session();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$board = $_GET['board'];
		if (isset ($_GET['user_name'])) {
			$user_name = $_GET['user_name'];
		}
	}
	if (check_login()) {
?>
<div class="wrap_write">

<table class="table_write">
<h1>나의 게시판</h1>
<?php	
	echo '<form action = "write_processes_db_fk.php" method = "post">';
	echo '<tr>';
	echo '<th class="th_write">제목</th>';
	echo '<td class="td_wirte"><input class="text" type="text" name="title"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th class="th_write">글쓴이</th>';
	echo '<td class="td_wirte">'.$user_name.'</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th class="th_write">내용</th>';
	echo '<td class="td_wirte"><textarea class="text" type="text" name="comment" rows="10" cols="100%"></textarea></td>';
	echo '</tr>';
	echo '</table>';
	echo "<input type=\"hidden\" value=\"$user_name\" name=\"user_name\">";
	echo "<input type=\"hidden\" value=\"$board\" name=\"board\">";
	echo '<input class="submit_btn" type="submit" value="제출">';	
	echo '</form>';
	echo '<form action="index_db_fk.php" method="get">';
	echo "<input type=\"hidden\" value=\"$user_name\" name=\"name\">";
	echo "<input type=\"hidden\" value=\"$board\" name=\"id\">";
	echo '<input style="float:right; margin-top:15px; margin-right:20px; background:#AFEEEE; color:#000;" type="submit" value="목록">';
	echo '</form>';
	echo '</div>';
	} else {
?>	
	<div class="wrap_write">
	<h1>로그인을 하십시오.</h1>
	<form action="login.php" method="POST">
	<table class="table_write">
	<tr>
	<td>ID</td><td><input type="text" name="name"></td>
	</tr>
	<tr>
	<td>PASSWORD</td><td><input type="text" name="password"></td>
	</tr>
	</table>
<?php	
	echo "<input type=\"hidden\" value=\"$board\" name=\"board\">";
?>	
	<input class="submit_btn" type="submit" value="로그인">
	</form>
	<form action="register_page.php" method="GET">
<?php	
	echo "<input type=\"hidden\" value=\"$board\" name=\"board\">";
?>	
	<input style="float:right; margin-top:15px; margin-right:20px; background:#AFEEEE; color:#000;" type="submit" value="회원가입">
	</form>	
	</div>
<?php
	}
?>	
	
</body>	
</html>