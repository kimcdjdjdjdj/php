<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style type="text/css">

.wrap {margin:0 auto; width:20%; margin-top:350px;}
.btn {float:right; text-decoration:none; padding:5px 20px;
	margin-top:10px; background:#AFEEEE; color:#000;}
.bo {margin:0 auto; width:70%;}
.submit_btn {float:right; margin-top:15px; margin-right:150px; background:#AFEEEE;
	color:#000;}
	
</style>


<body class="bo">

<div class="wrap">
	<?php			
		$hostname = 'kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
		$username = 'kimjongchan';
		$password = 'password';
		$dbname = 'kimjongchan';
		$conn = mysqli_connect($hostname,$username, $password, $dbname);				
		mysqli_query($conn, "SET NAMES 'utf8'");
		
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
				echo '<input class="submit_btn" type="submit" value="제출">';
				echo '</form>';
			} else {
				$insert_query = sprintf ("INSERT INTO post (title, writer, comment, board_id) VALUES ('%s', '%s', '%s', %d)", $title, $writer, $comment, $board_id);
				echo $insert_query;
				if (mysqli_query($conn, $insert_query) === false) {
					echo mysqli_error($conn);				
				} else {
					header('location: index_db.php');
				}
			}
		}	 
		mysqli_close($conn);								
	?>
</div>

</body>	

</html>
