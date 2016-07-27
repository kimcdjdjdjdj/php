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
		$reply_id = $_POST['reply_id'];
		$post_id = $_SESSION['post_id'];		
		
		modify_reply($reply_id, $reply_comment);
		
		header("location: view_db_post_fk.php?post_id=$post_id");
		
	}	
?>
</div>
</body>
</html>