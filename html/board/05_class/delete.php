<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$id = $_GET['number'];
	}
	
	require_once '../../../includes/post.php';
	delete_post($id);
	
	header('location: index_db_fk.php');
?>