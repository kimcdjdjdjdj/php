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
		} else {
			$reply = new reply (0, $re_writer, $reply_comment, 0, $post_id);
			reply_post($reply);
	
			header("location: view_db_post_fk.php?number=$post_id");
		}
	}	
	echo get_paging(1);
	
?>
</div>

</body>	

</html>