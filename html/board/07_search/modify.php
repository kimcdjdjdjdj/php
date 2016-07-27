<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<script language="javascript" src="sha512.js"></script>
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
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$post_id = $_SESSION['post_id'];						
	}
	if (check_login()) {
?>
		<div class="wrap_write">
<?php		
		require_once '../../../includes/post.php';
		$post = get_post_from_id($post_id);	
		$title = $post->getTitle();
		$user_name = get_user_name ($post->getUserId());
		$comment = $post->getComment();	
		
		if ($user_name == $_SESSION['id']) {
			echo '<h1 id="name">나의 게시판</h1>';
			echo '<table class="table_write">';
			echo '<form action = "modify_processes.php" method = "post">';
			echo '<tr>';
			echo '<th class="th_write">제목</th>';
			echo "<td class=\"td_wirte\"><input class=\"text\" type=\"text\" name=\"title\" value=\"$title\" autocomplete=\"off\"></td>";
			echo '</tr>';
			echo '<tr>';
			echo '<th class="th_write">글쓴이</th>';
			echo '<td class="td_wirte">'.$user_name.'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<th class="th_write">내용</th>';
			echo '<td class="td_wirte"><textarea class="text" type="text" name="comment" rows="10" cols="100%">'.$comment.'</textarea></td>';
			echo '</tr>';
			echo '</table>';			
			echo '<input class="submit_btn" type="submit" value="수정">';	
			echo '</form>';
			echo '<form action = "view_db_post_fk.php" method = "get">';			
			echo "<input type=\"hidden\" value=\"$post_id\" name=\"post_id\">";
			echo '<input class="modify_post" type="submit" value="게시물로">';
			echo '</form>';	
			echo '</div>';
		} else {
			header('Location: error.php?error_code=5');
		}
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

		<button onclick="tryLogin(this.form, this.form.password);">로그인</button>
		</form>		
<?php
	}
?>	
</body>
</html>