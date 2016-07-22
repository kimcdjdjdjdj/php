<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php
require_once '../../../includes/session.php';
 
start_session();
 
if (isset($_POST['name'], $_POST['password'])) {
    $id = $_POST['name'];
    $password = $_POST['password']; 
	
	echo "login.php";
	
    if (try_to_login($id, $password) == true) {
        if (isset($_POST['post'])){
			$post_id = $_SESSION['post_id'];
			header("Location: view_db_post_fk.php?post_id=$post_id");
		} else if (isset($_SESSION['board_id'])) {		
			header("Location: index_db_fk.php");
		} else {
			header("Location: board_number.php");
		}	
    } else {
		// 이멜주소 또는 비번이 등록되지 않았거나 틀림
        header('Location: error.php?error_code=1');
    }
} else {
    echo '로그인 폼 에러';
}
?>
</body>
</html>