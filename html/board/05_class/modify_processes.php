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
		$comment = $_POST['comment'];
		$id = $_POST['number'];
		if (($title && $comment) === false) {
			echo '<table>';
			echo '<tr>';
			echo '<td>빈칸이 없이 입력해주세요.</td>';
			echo '</tr>';				
			echo '</table>';
			echo '<form action = "modify.php" method = "get">';
			echo "<input type=\"hidden\" value=\"$id\" name=\"number\">";
			echo '<input class="submit_btn_pro" type="submit" value="수정하기로">';
			echo '</form>';
		}		
		modify_post($id, $title, $comment);		
		
		header("location: view_db_post_fk.php?number=$id");
	}
?>
</div>

</body>	

</html>
