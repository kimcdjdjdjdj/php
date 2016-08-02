<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
		<script language="javascript" src="js/sha512.js"></script>
		<script language="javascript" src="js/jquery-1.11.2.js"></script>
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

var isEditReplyMode = false;
function editReply(button, replyId, form) {
	var cell = document.getElementById(replyId);
	if (isEditReplyMode == false) {
		var content = cell.innerHTML;
		cell.innerHTML = '';
		var textarea = document.createElement('textarea');
		textarea.id = replyId + 'textarea';
		cell.appendChild(textarea);
		textarea.value = content;
		textarea.cols = 35;
		isEditReplyMode = true;
		button.value = '수정완료';		
	} else {
		var textarea = document.getElementById(replyId + 'textarea');
		var content = textarea.value;
		if (content == '') {
			alert('댓글은 빈칸 안됨');
			textarea.focus();
			return false;
		}
		//cell.innerHTML = content;
		isEditReplyMode = false;
		button.value = '수정';
		var element = document.createElement('input');
		form.appendChild(element);
		element.name = 'reply';
		element.type = 'hidden';
		element.value = content;
		form.submit();
	}
	return false;
}

function deleteRowById(table, rowId) {
	for (var i = 0; i < table.rows.length; i++) {
		if (table.rows[i].id === rowId) {
			table.deleteRow(i);
			return;
		}
	}
	alert('deleteRowById not found');
}

function deleteReply(replyId) {
	if (confirm('정말 삭제하겟습니까?')) {
		ajaxDeleteReply(replyId);
		var table = document.getElementById('table_re');
		deleteRowById(table, 'reply_id' + replyId);
	}	
}

function ajaxDeleteReply(replyId) {	
	$.ajax({ 
		url: 'ajax_delete_reply.php',
		type: 'POST',
		async: false,
		data: { reply_id: replyId },
		success: function(result) {
		},
		error: function(xhr) {
			alert('ajaxDeleteReply');
		},
		timeout : 1000
	});		
}

var currentDisplayedReplies = 0;
var replyBlockSize = 3;
function showMoreReplies(button) {
	var table = document.getElementById('table_re');
	var numTotalReplies = table.rows.length;
	//alert(numTotalReplies);
	var nextDisplayedReplies = Math.min(currentDisplayedReplies + replyBlockSize, numTotalReplies);
	for (var rownum = 0; rownum < numTotalReplies; rownum++) {
		var row = table.rows[rownum];
		if (rownum < nextDisplayedReplies) {
			row.style.display = '';
		} else {
			row.style.display = 'none';
		}
	}
	currentDisplayedReplies = nextDisplayedReplies;
	if (nextDisplayedReplies === numTotalReplies) {
		button.style.display = 'none';
	} 
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
	if (isset($_SESSION['page'])){
		$page = $_SESSION['page'];
		echo "<input type=\"hidden\" value=\"$page\" name=\"page\">";
	}
	echo '<input class="view_list" type="submit" value="목록">';
	echo '</form>';
	if (isset($_SESSION['id'])){
		if ($user_name === $_SESSION['id']){
			echo '<form action = "modify.php" method = "get">';
			echo '<input class="view_modify" type="submit" value="수정">';
			echo '</form>';
			echo '<form action = "delete.php" method = "get">';
			echo "<input type=\"hidden\" value=\"$user_name\" name=\"user_name\">";
			echo '<input class="view_modify" type="submit" value="삭제">';
			echo '</form>';
		}
	}
	//댓글 
	echo '<table class="table_view">';
	if (check_login()) {
		//메인 댓글
		$my_id = $_SESSION['id'];
		echo '<form action="reply_db_fk.php" method="POST">';		
		echo '<tr>';
		echo '<th>댓글</th>';
		echo '<td><textarea type="text" name="reply" rows="3" cols="50%"></textarea></td>';
		echo '<th>작성자</th>';
		echo '<td>'.$my_id.'</td>';
		echo '</tr>';
		echo '</table>';
		echo '<input class="reply_modify" type="submit" value="작성">';
		echo '</form>';	
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
	echo '<table id="table_re">';
	foreach ($replys as $key => $reply) {			
		$reply_time = convert_time_string ($reply->getReplyLastUpdate());
		echo '<tr id="reply_id'.$reply->getReplyId().'">';
		echo "<th>내용</th>";
		echo '<td style="width:39%" id="'.$reply->getReplyId().'">'.htmlspecialchars($reply->getReplyComment())."</td>";
		echo "<th>작성자</th>";
		echo '<td style="width:16%";>'.htmlspecialchars(get_user_name ($reply->getReplyUserID()))."</td>";
		echo "<th>수정일</th>";
		echo '<td style="width:16%";>'.$reply_time."</td>";
		
		if (isset($_SESSION['id'])){
			if(get_user_name ($reply->getReplyUserID()) === $_SESSION['id']){
				echo '<td>';
				echo '<form action = "reply_modify.php" method = "POST">';
				echo '<input type="hidden" value="'.$reply->getReplyId().'" name="reply_id">';
				echo '<input type="hidden" value="'.htmlspecialchars($post->getId()).'" name="post_id">';
				echo '<input class="view_reply_modify" type="button" value="수정" 
				onClick="editReply(this, '.$reply->getReplyId().', this.form);">';
				echo '</form>';
				echo '<form action = "view_db_post_fk.php" method = "POST">';	
				echo '<input class="view_reply_del" type="button" value="삭제"
				onClick="deleteReply('.$reply->getReplyId().');">';
				echo '</form>';
				echo '</td>';
				echo "</tr>";
			} else{
				echo "</tr>";
			}
		} else {
			echo "</tr>";
		}
	}	
?>
</table>
<input type="button" id="show_more_reply_button" class="view_list" value="댓글 더보기" onclick="showMoreReplies(this);"> </input><br><br>
<script>
if (currentDisplayedReplies === 0){
	showMoreReplies(document.getElementById('show_more_reply_button'));
}
</script>
</div>

</body>	

</html>