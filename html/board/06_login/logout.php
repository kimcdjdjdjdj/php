<?php

	require_once '../../../includes/session.php';
	
	start_session();
	try_to_logout();
	destroy_session();

	if (isset($_GET['board'])) {
		$board_id = $_GET['board'];
		header("Location: index_db_fk.php?id=$board_id");
	} else {
		if (isset ($_GET['post_id'])) {
		$post_id = 	$_GET['post_id'];
		header("location: view_db_post_fk.php?number=$post_id");
		} else {
			header('Location: board_number.php');
		}	
	} 
?>