<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>


<body class="bo">

<div class="wrap_write">


<h1>가입할 회원 정보를 입력하시오</h1>
<form action="register.php" method="post">
	<table class="table_write">
		<tr><td>ID:</td><td><input type="text" name="name"></td></tr>
		<tr><td>비번:</td><td><input type="text" name="password"></td></tr>
	</table>
<?php
	if (isset ($_GET['board'])){
		$board_id = $_GET['board'];
		echo "<input type=\"hidden\" value=\"$board_id\" name=\"board\">";
	}	
	if (isset($_GET['post_id'])){
		$post_id = $_GET['post_id'];
		echo "<input type=\"hidden\" value=\"$post_id\" name=\"post_id\">";
	}	
?>	
	<input class="submit_btn" type="submit" value="가입하기">
</form>
</div>
</body>
</html>