<?php
	require_once 'mylib.php';

	
	function get_post_from_id ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf("SELECT * FROM kimjongchan.post WHERE post_id=%d;", $id);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc ($result);
		$post = new post ($row['post_id'], $row['title'], $row['user_id'], $row['comment'], $row['last_update'], $row['board_id'], 0);
		mysqli_close($conn);
		return $post;
	}
	
	function get_all_post ($board_id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$select_query = sprintf("SELECT post_id, title, user_id, comment, last_update, board_id FROM kimjongchan.post WHERE board_id = %d; ", $board_id);
		$result = mysqli_query ($conn, $select_query);
		$post = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$post[] = new post ($row['post_id'], $row['title'], $row['user_id'], $row['comment'], $row['last_update'], $row['board_id']);
		}
		mysqli_close($conn);
		return $post;
	}
	
	function insert_post ($post) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');		
		
		$insert_query = 'INSERT INTO post (title, user_id, comment, board_id) VALUES (?, ?, ?, ?)';
		$stmt = mysqli_prepare($conn, $insert_query);
		mysqli_stmt_bind_param($stmt, 'sisi', $post->getTitle(), $post->getUserId(), $post->getComment(), $post->getBoardId());
		if (!mysqli_stmt_execute($stmt)) {
			die('add_post query failure');
		}
		mysqli_close($conn);
	}
	
	function delete_post ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$reply = sprintf("SELECT * FROM reply WHERE post_id=%d;", $id);
		$result = mysqli_query ($conn, $reply);
		while ($row = mysqli_fetch_assoc($result)){
			if ($row['reply_id'] = true) {
			$reply_all_delete = sprintf("DELETE FROM reply WHERE post_id =%d;", $id);
			mysqli_query ($conn, $reply_all_delete);
			}
		}
		$delete = sprintf("DELETE FROM post WHERE post_id =%d;", $id);
		mysqli_query ($conn, $delete);		
		mysqli_close($conn);
	}
	
	function modify_post ($post_id, $title, $comment) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');		
		$modify_query = 'UPDATE post SET title=?, comment=? WHERE post_id=?';
		$stmt = mysqli_prepare($conn, $modify_query);
		mysqli_stmt_bind_param($stmt, 'ssi', $title, $comment, $post_id);
		if (!mysqli_stmt_execute($stmt)) {
			die('add_post query failure');
		}
		mysqli_close($conn);
		
	}
	
	function reply_post ($reply) {
		$id = $reply->getReplyUserID();
		$comment = $reply->getReplyComment();
		$post_id = $reply->getPostId();
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$reply_query = 'INSERT INTO reply (user_id, reply_comment, post_id) VALUES (?, ?, ?)';
		$stmt = mysqli_prepare($conn, $reply_query);
		mysqli_stmt_bind_param($stmt, 'ssi', $id, $comment, $post_id);
		if (!mysqli_stmt_execute($stmt)) {
			die('add_post query failure');
		}
		
		$reply = array();
		$query = 'SELECT LAST_INSERT_ID() AS reply_id;';
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$reply_id = $row['reply_id'];
		$reply[0] = $reply_id;
		
		$array_query = sprintf("SELECT reply_last_update FROM reply WHERE reply_id=%d;", $reply_id);
		$result2 = mysqli_query($conn, $array_query);
		$row = mysqli_fetch_assoc($result2);
		$reply_last_update = $row['reply_last_update'];
		$reply[1] = $reply_last_update;
		
		mysqli_close($conn);		
		
		return $reply;
	}
	
	function get_reply_from_id ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf("SELECT * FROM kimjongchan.reply WHERE reply_id=%d;", $id);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc ($result);
		$reply = new reply ($row['reply_id'], $row['user_id'], $row['reply_comment'], $row['reply_last_update'], $row['post_id']);
		mysqli_close($conn);
		return $reply;
	}
	
	function get_all_reply ($post_id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$reply_query = sprintf("SELECT * FROM kimjongchan.reply WHERE post_id = %d ORDER BY reply_id DESC;", $post_id);
		$result = mysqli_query ($conn, $reply_query);
		$reply = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$reply[] = new reply ($row['reply_id'], $row['user_id'], $row['reply_comment'], $row['reply_last_update'], $row['post_id']);
		}
		mysqli_close($conn);
		return $reply;
	}
	
	function modify_reply ($reply_id, $reply_comment) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');		
		$modify_query = 'UPDATE reply SET reply_comment=? WHERE reply_id=?';
		$stmt = mysqli_prepare($conn, $modify_query);
		mysqli_stmt_bind_param($stmt, 'si', $reply_comment, $reply_id);
		if (!mysqli_stmt_execute($stmt)) {
			die('add_post query failure');
		}
		mysqli_close($conn);
	}
	
	function delete_reply ($reply_id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');		
		$delete = sprintf("DELETE FROM reply WHERE reply_id =%d;", $reply_id);
		mysqli_query ($conn, $delete);		
		mysqli_close($conn);
	}
	
	
	
	// 생성 시각으로 정렬된 모든 게시물 중 일부 구간을 반환
	function get_posts($begin, $num) {
		$conn = get_db_connection();
		$query = sprintf("SELECT * FROM bulletin_board__post ORDER BY post_id DESC LIMIT %s, %s", $begin, $num);
		$result = mysqli_query($conn, $query);
		$posts = array();
		while($row = mysqli_fetch_assoc($result)) {
			$posts[] = new Post($row['post_id'], $row['title'], $row['author'], $row['content'], $row['created']);
		}
		mysqli_free_result($result);
		mysqli_close($conn);
		return $posts;
	}
	
	// 특정 게시물 반환
	function get_post_with_id($id) {
		$conn = get_db_connection();
		$query = sprintf("SELECT * FROM bulletin_board__post WHERE post_id = %s", $id);
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$post = new Post($row['post_id'], $row['title'], $row['author'], $row['content'], $row['created']);
		mysqli_free_result($result);
		mysqli_close($conn);
		return $post;
	}	
	
	
	function get_num_total_posts() {
		$conn = get_db_connection();
		$query = 'SELECT COUNT(*) AS num FROM bulletin_board__post';
		$result = mysqli_query($conn, $query);
		return mysqli_fetch_assoc($result)['num'];
	}

	function add_post($title, $author, $content) {
		echo 'Inserting new post, title: '.$title.' author: '.$author.' content: '.$content.'<br><br>';
		$conn = get_db_connection();
		$query = sprintf("INSERT INTO bulletin_board__post (title, author, content) values('%s','%s','%s');", $title, $author, $content);
		mysqli_query($conn, $query);
		mysqli_close($conn);
	}
	
	class Post {
		function __construct($id, $title, $user_id, $comment, $last_update, $board_id, $count_search) {
			$this->id = $id;
			$this->title = $title;
			$this->userid = $user_id;
			$this->comment = $comment;
			$this->created = $last_update;
			$this->boardId = $board_id;
			$this->countSearch = $count_search;
		}
		
		function getId() {
			return $this->id;
		}
		
		function getTitle() {
			return $this->title;
		}
		
		function getUserId() {
			return $this->userid;
		}
		
		function getComment() {
			return $this->comment;
		}
		
		function getCreated() {
			return $this->created;
		}
		
		function getBoardId() {
			return $this->boardId;
		}
		
		function getCountSearch() {
			return $this->countSearch;
		}
	}
	
	class reply {
		function __construct($reply_id, $user_id, $reply_comment, $reply_last_update, $post_id) {
			$this->replyId = $reply_id;
			$this->replyUserID = $user_id;
			$this->replyComment = $reply_comment;
			$this->replyLastUpdate = $reply_last_update;
			$this->postId = $post_id;
		}
		function getReplyId() {
			return $this->replyId;
		}
		
		function getReplyUserID() {
			return $this->replyUserID;
		}
		
		function getReplyComment() {
			return $this->replyComment;
		}
		
		function getReplyLastUpdate() {
			return $this->replyLastUpdate;
		}
		
		function getPostId() {
			return $this->postId;
		}
	}
	
	function get_paging_limit ($board_id, $page) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		
		$list = 5;
		$s_point = ($page - 1) * $list;
		
		$limit_query = sprintf("SELECT * FROM post WHERE board_id=%d ORDER BY post_id DESC LIMIT %d, %d", $board_id, $s_point, $list);
		$real_data = mysqli_query ($conn, $limit_query);
		while ($row = mysqli_fetch_assoc($real_data)) {
			$post[] = new post ($row['post_id'], $row['title'], $row['user_id'], $row['comment'], $row['last_update'], $row['board_id'], 0);
		}
		mysqli_close($conn);
		if(!(isset($post))){
			return 1;
		} else{
			return $post;
		}	
	}
	
	function get_paging_limit_from_search ($search, $board_id, $page) {
		if ($search == false){
			return 0;
		}
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		
		$list = 5;
		$s_point = ($page - 1) * $list;
		
		$search = '%'.$search.'%';
		//검색한 단어가 포함된  post를 TEMPORARY TABLE에 넣는다.
		$all_query = 'CREATE TEMPORARY TABLE search AS(SELECT * FROM post 
		WHERE (title LIKE ?) AND (board_id=?)
		ORDER BY post_id DESC)';
		$stmt = mysqli_prepare($conn, $all_query);
		mysqli_stmt_bind_param($stmt, 'si', $search, $board_id);
		mysqli_stmt_execute($stmt);
		//TEMPORARY TABLE에 있는 갯수 확인
		$count_query = "SELECT COUNT(*) FROM search";
		$result = mysqli_query($conn, $count_query);
		$row2 = mysqli_fetch_assoc($result);
		$count_search = intval($row2['COUNT(*)']);
		
		$search_query = sprintf("SELECT * FROM search 
		LIMIT %d, %d;", $s_point, $list);
		$real_data =  mysqli_query($conn, $search_query);
				
		if ($count_search === 0){
				mysqli_close($conn);
				return 0;
		} else{
			while ($row = mysqli_fetch_assoc($real_data)) {			
			$post[] = new post ($row['post_id'], $row['title'], $row['user_id'], $row['comment'], $row['last_update'], $row['board_id'], $count_search);		
			}
			mysqli_close($conn);
			return $post;
		}		
	}
	
	function get_paging ($board_id, $page) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$total_post = sprintf ("SELECT COUNT(*) AS num FROM post WHERE board_id=%d;", $board_id);
		$result = mysqli_query($conn, $total_post);
		$row = mysqli_fetch_assoc($result);
		$num = $row['num']; //총 게시물
		$list = 5; // 페이지당 출력 게시물
		$block = 5; //블록당 페이지 수
		$page_num = ceil ($num/$list); //총 페이지
		$block_num = ceil ($page_num/$block); //총 블럭
		$now_block = ceil ($page/$block); //현재 블럭
		$start_page = (($now_block - 1) * $block) + 1; //블럭의 첫번째 번호
		if ($start_page <= 1){
			$start_page = 1;
		}
		$end_page = $now_block * $block;
		if ($page_num <= $end_page){
			$end_page = $page_num;
		}
		
		
		if($page <=1){
			echo '<처음>';
		}else {
				printf ("<a href=\"index_db_fk.php?page=1&id=%d\"><처음></a>", $board_id);
			}
		if ($now_block <= 1){
			
		} else {
			printf ("<a href=\"index_db_fk.php?page=%d&id=%d\"><<<</a>", $start_page - 1, $board_id);
		}
		if ($page <= 1){
			
		} else {
		printf ("<a href=\"index_db_fk.php?page=%d&id=%d\"><이전></a>", $page - 1, $board_id);
		}
		for ($p = $start_page; $p <= $end_page; $p +=1){
			if ($page == $p)
				echo "[$p]";
			else {
				printf ("<a href=\"index_db_fk.php?page=%d&id=%d\">[%d]</a>", $p, $board_id, $p);
			}	
		}
		if ($page >= $page_num) {
			
		} else {
			printf ("<a href=\"index_db_fk.php?page=%d&id=%d\"><다음></a>", $page + 1, $board_id);
		}
		if ($now_block >= $block_num){
			
		} else {
			printf ("<a href=\"index_db_fk.php?page=%d&id=%d\">>>></a>", $end_page + 1, $board_id);
		}
		if($page >= $page_num){
			
		}else {
				printf ("<a href=\"index_db_fk.php?page=%d&id=%d\"><마지막></a>", $page_num, $board_id);
			}
		$s_point = ($page - 1) * $list;
	}
	
	function get_paging_for_search ($board_id, $page, $count_search, $search) {
		$num = $count_search; //총 게시물
		$list = 5; // 페이지당 출력 게시물
		$block = 5; //블록당 페이지 수
		$page_num = ceil ($num/$list); //총 페이지
		$block_num = ceil ($page_num/$block); //총 블럭
		$now_block = ceil ($page/$block); //현재 블럭
		$start_page = (($now_block - 1) * $block) + 1; //블럭의 첫번째 번호
		if ($start_page <= 1){
			$start_page = 1;
		}
		$end_page = $now_block * $block;
		if ($page_num <= $end_page){
			$end_page = $page_num;
		}
		
		
		if($page <=1){
			echo '<처음>';
		}else {
				printf ("<a href=\"index_db_fk.php?page=1&search='%s'\"><처음></a>", $$search);
			}
		if ($now_block <= 1){
			
		} else {
			printf ("<a href=\"index_db_fk.php?page=%d&search='%s'\"><<<</a>", $start_page - 1, $search);
		}
		if ($page <= 1){
			
		} else {
		printf ("<a href=\"index_db_fk.php?page=%d&search='%s'\"><이전></a>", $page - 1, $search);
		}
		for ($p = $start_page; $p <= $end_page; $p +=1){
			if ($page == $p)
				echo "[$p]";
			else {
				printf ("<a href=\"index_db_fk.php?page=%d&search='%s'\">[%d]</a>", $p, $search, $p);
			}	
		}
		if ($page >= $page_num) {
			
		} else {
			printf ("<a href=\"index_db_fk.php?page=%dsearch='%s'\"><다음></a>", $page + 1, $search);
		}
		if ($now_block >= $block_num){
			
		} else {
			printf ("<a href=\"index_db_fk.php?page=%d&search='%s'\">>>></a>", $end_page + 1, $search);
		}
		if($page >= $page_num){
			
		}else {
				printf ("<a href=\"index_db_fk.php?page=%d&search='%s'\"><마지막></a>", $page_num, $search);
			}
		$s_point = ($page - 1) * $list;
	}
	function get_user_id ($user_name) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf("SELECT user_id FROM kimjongchan.user_account WHERE user_name='%s';", $user_name);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc ($result);
		$user_id = $row['user_id'];
		mysqli_close($conn);
		return $user_id;
	}
	
	function get_user_name ($user_id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf("SELECT user_name FROM kimjongchan.user_account WHERE user_id=%d;", $user_id);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc ($result);
		$user_name = $row['user_name'];
		mysqli_close($conn);
		return $user_name;
	}
