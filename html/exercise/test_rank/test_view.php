<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body class="bo">
<div class="wrap_view">
<h1 id="name">이름 기준</h1>
<table style="width:100%; border:1px solid #000000;
	border-collapse:collapse;margin-top:10px;">

<tr>
<th>이름</th><th>과목</th><th>성적</th>
</tr>
<?php
	require_once '../../../includes/mylib.php';
	$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
	
	$select_query = 'SELECT student_id, subject_id, score FROM kimjongchan.result_score'; 
	$result = mysqli_query ($conn, $select_query);
	
	while ($row = mysqli_fetch_assoc($result)) {
		$name = get_student_name ($row['student_id']);
		$subject = get_subject_name ($row['subject_id']);		
		$score = $row['score'];
				
		$grade[$name][$subject] = $score;
		$grade2[$subject][$name] = $score;
	}
	
	echo '<tr>';
	foreach ($grade as $student => $stu_grade) {
		echo '<td  class="td_view" rowspan="'.get_stu_rowspan($student).'">'.$student.'</td>';
		foreach ($stu_grade as $subject => $score) {
			echo '<td class="td_view">'.$subject.'</td><td class="td_view">'.$score.'</td>';
			echo '</tr>';
			
		}
	}
	echo '</table>';
	
	echo '<table style="width:100%; border:1px solid #000000;
	border-collapse:collapse;margin-top:10px;">';
	echo '<h1 id="name">이름 기준</h1>';
	echo '<tr>';
	echo '<th>과목</th><th>이름</th><th>성적</th>';
	echo '</tr>';
	echo '<tr>';
	foreach ($grade2 as $subject => $stu_grade) {
		echo '<td  class="td_view" rowspan="'.get_subject_rowspan($subject).'">'.$subject.'</td>';
		foreach ($stu_grade as $student => $score) {
			echo '<td class="td_view">'.$student.'</td><td class="td_view">'.$score.'</td>';
			echo '</tr>';
			
		}
	}
	echo '</table>';
?>
</div>
</body>
</html>