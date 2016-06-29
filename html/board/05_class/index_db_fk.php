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
	require_once '../../../includes/post.php';

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
	
	$posts = get_all_post ($id);
	//print_r ($posts);
	foreach ($posts as $key => $post) {
				$time = convert_time_string ($post->getCreated());
		echo "<tr>";							//여기부터 ㄱㄱ
		echo "<td class=\"td_index\">".$post->getId()."</td>";
		printf ("<td class=\"td_index\"><a href=\"view_db_post_fk.php?number=%d\">%s</a></td>", $post->getId(), $post->getTitle());
		echo "<td class=\"td_index\">".$post->getWriter()."</td>";
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