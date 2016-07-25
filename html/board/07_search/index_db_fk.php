<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<form action="logout.php" method="get">
<input input type="hidden" value="logout" name="logout">;
<input style="margin-top:50px; margin-left:170px; background:#AFEEEE;
	color:#000;" type="submit" value="처음으로">
</form>

<body class="bo">
<?php
	require_once '../../../includes/post.php';
	require_once '../../../includes/session.php';
	start_session();
	
	if (isset($_GET['board_id'])){
		$_SESSION['board_id'] = $_GET['board_id'];
		$board_id = $_SESSION['board_id'];
	}else{
		$board_id = $_SESSION['board_id'];
	}
	//echo $_SESSION['board_id'];
	//echo $board_id;
	if(!(isset ($_GET['page']))){
		$page = 1;
		//echo $page;
	} else {
		$page = $_GET['page'];
		if ($page == 0){
			$page = 1;
		}
	}
?>

<?php
	
	if (check_login()){
	$my_id = $_SESSION['id'];
?>			
		<div class="wrap">
		<table class="table_index">
<?php			
		echo '<tr><td>'.$my_id.'님 로그인 되었습니다.</td>';
		
?>			
		<td><form action="logout.php" method="get">
<?php
		//echo "<input type=\"hidden\" value=\"$board_id\" name=\"board_id\">";
?>			     
		<input type="submit" value="로그아웃"></td>
		</form></td>
		</tr>
		</table>
		</div>
<?php
	} else {
?>
	<div class="wrap">
	<form action="login.php" method="POST">
	<table class="table_index"> 
	<tr><td>ID</td><td><input type="text" name="name"></td>
	<td>PASSWORD</td><td><input type="text" name="password"></td>
<?php	
	//echo "<input type=\"hidden\" value=\"$board_id\" name=\"board_id\">";
?>	
	<td><input type="submit" value="로그인"></td>
	</form>
	<form action="register_page.php" method="GET">
<?php	
	//echo "<input type=\"hidden\" value=\"$board_id\" name=\"board_id\">";
?>	
	 <td><input type="submit" value="회원가입"></td>
	</form>
	</tr>
	</table>
	</div>
<?php
	}
	
	echo '<div class="wrap">';
	if ($board_id == 1) {
		echo '<h1 board_id="name">게시판1</h1>';
	} else {
		echo '<h1 board_id="name">게시판2</h1>';
	}
	
	echo <<<EOD
	<table class="table_index">
	<tr>
	<th class="num">글번호</th><th class="th_idex">제목</th><th class="writer">글쓴이</th><th class="date">수정일</th>
	</tr>	
EOD;
	if(isset($_GET['search'])){
		$search = $_GET['search'];
		$posts = get_paging_limit_from_search ($search, $board_id, $page);
		
		if ($posts == 0){
			echo '<tr>';
			echo '<td class="td_index" colspan="4">검색 내용이 없습니다.</td>';
			echo '</tr>';
			echo '</table>';
		} else {
			foreach ($posts as $key => $post) {
				$time = convert_time_string ($post->getCreated());
				echo "<tr>";							
				echo "<td class=\"td_index\">".$post->getId()."</td>";
				printf ("<td class=\"td_index\"><a href=\"view_db_post_fk.php?post_id=%d\">%s</a></td>", $post->getId(), $post->getTitle());			
				echo "<td class=\"td_index\">".get_user_name($post->getUserId())."</td>";
				echo "<td class=\"td_index\">".$time."</td>";
				echo "</tr>";
			}
		echo '</table>';
		echo '<div style="margin:0 auto; width:300px; margin-top:5px;">';		
		echo get_paging_for_search ($board_id, $page, $post->getCountSearch(), $search);
		echo '</div>';
		}	
	} else {
		$posts = get_paging_limit ($board_id, $page);
		
		foreach ($posts as $key => $post) {
			$time = convert_time_string ($post->getCreated());
			echo "<tr>";							
			echo "<td class=\"td_index\">".$post->getId()."</td>";
			printf ("<td class=\"td_index\"><a href=\"view_db_post_fk.php?post_id=%d\">%s</a></td>", $post->getId(), $post->getTitle());			
			echo "<td class=\"td_index\">".get_user_name($post->getUserId())."</td>";
			echo "<td class=\"td_index\">".$time."</td>";
			echo "</tr>";
		}
		echo '</table>';
		echo '<div style="margin:0 auto; width:300px; margin-top:5px;">';
		echo get_paging ($board_id, $page);
		echo '</div>';
	}
	//print_r ($posts);
	
	
	echo '<div style="margin:0 auto; width:300px; margin-top:20px;">';
	echo '<form action="index_db_fk.php" method="get">';	
	echo '<input  type="text" name="search"  autocomplete="off">';
	echo '<input type="submit" value="검색">';
	echo '</form>';
	echo '</div>';
	echo '<form action="write_db_post_fk.php" method="get">';	
	echo '<input style="float:right; margin-top:15px; background:#AFEEEE;
	color:#000;" type="submit" value="글쓰기">';
	echo '</form>';	
?> 
</div>

</body>

</html>