<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body class="bo">

<div class="wrap_write">

<table style="width:35%; border:1px solid #AFEEEE;
	border-collapse:collapse;">
<h1>성적입력</h1>
	
	<form action="test_work.php" method="post">
	<tr>
	<th>이름</th><td ><input type="text" name="student"></td>
	</tr>
	<tr>
	<th>과목</th><td><input type="text" name="subject"></td>
	</tr>
	<tr>
	<th>성적</th><td><input type="text" name="score"></td>
	</tr>
	</table>	
	<input class="test_btn" type="submit" value="제출">
	</form>

</div>
</body>
</html>