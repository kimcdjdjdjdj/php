<?php

require_once 'session.php';
require_once 'post.php';
 
if (isset($_POST['id'], $_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
	$conn = get_connection('kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com', 'kimjongchan', 'password', 'kimjongchan');
	$stmt = mysqli_prepare($conn, "SELECT hash FROM kimjongchan.user_account WHERE user_name = ?");
	mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if (mysqli_num_rows($result) != 0) { // 이미 등록된 아이디
		header('Location: error.php?error_code=4');
	} else {
		$stmt = mysqli_prepare($conn, "INSERT INTO kimjongchan.user_account (user_name, hash)VALUES (?, ?); ");
		echo mysqli_error($conn);
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ss", $id, $password_hash);
		mysqli_stmt_execute($stmt);
		header('Location: index.php');
	}
	mysqli_free_result($result);
	mysqli_close($conn);
} else {
    echo '회원가입 폼 에러';
}
