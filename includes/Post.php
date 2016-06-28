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
	
	function get_all_post () {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$all_query = 'SELECT COUNT(*) AS num FROM kimjongchan.post';
		$result = mysqli_query($conn, $all_query);
		return mysqli_fetch_assoc($result)['num'];
	}
	
	function insert_post ($post) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$insert_query = sprintf ("INSERT INTO post (title, writer, comment, board_id) VALUES ('%s', '%s', '%s', %d)", $post->getTitle(), $post->getWriter(), $post->getComment(), $post->getBoardId());
		mysqli_query($conn, $insert_query);
		mysqli_close($conn);
	}
	
	function delete_post ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');		
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