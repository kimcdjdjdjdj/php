<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<script language="javascript" src="js/check_form.js"></script>
	<script language="javascript" src="js/sha512.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>


<body class="bo">

<div class="wrap_write">


<h1>가입할 회원 정보를 입력하시오</h1>
<form action="register.php" method="post">
	<table class="table_write">
		<tr><td>ID</td><td><input type="text" name="name" autocomplete="off"><span>  아이디는 3자리 이상이여야 합니다.</span></td></tr>
		<tr><td>비밀번호</td><td><input type="password" name="password"></td></tr>
	</table>
<?php	
	if(isset($_GET['post'])){
		$post = $_GET['post'];
		echo "<input type=\"hidden\" value=\"post\" name=\"post\">";
	}	
?>
	
	<button type="button" class="submit_btn" onclick="checkRegisterForm(this.form, this.form.name, this.form.password)">가입하기</button>
</form>
</div>
</body>
</html>