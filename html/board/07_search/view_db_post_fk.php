<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
		<script language="javascript" src="sha512.js"></script>
<script>
function tryLogin(form, password) {
    var hash = document.createElement('input');
    form.appendChild(hash);
    hash.name = 'hash';
	hash.type = 'hidden';
	hash.value = hex_sha512(password.value);
    password.value = '';
	form.submit();
	return true;
}
</script>
</head>

<body class="bo">



<h1 id="name">나의 게시판</h1>
<?php		
	require_once '../../../includes/session.php';
	start_session();
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$_SESSION['post_id'] = $_GET['post_id'];
		$id = $_SESSION['post_id'];
	}			
	if (isset($_POST['post_id'])) {
		$id = $_POST['post_id'];
	}	

	
	if (check_login()){	
?>			
		<div class="wrap_view">
		<table class="table_index">
<?php			
		echo '<tr><td>'.$_SESSION['id'].'님 로그인 되었습니다.</td>';
?>			
		<td><form action="logout.php" method="get">
<?php
		echo "<input type=\"hidden\" value=\"post\" name=\"post\">";
?>			     
		<input type="submit" value="로그아웃"></td>
		</form></td>
		</tr>
		</table>
		</div>
<?php
	} else {
?>
	<div class="wrap_view">
	<form action="login.php" method="POST">
	<table class="table_index"> 
	<tr><td>ID</td><td><input type="text" name="name" autocomplete="off"></td>
	<td>PASSWORD</td><td><input type="password" name="password"></td>
<?php	
	echo "<input type=\"hidden\" value=\"post\" name=\"post\">";
?>	
	<td><button onclick="tryLogin(this.form, this.form.password);">로그인</button></td>
	</form>
	<form action="register_page.php" method="GET">
<?php	
	echo "<input type=\"hidden\" value=\"post\" name=\"post\">";
?>	
	 <td><input type="submit" value="회원가입"></td>
	</form>
	</tr>
	</table>
	</div>
<?php
	}
	echo '<div class="wrap_view">';
	require_once '../../../includes/post.php';
	$post = get_post_from_id($id);
	$time = convert_time_string ($post->getCreated());
	$num = $post->getId();
	$title = $post->getTitle();
	$user_name = get_user_name ($post->getUserId());	
	$comment = $post->getComment();
	$board_id = $post->getBoardId();
	$last_update = $time;
	
	echo '<table class="table_view">';
	echo '<tr>';
	echo '<th class="num_view">글번호</th><th>제목</th><th>글쓴이</th><th>수정일</th>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="td_view">'.$num.'</td><td class="td_view">'.htmlspecialchars($title).'</td><td class="td_view" class="writer">'.htmlspecialchars($user_name).'</td><td class="td_view" class="date">'.$last_update.'</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>내용</th><td class="td_view" colspan="3">'.htmlspecialchars($comment).'</td>';
	echo '</tr>';
	echo '</table>';
	echo '<form action = "index_db_fk.php" method = "get">';
	if(!(isset($_SESSION['board_id']))){
		echo "<input type=\"hidden\" value=\"$board_id\" name=\"board_id\">";
	}
	$page = $_SESSION['page'];
	echo "<input type=\"hidden\" value=\"$page\" name=\"page\">";
	echo '<input style="float:right; margin-top:15px; margin-bottom:15px; background:#AFEEEE;color:#000;" type="submit" value="목록">';
	echo '</form>';
	if (isset($_SESSION['id'])){
		if ($user_name === $_SESSION['id']){
			echo '<form action = "modify.php" method = "get">';
			echo '<input style="float:right; margin-top:15px; margin-bottom:15px; margin-right:15px; background:#AFEEEE;color:#000;" type="submit" value="수정">';
			echo '</form>';
			echo '<form action = "delete.php" method = "get">';
			echo "<input type=\"hidden\" value=\"$user_name\" name=\"user_name\">";
			echo '<input style="float:right; margin-top:15px; margin-bottom:15px; margin-right:15px; background:#AFEEEE;color:#000;" type="submit" value="삭제">';
			echo '</form>';
		}
	}	
	//댓글 
	echo '<table class="table_view">';
	if (check_login()) {//수정댓글
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$reply_id = $_POST['reply_id'];
			$reply = get_reply_from_id($reply_id);
			$reply_time = convert_time_string ($reply->getReplyLastUpdate());
			
			echo '<form action="reply_modify.php" method="POST">';			
			echo '<tr>';
			echo '<th>댓글</th>';
			echo '<td ><textarea type="text" name="reply" rows="3" cols="43%">'.$reply->getReplyComment().'</textarea></td>';
			echo '<th>작성자</th>';
			echo '<td style="width:13%";>'.htmlspecialchars(get_user_name($reply->getReplyUserID())).'</td>';
			echo "<th>수정일</th>";
			echo '<td style="width:16%";>'.$reply_time."</td>";
			echo '</tr>';
			echo '</table>';			
			echo '<input type="hidden" value="'.$reply->getReplyId().'" name="reply_id">';			
			echo '<input style="float:right; margin-top:3px;background:#AFEEEE;color:#000;" type="submit" value="수정">';
			echo '</form>';
			echo '<form action = "view_db_post_fk.php" method = "GET">';
			echo '<input type="hidden" value="'.$post->getId().'" name="post_id">';
			echo '<input style="float:right; margin-top:3px; margin-right:6px; background:#AFEEEE;color:#000;" type="submit" value="취소">';
			echo '</form>';
			
		} else {//메인 댓글
			$my_id = $_SESSION['id'];
			echo '<form action="reply_db_fk.php" method="POST">';		
			echo '<tr>';
			echo '<th>댓글</th>';
			echo '<td><textarea type="text" name="reply" rows="3" cols="50%"></textarea></td>';
			echo '<th>작성자</th>';
			echo '<td>'.$my_id.'</td>';
			echo '</tr>';
			echo '</table>';		
			echo '<input style="float:right; margin-top:3px;background:#AFEEEE;color:#000;" type="submit" value="작성">';
			echo '</form>';	
		}
	} else {//로그인 안되있을때
		echo '<form action="reply_db_fk.php" method="POST">';		
		echo '<tr>';
		echo '<th>댓글</th>';
		echo '<td><textarea type="text" name="reply" rows="3" cols="50%"></textarea></td>';
		echo '<th>작성자</th>';
		echo '<td>로그인 하십시오</td>';
		echo '</tr>';
		echo '</table>';
	}
	
	
	$replys = get_all_reply($id);
	//print_r ($replys);
	echo '<table class="table_re">';
	foreach ($replys as $key => $reply) {			
		$reply_time = convert_time_string ($reply->getReplyLastUpdate());
		echo "<tr>";
		echo "<th>내용</th>";
		echo '<td style="width:39%";>'.htmlspecialchars($reply->getReplyComment())."</td>";
		echo "<th>작성자</th>";
		echo '<td style="width:16%";>'.htmlspecialchars(get_user_name ($reply->getReplyUserID()))."</td>";
		echo "<th>수정일</th>";
		echo '<td style="width:16%";>'.$reply_time."</td>";
		echo '<td>';
		if (isset($_SESSION['id'])){
			if(get_user_name ($reply->getReplyUserID()) === $_SESSION['id']){
				echo '<form action = "view_db_post_fk.php" method = "POST">';
				echo '<input type="hidden" value="'.$reply->getReplyId().'" name="reply_id">';
				echo '<input type="hidden" value="'.htmlspecialchars($post->getId()).'" name="post_id">';
				echo '<input style="margin-top:4px;margin-left:6px; background:#AFEEEE;color:#000;" type="submit" value="수정">';
				echo '</form>';
				echo '<form action = "delete.php" method = "POST">';
				echo '<input type="hidden" value="'.$reply->getReplyId().'" name="reply_id">';			
				echo '<input style="margin-top:5px; margin-left:6px; background:#AFEEEE;color:#000;" type="submit" value="삭제">';
				echo '</form>';		
				echo '</td>';
			}
		}		
		echo "</tr>";
	}
	echo "</table>";
?>
</div>

</body>	

</html>