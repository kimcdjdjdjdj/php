<?php
	require_once '../../../includes/post.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$id = $_GET['number'];		
		delete_post ($id);	
		header('location: index_db_fk.php');
	}	
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$reply_id = $_POST['reply_id'];
		$post_id = $_POST['number'];
		delete_reply ($reply_id);
		header("location: view_db_post_fk.php?number=$post_id");
	}
?>