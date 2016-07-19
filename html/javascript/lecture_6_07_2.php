<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<header>
<script>
	function myFunction() {
		var array = [1, 2, 3];
		var map = { member1 : 'string value', member2 : 2345, member3 : '아아아아아' };
		document.write(array, '<br>');
		document.write(map, '<br>');
		document.write(map.member1, '<br>');
		document.write(map.member2, '<br>');
		document.write(map.member3, '<br>');
	}
</script>
</header>
<body>
<script>
	myFunction();
</script>
<?php
	$array = array(1, 2, 3);
	$map = array('member1' => 'string value', 'member2' => 2345);
	var_dump($array);
	echo '<br>';
	var_dump($map);
?>
</body>
</html>