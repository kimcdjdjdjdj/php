<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
echo '<h1>PHP</h1>';
echo '<h2>1</h2>';
function num ($a, $b) {
	if ($a > $b){
		return 'true';
	} else {
		return 'false';
	}
}
echo num(2, 3);
echo '<br>';
 
echo '<h2>5</h2>';
$word = 'student';
echo var_dump(strlen($word));
echo '<br>';
echo var_dump(substr($word, 1));
echo '<br>';
echo var_dump(substr($word, 1, 2));
echo '<br>';
echo var_dump(strpos($word, 'de'));
echo '<br>';
echo var_dump(explode('d', $word));
echo '<br>';
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style2.css">
	</head>
	<h1>HTML</h1>
	<h2>2</h2>
	<span id="submit_button">ddd</span>
</html>
<script>
	document.getElementById('submit_button').style.fontSize = '16px';
</script>
	<h1>JAVA</h1>
	<h2>4</h2>
<script>
	var word = 'Apple';
	var numbers = [1, 2, 3];
	var result = '문자열 길이: ' + word.length + ' 어레이길이: ' + numbers.length;
	document.write(result);
	document.write('<br>');
</script>	

