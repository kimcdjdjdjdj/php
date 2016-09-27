<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php
var a = "5" + "5";
$a = "5" ;
<span class = "my_class" id = "q1">

	$regex = '/\s+\=\s+(\"\w+\")/';
	$text = '<p                      class = "my_class"id = "02" >ddd< /p >';
	echo '원래 값: '.htmlspecialchars($text).'<br>';	
	$result = preg_replace($regex, '=\1 ', $text);
	echo htmlspecialchars('치환 결과: '.$result);
	echo '<br><br>';
	$result2 = preg_replace('/\<\s+(\/[a-z])\s+\>/', '<\1>', $result);
	echo htmlspecialchars('치환 결과2: '.$result2);
	echo '<br><br>';
	$result3 = preg_replace('/\s+\>/', '>', $result2);
	echo htmlspecialchars('치환 결과3: '.$result3);
	echo '<br><br>';
	$final = preg_replace('/\s+/', ' ', $result3);
	echo htmlspecialchars('파이널: '.$final);
	echo '<br><br>';
	echo "<script>alert('".$final."');</script>";
	
"dk\"sk\"dk"

?>
</body>
</html>

\s+[a-z]+\s*=\s*"[^"]*"(?=\s*[a-z>])
\".[^"]*\\".[^"]*\\".[^"]*\"