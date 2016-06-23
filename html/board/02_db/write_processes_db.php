<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style type="text/css">

.wrap {margin:0 auto; width:20%; margin-top:350px;}
.btn {float:right; text-decoration:none; padding:5px 20px;
	margin-top:10px; background:#AFEEEE; color:#000;}
.bo {margin:0 auto; width:70%;}
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
			if (($title && $writer && $comment) === false) {
				echo '<table>';
				echo '<tr>';
				echo '<td>빈칸이 없이 입력해주세요.</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td><a class="btn"  href="write_db_post.php">글쓰기로</a></td>';	
				echo '</tr>';
				echo '</table>';				
			} else {
				$insert_query = sprintf ("INSERT INTO post (title, writer, comment) VALUES ('%s', '%s', '%s')", $title, $writer, $comment);
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
