<?php
	function get_connection ($host, $user, $pass, $db) {
		$hostname = $host;
		$username =	$user;
		$password = $pass;
		$dbname = $db;
		$conn = mysqli_connect($hostname, $username, $password, $dbname);
		mysqli_query($conn, "SET NAMES 'utf8'");
		return ($conn);
	}

	function convert_time_string($time_string_from_db ) {
		$datetime = date_create($time_string_from_db , timezone_open('UTC'));
		$datetime = date_timezone_set($datetime, timezone_open('Asia/Seoul'));
    return date_format($datetime, 'Y-m-d H:i:s');
	}	
	
	function get_student_name ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');	
		$name_query = sprintf ("SELECT student_name FROM kimjongchan.student WHERE student_id=%d;", $id);
		$result2 = mysqli_query ($conn, $name_query);
		while ($row2 = mysqli_fetch_assoc($result2)) {
			$value = $row2['student_name'];
		}
		return ($value);
	}
	
	function get_subject_name ($id) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$subject_query = sprintf ("SELECT subject_name FROM kimjongchan.subject WHERE subject_id=%d;", $id);
		$result3 = mysqli_query ($conn, $subject_query);
		while ($row3 = mysqli_fetch_assoc($result3)) {
			$value = $row3['subject_name'];
		}
		return ($value);
	}
	
	function get_stu_rowspan ($student_name) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf ("SELECT student_id FROM kimjongchan.student WHERE student_name='%s';", $student_name);
		$result4 = mysqli_query ($conn, $id_query);
		while ($row4 = mysqli_fetch_assoc($result4)) {
			$id = $row4['student_id'];
		}
		
		$rowspan_query = sprintf("SELECT count(*) AS num FROM kimjongchan.result_score WHERE student_id=%d;", $id); 
		$result5 = mysqli_query ($conn, $rowspan_query);		
		while ($row5 = mysqli_fetch_assoc($result5)) {
			$rowspan = $row5['num'];
		}
		return ($rowspan);
	}
	
	function get_subject_rowspan ($subject_name) {
		$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
		$id_query = sprintf ("SELECT subject_id FROM kimjongchan.subject WHERE subject_name='%s';", $subject_name);
		$result6 = mysqli_query ($conn, $id_query);
		while ($row6 = mysqli_fetch_assoc($result6)) {
			$id = $row6['subject_id'];
		}
		
		$rowspan_query = sprintf("SELECT count(*) AS num FROM kimjongchan.result_score WHERE subject_id=%d;", $id); 
		$result7 = mysqli_query ($conn, $rowspan_query);		
		while ($row7 = mysqli_fetch_assoc($result7)) {
			$rowspan = $row7['num'];
		}
		return ($rowspan);
	}
	
	
?>