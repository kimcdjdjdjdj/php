<?php
	require_once '../../../includes/post.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {			
		$reply = $_POST['reply'];
		$re_writer = $_POST['re_writer'];
		$post_id = $_POST['post_id'];
	}	
	$reply = new reply (0, $re_writer, $reply, 0, $post_id);
	reply_post($reply);
	
	header("location: view_db_post_fk.php?number=$post_id");
	
	
?>