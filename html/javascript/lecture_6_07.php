<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
<script>
	var global = 'global'; //선언
	function myFunction() {
		var local = 'local'; //선언
		local = 'new local'; //사용1
		global = 'new global'; //사용1
		mistake = 'value'; //선언인데 var이 없음
		function myFunction2() {
			var local2 = 'local2'; //선언
			var local3 = local; //선언과 사용2
			global = 'new value'; //사용
		}
	}
</script>
</head>
<body>
<?php
	//위의 자바스크립트 코드와 비교하면서 정리하자
	$global = 'global';
	function my_function() {
		$local = 'local';
		$local = 'new local';
		$global = 'new global'; //지역변수인가, 전역변수인가?
	}
?>
</body>
</html>