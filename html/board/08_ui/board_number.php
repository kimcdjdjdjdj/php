<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
<style type="text/css">

.wrap {margin:0 auto; width:70%; margin-top:50px;}
.login {margin:0 auto; width:70%; margin-bottom:50px;}
.list {float:right; margin-right:130px;}
.ex {float:left;}
table {width:100%; border:1px solid #FFFFFF;
	border-collapse:collapse;margin-top:50px;}
td, th {border-bottom:1px solid #000; padding:20px;
	text-align:center;}
.bo {margin:0 auto; width:70%;}
a {text-decoration:none;}
a:link {color:red;}
a:visited {color:red;}
a:hover {color:blue;}

</style>
<script language="javascript" src="js/sha512.js"></script>
<script>
function tryLogin(form, password) {
    var hash = document.createElement('input');
    form.appendChild(hash);
    hash.name = 'hash';
	hash.type = 'hidden';
	hash.value = hex_sha512(password.value);
    password.value = '';
	form.submit();
	return true;
}
</script>
</head>
<body class="bo">


<?php
	require_once '../../../includes/session.php';
	start_session();
	
	if (check_login()){		
?>			
		<div class="login">
		<table>
<?php			
		echo '<tr><td>'.$_SESSION['id'].'님 로그인 되었습니다.</td>';
?>			
		<td><form action="logout.php" method="get">
		<input type="submit" value="로그아웃"></td>
	    </form></td>
		</tr>
		</table>
		</div>
<?php		
	} else {
?>
	<div class="login">
	<form action="login.php" method="POST">
	<table>
	<tr><td>ID : </td><td><input type="text" name="name" autocomplete="off"></td>
	<td>PASSWORD : </td><td><input type="password" name="password"></td>
	<td><button onclick="tryLogin(this.form, this.form.password);">로그인</button></td>
	</form>
	<form action="register_page.php" method="GET">
	 <td><input type="submit" value="회원가입"></td>
	</form>
	</tr>
	</table>
	</div>
<?php
	}
?>	
<div class="wrap">
<h1>게시판</h1>
<table>
<tr>
<th>종류</th><th>이름</th>
</tr>
<tr>
<td rowspan="2">게시판</td>

<td><a href="index_db_fk.php?board_id=1">게시판1</a></td>
</tr>
<tr>
<td><a href="index_db_fk.php?board_id=2">게시판2</a></td>
</tr>

</table>
</div>




</body>
</html>