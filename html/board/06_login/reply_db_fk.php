<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body class="bo">

<div class="wrap_pro">
<?php
	require_once '../../../includes/post.php';
	require_once '../../../includes/session.php';
	start_session();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$post_id = $_POST['post_id'];
	}
	if (check_login()) {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {			
			$reply_comment = $_POST['reply'];
			$re_writer = $_POST['re_writer'];
			$post_id = $_POST['post_id'];
			if (($reply_comment && $re_writer) === false) {
				echo '<table>';
				echo '<tr>';
				echo '<td>빈칸이 없이 입력해주세요.</td>';
				echo '</tr>';				
				echo '</table>';
				echo '<form action = "view_db_post_fk.php" method = "GET">';			
				echo '<input type="hidden" value="'.$post_id.'" name="number">';
				echo '<input class="submit_btn_pro" type="submit" value="게시글로">';
				echo '</form>';
				echo '</div>';
			} else {			
				$reply = new reply (0, $re_writer, $reply_comment, 0, $post_id);
				reply_post($reply);
		
				header("location: view_db_post_fk.php?number=$post_id");
			}
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
	echo "<input type=\"hidden\" value=\"$post_id\" name=\"post_id\">";
?>	
	<input class="submit_btn" type="submit" value="로그인">
	</form>
	<form action="register_page.php" method="GET">
<?php	
	echo "<input type=\"hidden\" value=\"$post_id\" name=\"post_id\">";
?>	
	<input style="float:right; margin-top:15px; margin-right:20px; background:#AFEEEE; color:#000;" type="submit" value="회원가입">
	</form>	
	</div>
<?php
	}
?>	

</body>	

</html>