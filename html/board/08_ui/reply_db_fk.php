<?php
	require_once '../../../includes/post.php';
	require_once '../../../includes/session.php';
	start_session();
		
			
			$reply_comment = $_POST['content'];
			$id = $_SESSION['id'];
			$post_id = $_POST['post_id'];
						
			
			$reply = new reply (0, get_user_id($id), $reply_comment, 0, $post_id);
			echo json_encode(reply_post($reply));
		
			
