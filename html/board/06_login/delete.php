<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body class="bo">
<?php
	require_once '../../../includes/post.php';
	require_once '../../../includes/session.php';
	start_session();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$id = $_GET['number'];
	}
	if (check_login()) {
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$board_id = $_GET['id'];
			$check_name = $_GET['name'];
			$user_name = $_GET['user_name'];
			if ($user_name == $check_name) {
				delete_post ($id);
				header("location: index_db_fk.php?id=$board_id&name=$check_name");				
			} else {
				header('Location: error.php?error_code=1');
			}
		}	
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$reply_id = $_POST['reply_id'];
			$post_id = $_POST['number'];
			delete_reply ($reply_id);
			header("location: view_db_post_fk.php?number=$post_id");
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
<?php	
		echo "<input type=\"hidden\" value=\"$id\" name=\"post_id\">";
?>	
		<input class="submit_btn" type="submit" value="로그인">
		</form>
<?php
	}
?>