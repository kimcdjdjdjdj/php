<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>


<body class="bo">

<div class="wrap_pro">
<?php
	require_once '../../../includes/mylib.php';
	$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$student = $_POST['student'];
		$subject = $_POST['subject'];
		$score = $_POST['score'];
		
		if (($student && $subject && $score) === false) {
				echo '<table>';
				echo '<tr>';
				echo '<td>빈칸이 없이 입력해주세요.</td>';
				echo '</tr>';				
				echo '</table>';
				echo '<form action = "test.php" method = "get">';				
				echo '<input class="submit_btn_pro" type="submit" value="뒤로가기">';
				echo '</form>';
		} else {
			$select_query = sprintf("SELECT count(*) AS num FROM kimjongchan.student WHERE student_name='%s'", $student); 
			$result = mysqli_query ($conn, $select_query);
	
			while ($row = mysqli_fetch_assoc($result)) {
			if ($row['num'] === '0') {
				$insert_query = sprintf ("INSERT INTO student (student_name) VALUES ('%s')", $student);
				if (mysqli_query($conn, $insert_query) === false) {
					echo mysqli_error($conn);
				}
			}	
		}
	
		$select_query = sprintf("SELECT count(*) AS num FROM kimjongchan.subject WHERE subject_name='%s'", $subject); 
		$result = mysqli_query ($conn, $select_query);
		
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['num'] === '0') {
				$insert_query = sprintf ("INSERT INTO subject (subject_name) VALUES ('%s')", $subject);
				if (mysqli_query($conn, $insert_query) === false) {
						echo mysqli_error($conn);
				}
			}
		}	
		
		$select_query2 = sprintf("SELECT subject_id FROM kimjongchan.subject WHERE subject_name='%s'", $subject); 
		$result2 = mysqli_query ($conn, $select_query2);
		
		while ($row2 = mysqli_fetch_assoc($result2)) {
			$subject_id = $row2['subject_id'];
		}
		//echo $subject_id;
		$select_query3 = sprintf("SELECT student_id FROM kimjongchan.student WHERE student_name='%s'", $student); 
		$result3 = mysqli_query ($conn, $select_query3);
		
		while ($row3 = mysqli_fetch_assoc($result3)) {
			$student_id = $row3['student_id'];
		}
		//echo $student_id;
		$insert_query4 = sprintf ("INSERT INTO result_score (student_id, subject_id, score) VALUES (%d, %d, %d)", $student_id, $subject_id, $score);
		if (mysqli_query($conn, $insert_query4) === false) {
			echo mysqli_error($conn);				
		} else {
				header ('location: test_view.php');
			}	
		}		
	}
	
	mysqli_close($conn);
?>
</div>

</body>	

</html>