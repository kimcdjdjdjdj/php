<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body class="bo">
<div class="wrap_write">
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$view_number = $_GET['number'];
		}
	
	require_once '../../../../includes/mylib.php';
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
	
	$select_query = 'SELECT post_id, title, writer, comment, last_update FROM kimjongchan.post'; 
	$result = mysqli_query ($conn, $select_query);
	
	while ($row = mysqli_fetch_assoc($result)) {
			if ($view_number === $row['post_id']) {
				$title = $row['title'];
				$writer = $row['writer'];
				$comment = $row['comment'];
				
				echo '<table class="table_write">';
				echo '<form action = "modify_processes.php" method = "post">';
				echo '<tr>';
				echo '<th class="th_write">제목</th>';
				echo "<td class=\"td_wirte\"><input class=\"text\" type=\"text\" name=\"title\" value=\"$title\"></td>";
				echo '</tr>';
				echo '<tr>';
				echo '<th class="th_write">글쓴이</th>';
				echo '<td class="td_wirte">'.$writer.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<th class="th_write">내용</th>';
				echo '<td class="td_wirte"><textarea class="text" type="text" name="comment" rows="10" cols="100%">'.$comment.'</textarea></td>';
				echo '</tr>';
				echo '</table>';
				echo "<input type=\"hidden\" value=\"$view_number\" name=\"number\">";
				echo '<input class="submit_btn" type="submit" value="수정">';	
				echo '</form>';
				echo '<form action = "view_db_post_fk.php" method = "get">';
				echo "<input type=\"hidden\" value=\"$view_number\" name=\"number\">";
				echo '<input style="float:right; margin-top:15px; margin-bottom:15px; margin-right:15px; background:#AFEEEE;color:#000;" type="submit" value="게시물로">';
				echo '</form>';	
			}
	}	





?>
</div>
</body>
</html>