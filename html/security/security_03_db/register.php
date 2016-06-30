<?php

require_once 'session.php';
require_once $_SERVER["DOCUMENT_ROOT"]."/../includes/mylib.php";
 
if (isset($_POST['id'], $_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
	echo '1';
	$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
	echo '2';
	$stmt = mysqli_prepare($conn, "SELECT hash FROM kimjongchan.user_account WHERE user_id = ?");
	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	echo '3';
	if (mysqli_num_rows($result) != 0) { // 이미 등록된 아이디
		header('Location: error.php?error_code=4');
	} else {
		$stmt = mysqli_prepare($conn, "INSERT INTO kimjongchan.user_account VALUES (?, ?)");
		echo mysqli_error($conn);
		mysqli_stmt_bind_param($stmt, "ss", $id, password_hash($password, PASSWORD_DEFAULT));
		mysqli_stmt_execute($stmt);
		//header('Location: index.php');
	}
	echo '4';
	mysqli_free_result($result);
	mysqli_close($conn);
} else {
    echo '회원가입 폼 에러';
}
