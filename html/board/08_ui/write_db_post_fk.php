<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
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
	
	if (isset($_SESSION['id'])){
		$user_name = $_SESSION['id'];
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
	echo '<td class="td_wirte"><input class="text" type="text" name="title" autocomplete="off"></td>';
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
	echo '<input class="submit_btn" type="submit" value="제출">';	
	echo '</form>';
	echo '<form action="index_db_fk.php" method="get">';	
	echo '<input class="write_submit" type="submit" value="목록">';
	echo '</form>';
	echo '</div>';
	} else {
?>	
	<div class="wrap_write">
	<h1>로그인을 하십시오.</h1>
	<form action="login.php" method="POST">
	<table class="table_write">
	<tr>
	<td>ID</td><td><input type="text" name="name" autocomplete="off"></td>
	</tr>
	<tr>
	<td>PASSWORD</td><td><input type="password" name="password"></td>
	</tr>
	</table>
<?php	
	//echo "<input type=\"hidden\" value=\"$board\" name=\"board\">";
?>	
	<button class="submit_btn" onclick="tryLogin(this.form, this.form.password);">로그인</button>
	</form>
	<form action="register_page.php" method="GET">
<?php	
	//echo "<input type=\"hidden\" value=\"$board\" name=\"board\">";
?>	
	<input class="write_submit" type="submit" value="회원가입">
	</form>	
	</div>
<?php
	}
?>	
	
</body>	
</html>