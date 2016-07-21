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
		$title = $_POST['title'];
		$user_name = $_POST['user_name'];
		$comment = $_POST['comment'];
		$board_id = $_POST['board'];
				
		if (($title && $comment) === false) {
			echo '<table>';
			echo '<tr>';
			echo '<td>빈칸이 없이 입력해주세요.</td>';
			echo '</tr>';				
			echo '</table>';
			echo '<form action = "write_db_post_fk.php" method = "get">';
			echo "<input type=\"hidden\" value=\"$board_id\" name=\"board\">";
			echo "<input type=\"hidden\" value=\"$user_name\" name=\"user_name\">";
			echo '<input class="submit_btn_pro" type="submit" value="글쓰기로">';
			echo '</form>';
		} else {
			$post = new post (0, $title, get_user_id($user_name), $comment, 0, $board_id);			
			insert_post($post);				
			header("location: index_db_fk.php?id=$board_id&name=$user_name");
		}
	}	
	
?>
</div>

</body>	

</html>
