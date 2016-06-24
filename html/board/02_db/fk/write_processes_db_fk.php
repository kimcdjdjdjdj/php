<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>


<body class="bo">

<div class="wrap_pro">
	<?php			
		require_once '../../../../includes/mylib.php';
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {			
			$title = $_POST['title'];
			$writer = $_POST['writer'];
			$comment = $_POST['comment'];
			$board_id = $_POST['board'];
			if (($title && $writer && $comment) === false) {
				echo '<table>';
				echo '<tr>';
				echo '<td>빈칸이 없이 입력해주세요.</td>';
				echo '</tr>';				
				echo '</table>';
				echo '<form action = "write_db_post_fk.php" method = "get">';
				echo "<input type=\"hidden\" value=\"$board_id\" name=\"board\">";
				echo '<input class="submit_btn_pro" type="submit" value="글쓰기로">';
				echo '</form>';
			} else {
				$insert_query = sprintf ("INSERT INTO post (title, writer, comment, board_id) VALUES ('%s', '%s', '%s', %d)", $title, $writer, $comment, $board_id);
				echo $insert_query;
				if (mysqli_query($conn, $insert_query) === false) {
					echo mysqli_error($conn);				
				} else {
					header('location: index_db_fk.php');
				}
			}
		}	 
		mysqli_close($conn);								
	?>
</div>

</body>	

</html>
