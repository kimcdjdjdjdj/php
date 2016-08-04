<?php
	require_once '../../../includes/post.php';
	require_once '../../../includes/session.php';
	start_session();
	
			
	$reply_comment = $_POST['reply'];		
	$reply_id = $_POST['reply_id'];
	
		
	modify_reply($reply_id, $reply_comment);
		
	
