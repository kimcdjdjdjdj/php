<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style type="text/css">

.wrap {margin:0 auto; width:50%; margin-top:50px;}
table {width:100%; border:1px solid #000000;
	border-collapse:collapse;margin-top:100px;}
th {background:#AFEEEE;}
td {background:#E0FFFF;}
.num {width:15%;}
.date {width:20%;}
.writer {width:15%;}
td, th {border:1px solid #000000; padding:10px;
	text-align:center;}
#name {text-align:center;}
.bo {margin:0 auto; width:70%;}
a:link {color:red;}
a:visited {color:red;}
a:hover {color:blue;}
</style>

<body class="bo">

<div class="wrap">

<h1 id="name">나의 게시판</h1>
	<?php		
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$view_number = $_GET['number'];
		}
			
		$hostname = 'kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
		$username = 'kimjongchan';
		$password = 'password';
		$dbname = 'kimjongchan';
		$conn = mysqli_connect($hostname,$username, $password, $dbname);
		mysqli_query($conn, "SET NAMES 'utf8'");
		if (!$conn) {
		die('Mysql connection failed: '.mysqli_connect_error());
		} 	
		
		$select_query = 'SELECT post_id, title, writer, comment, last_update FROM kimjongchan.post;'; 
		$result = mysqli_query ($conn, $select_query);
		
		while ($row = mysqli_fetch_assoc($result)) {
			if ($view_number === $row['post_id']) {
				$num = $row['post_id'];
				$title = $row['title'];
				$writer = $row['writer'];
				$comment = $row['comment'];
				$last_update = $row['last_update'];
				
				echo '<table>';
				echo '<tr>';
				echo '<th class="num">글번호</th><th>제목</th><th>글쓴이</th><th>수정일</th>';
				echo '</tr>';
				echo '<tr>';
				echo '<td>'.$num.'</td><td>'.$title.'</td><td class="writer">'.$writer.'</td><td class="date">'.$last_update.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<th>내용</th><td colspan="3">'.$comment.'</td>';
				echo '</tr>';
				echo '</table>';
				echo '<div style="margin:0 auto;width:0%;">';
				echo '<form action = "index_db_fk.php" method = "get">';
				echo '<input style="margin-top:15px;background:#AFEEEE;color:#000;" type="submit" value="목록">';
				echo '</form>';
				echo '</div>';
			}
		}	
	?>
</div>

</body>	

</html>