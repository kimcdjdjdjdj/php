<?php
	require_once '../../../includes/post.php';
	require_once '../../../includes/session.php';
	
	start_session();
	if (!check_login()) {
		die('부정한 접근!');
	}
	if (!isset($_SESSION['id'])) {
		die('세션에 id가 설정되어 잇지 안음');
	}
	if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
		die('post가 아님');
	}
	
	$reply_id = $_POST['reply_id'];
	delete_reply($reply_id);
