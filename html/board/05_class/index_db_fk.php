<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<form action="../../../index.php" method="get">
<input style="margin-top:50px; margin-left:170px; background:#AFEEEE;
	color:#000;" type="submit" value="처음으로">
</form>

<body class="bo">

<div class="wrap">



<?php
	require_once '../../../includes/mylib.php';
	$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');		
	
	for ($id = 1; $id <= 2; $id += 1) {
		if ($id === 1) {
			echo '<h1 id="name">게시판1</h1>';
		} else {
			echo '<h1 id="name">게시판2</h1>';
		}
	
	echo <<<EOD
	<table class="table_index">
	<tr>
	<th class="num">글번호</th><th class="th_idex">제목</th><th class="writer">글쓴이</th><th class="date">수정일</th>
	</tr>	
EOD;
	
	$select_query = sprintf("SELECT post_id, title, writer, last_update, board_id FROM kimjongchan.post WHERE board_id = %d;", $id);
	$result = mysqli_query ($conn, $select_query);
		
	while ($row = mysqli_fetch_assoc($result)) {
		$time = convert_time_string ($row['last_update']);
		echo "<tr>";
		echo "<td class=\"td_index\">".$row['post_id']."</td>";
		printf ("<td class=\"td_index\"><a href=\"view_db_post_fk.php?number=%d\">%s</a></td>", $row['post_id'], $row['title']);
		echo "<td class=\"td_index\">".$row['writer']."</td>";
		echo "<td class=\"td_index\">".$time."</td>";
		echo "</tr>";
	}
	echo '</table>';
	echo '<form action="write_db_post_fk.php" method="get">';
	echo "<input type=\"hidden\" value=\"$id\" name=\"board\">";
	echo '<input style="float:right; margin-top:15px; background:#AFEEEE;
	color:#000;" type="submit" value="글쓰기">';
	echo '</form>';
	}
?> 

</div>

</body>

</html>