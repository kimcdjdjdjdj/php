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
			$reply_comment = $_POST['reply'];
			$user_name = $_POST['name'];
			$post_id = $_POST['post_id'];
						
			if (($reply_comment) == false) {
				echo '<table>';
				echo '<tr>';
				echo '<td>빈칸이 없이 입력해주세요.</td>';
				echo '</tr>';				
				echo '</table>';
				echo '<form action = "view_db_post_fk.php" method = "GET">';			
				echo '<input type="hidden" value="'.$user_name.'" name="user_nam">';
				echo '<input type="hidden" value="'.$post_id.'" name="number">';
				echo '<input class="submit_btn_pro" type="submit" value="게시글로">';
				echo '</form>';
				echo '</div>';
			} else {				
				$reply = new reply (0, get_user_id($user_name), $reply_comment, 0, $post_id);
				reply_post($reply);
		
				header("location: view_db_post_fk.php?number=$post_id&user_name=$user_name");
			}
		}	
?>	


</body>	

</html>