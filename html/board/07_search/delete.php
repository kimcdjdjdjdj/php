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
	require_once '../../../includes/post.php';
	require_once '../../../includes/session.php';
	start_session();
	
	if (check_login()) {
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$check_name = $_SESSION['id'];
			$user_name = $_GET['user_name'];
			$post_id = $_SESSION['post_id'];
			if ($user_name == $check_name) {
				delete_post ($post_id);
				header("location: index_db_fk.php");				
			} else {
				header('Location: error.php?error_code=5');
			}
		}
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$reply_id = $_POST['reply_id'];
			$post_id = $_SESSION['post_id'];
			$id = $_SESSION['id'];
			delete_reply ($reply_id);
			header("location: view_db_post_fk.php?post_id=$post_id");
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