<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body class="bo">

<div class="wrap_view">

<h1 id="name">나의 게시판</h1>
<?php		
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$id = $_GET['number'];
	}			
	
	require_once '../../../includes/post.php';
	$post = get_post_from_id($id);					
	$time = convert_time_string ($post->getCreated());
	$num = $post->getId();
	$title = $post->getTitle();
	$writer = $post->getWriter();
	$comment = $post->getComment();
	$last_update = $time;
	
	echo '<table class="table_view">';
	echo '<tr>';
	echo '<th class="num_view">글번호</th><th>제목</th><th>글쓴이</th><th>수정일</th>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="td_view">'.$num.'</td><td class="td_view">'.$title.'</td><td class="td_view" class="writer">'.$writer.'</td><td class="td_view" class="date">'.$last_update.'</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>내용</th><td class="td_view" colspan="3">'.$comment.'</td>';
	echo '</tr>';
	echo '</table>';
	echo '<form action = "index_db_fk.php" method = "get">';
	echo '<input style="float:right; margin-top:15px; margin-bottom:15px; background:#AFEEEE;color:#000;" type="submit" value="목록">';
	echo '</form>';
	echo '<form action = "modify.php" method = "get">';
	echo "<input type=\"hidden\" value=\"$id\" name=\"number\">";
	echo '<input style="float:right; margin-top:15px; margin-bottom:15px; margin-right:15px; background:#AFEEEE;color:#000;" type="submit" value="수정">';
	echo '</form>';
	echo '<form action = "delete.php" method = "get">';
	echo "<input type=\"hidden\" value=\"$id\" name=\"number\">";
	echo '<input style="float:right; margin-top:15px; margin-bottom:15px; margin-right:15px; background:#AFEEEE;color:#000;" type="submit" value="삭제">';
	echo '</form>';
		
	//댓글
	echo '<form action="reply_db_fk.php" method="post">';
	echo '<table class="table_view">';
	echo '<tr>';
	echo '<th>댓글</th>';
	echo '<td><textarea type="text" name="reply" rows="3" cols="50%"></textarea></td>';
	echo '<th>작성자</th>';
	echo '<td><input type="text" name="re_writer"></td>';
	echo '</tr>';
	echo '</table>';
	echo "<input type=\"hidden\" value=\"$id\" name=\"post_id\">";
	echo '<input style="float:right; margin-top:3px;background:#AFEEEE;color:#000;" type="submit" value="작성">';
	echo '</form>';	

	$replys = get_all_reply($id);
	//print_r ($replys);
	echo '<table class="table_re">';
	foreach ($replys as $key => $reply) {			
		$reply_time = convert_time_string ($reply->getReplyLastUpdate());
		echo "<tr>";
		echo "<th>내용</th>";
		echo '<td style="width:39%">'.$reply->getReplyComment()."</td>";
		echo "<th>작성자</th>";
		echo '<td style="width:16%">'.$reply->getReplyWriter()."</td>";
		echo "<th>수정일</th>";
		echo '<td style="width:16%">'.$reply_time."</td>";
		echo "</tr>";		
	}
	echo "</table>";
?>
</div>

</body>	

</html>