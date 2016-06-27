<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$view_number = $_GET['number'];
		}
	
	require_once '../../../includes/mylib.php';
	$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
	
		
	$conndel = sprintf("DELETE FROM post WHERE post_id =%d;", $view_number);
	$delete = mysqli_query ($conn, $conndel);
	header('location: index_db_fk.php');
	
	if ($delete === false) {
		echo mysqli_error($conn);
	}

	mysqli_close($conn);
?>