<?php
	require 'mylib.php';

	
	function get_post_from_id ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf("SELECT * FROM kimjongchan.post WHERE post_id=%d;", $id);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc ($result);
		$post = new post ($row['post_id'], $row['title'], $row['writer'], $row['comment'], $row['last_update'], $row['board_id']);
		mysqli_close($conn);
		return $post;
	}
	
	function get_all_post ($board_id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$select_query = sprintf("SELECT post_id, title, writer, comment, last_update, board_id FROM kimjongchan.post WHERE board_id = %d;", $board_id);
		$result = mysqli_query ($conn, $select_query);
		$post = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$post[] = new post ($row['post_id'], $row['title'], $row['writer'], $row['comment'], $row['last_update'], $row['board_id']);
		}
		mysqli_close($conn);
		return $post;
	}
	
	function insert_post ($post) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$insert_query = sprintf ("INSERT INTO post (title, writer, comment, board_id) VALUES ('%s', '%s', '%s', %d)", $post->getTitle(), $post->getWriter(), $post->getComment(), $post->getBoardId());
		mysqli_query($conn, $insert_query);
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
	
	function modify_post ($id, $title, $comment) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$modify_query = sprintf ("UPDATE post SET title='%s', comment='%s' WHERE post_id=%d", $title, $comment, $id);
		mysqli_query ($conn, $modify_query);
		mysqli_close($conn);
	}
	
	function reply_post ($reply) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$reply_query = sprintf ("INSERT INTO reply (reply_writer, reply_comment, post_id) VALUES ('%s', '%s', %d)", $reply->getReplyWriter(), $reply->getReplyComment(), $reply->getPostId());
		mysqli_query($conn, $reply_query);
		mysqli_close($conn);		
	}
	
	function get_reply_from_id ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf("SELECT * FROM kimjongchan.reply WHERE reply_id=%d;", $id);
		$result = mysqli_query ($conn, $id_query);
		$row = mysqli_fetch_assoc ($result);
		$reply = new reply ($row['reply_id'], $row['reply_writer'], $row['reply_comment'], $row['reply_last_update'], $row['post_id']);
		mysqli_close($conn);
		return $reply;
	}
	
	function get_all_reply ($post_id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$reply_query = sprintf("SELECT * FROM kimjongchan.reply WHERE post_id = %d;", $post_id);
		$result = mysqli_query ($conn, $reply_query);
		$reply = array();
		while ($row = mysqli_fetch_assoc($result)) {
			$reply[] = new reply ($row['reply_id'], $row['reply_writer'], $row['reply_comment'], $row['reply_last_update'], $row['post_id']);
		}
		mysqli_close($conn);
		return $reply;
	}
	
	function modify_reply ($reply_id, $reply_comment) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$modify_query = sprintf ("UPDATE reply SET reply_comment='%s' WHERE reply_id=%d", $reply_comment, $reply_id);
		mysqli_query ($conn, $modify_query);
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
		function __construct($id, $title, $writer, $comment, $last_update, $board_id) {
			$this->id = $id;
			$this->title = $title;
			$this->writer = $writer;
			$this->comment = $comment;
			$this->created = $last_update;
			$this->boardId = $board_id;
		}
		
		function getId() {
			return $this->id;
		}
		
		function getTitle() {
			return $this->title;
		}
		
		function getWriter() {
			return $this->writer;
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
	}
	
	class reply {
		function __construct($reply_id, $reply_writer, $reply_comment, $reply_last_update, $post_id) {
			$this->replyId = $reply_id;
			$this->replyWriter = $reply_writer;
			$this->replyComment = $reply_comment;
			$this->replyLastUpdate = $reply_last_update;
			$this->postId = $post_id;
		}
		function getReplyId() {
			return $this->replyId;
		}
		
		function getReplyWriter() {
			return $this->replyWriter;
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
	