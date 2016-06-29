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
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {			
		$reply_comment = $_POST['reply'];		
		$reply_id = $_POST['reply_id'];
		$post_id = $_POST['post_id'];
		if ($reply_comment == false) {
			echo '<table>';
			echo '<tr>';
			echo '<td>빈칸이 없이 입력해주세요.</td>';
			echo '</tr>';				
			echo '</table>';
			echo '<form action = "view_db_post_fk.php" method = "POST">';
			echo '<input type="hidden" value="'.$reply_id.'" name="reply_id">';
			echo '<input type="hidden" value="'.$post_id.'" name="number">';
			echo '<input class="submit_btn_pro" type="submit" value="댓글 수정">';
			echo '</form>';
		} else {
			modify_reply($reply_id, $reply_comment);
		
			header("location: view_db_post_fk.php?number=$post_id");
		}
	}	
?>
</div>
</body>
</html>