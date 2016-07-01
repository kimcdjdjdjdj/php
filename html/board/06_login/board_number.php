<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
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

<body class="bo">


<?php
	require_once '../../../includes/session.php';
	start_session();
	if (check_login()){
		if(isset ($_GET['id'])){
			$id = $_GET['id'];
			echo '<div class="login">';
			echo '<table>';			
			echo '<tr><td>'.$id.' 님 환영합니다.</td>';
			echo '<td><form action="logout.php" method="get">
			     <input type="submit" value="로그아웃"></td>
			     </form></td>';
			echo '</tr>';
			echo '</table>';	
			echo '</div>';
		}
	} else {
?>
	<div class="login">
	<form action="login.php" method="POST">
	<table>
	<tr><td>ID : </td><td><input type="text" name="id"></td>
	<td>PASSWORD : </td><td><input type="text" name="password"></td>
	<td><input type="submit" value="로그인"></td>
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

<td><a href="index_db_fk.php?id=1">게시판1</a></td>
</tr>
<tr>
<td><a href="index_db_fk.php?id=2">게시판2</a></td>
</tr>

</table>
</div>




</body>
</html>