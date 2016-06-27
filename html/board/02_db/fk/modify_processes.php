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
		$comment = $_POST['comment'];
		$view_number = $_POST['number'];
		if (($title && $comment) === false) {
				echo '<table>';
				echo '<tr>';
				echo '<td>빈칸이 없이 입력해주세요.</td>';
				echo '</tr>';				
				echo '</table>';
				echo '<form action = "modify.php" method = "get">';
				echo "<input type=\"hidden\" value=\"$view_number\" name=\"number\">";
				echo '<input class="submit_btn_pro" type="submit" value="수정하기로">';
				echo '</form>';
		} else {
				$insert_query = sprintf ("UPDATE post SET title='%s', comment='%s' WHERE post_id=%d", $title, $comment, $view_number);
				
				if (mysqli_query($conn, $insert_query) === false) {
					echo mysqli_error($conn);				
				} else {
					header("location: view_db_post_fk.php?number=$view_number");
				}
			}
	} 
	mysqli_close($conn);	
?>
</div>

</body>	

</html>
