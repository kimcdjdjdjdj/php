<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<style type="text/css">

.wrap {margin:0 auto; width:50%; margin-top:50px;}
table {width:100%; border:1px solid #000000;
	border-collapse:collapse;margin-top:100px;}
th {background:#0099ff;}
.num {width:15%;}
td, th {border:1px solid #000000; padding:10px;
	text-align:center;}
#name {text-align:center;}
.bo {margin:0 auto; width:70%; background:#ADFF2F}
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
			
		$hostname = 'localhost';
		$username = 'root';
		$password = 'cks2ek';
		$dbname = 'kimjongchan';
		$conn = mysqli_connect($hostname,$username, $password, $dbname);
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
				echo '<th class="num">번호</th>';
				echo '<td>'.$num.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<th>제목</th>';
				echo '<td>'.$title.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<th>글쓴이</th>';
				echo '<td>'.$writer.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<th>수정일</th>';
				echo '<td>'.$last_update.'</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<th>내용</th>';
				echo '<td>'.$comment.'</td>';
				echo '</tr>';
				echo '</table>';
				echo '<div style="margin:0 auto;width:0%;">';
				echo '<form action = "index_db.php" method = "get">';
				echo '<input style="margin-top:15px;background:#0099ff;color:#000;" type="submit" value="목록">';
				echo '</form>';
				echo '</div>';
			}
		}	
	?>
</div>

</body>	

</html>