<?php
	require_once '../../../../includes/mylib.php';
	$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {			
		$reply = $_POST['reply'];
		$re_writer = $_POST['re_writer'];
		$post_id = $_POST['post_id'];
	}	
	$insert_query = sprintf ("INSERT INTO reply (reply_writer, reply_comment, post_id) VALUES ('%s', '%s', %d)", $re_writer, $reply, $post_id);	
	
	if (mysqli_query($conn, $insert_query) === false) {
		echo mysqli_error($conn);				
		} else {
			header("location: view_db_post_fk.php?number=$post_id");
		}
	mysqli_close($conn);	
?>