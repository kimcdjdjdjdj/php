<?php
	$text = '<span id = "id_score">150</span>';
	$pattern = '/\s+=\s+/';
	$replacement = '=';
	$result = htmlspecialchars(preg_replace($pattern, $replacement, $text));
	echo $result;
	echo '<br>';
	
	$text = 'a13bc';
	$pattern = '/[^0-9]/';
	$replacement = '';
	$result = htmlspecialchars(preg_replace($pattern, $replacement, $text));
	echo $result;
	echo '<br>';
	
	$text = '<span id = "id_score">150</span>';
	$pattern = '/id\s*=\s*[\'\"](\w+)[\'\"]/';
	$result = array();
	$result2 = htmlspecialchars(preg_match($pattern, $text, $result));
	echo $result[0];
	echo '<br>';
	echo $result[1];
	echo '<br>';
	
?>
<html>
	<textarea id="result" rows="20" cols="60"></textarea>
</html>
<script>
	var text = '<span id = "id_score">150</span>';
	var pattern = /\s+=\s+/;
	var replacement = '=';
	var result = text.replace(pattern, replacement);
	//document.write(result);
	//alert(result);
	document.getElementById('result').value = result;
	document.write('<br>');
	
	pattern = /id\s*=\s*['"](\w+)['"]/;
	var result = text.match(pattern);
	document.write(result[0]);
	document.write('<br>');
	document.write(result[1]);
	document.write('<br>');
	document.getElementById('result').value += '\n' + result[0];
	document.getElementById('result').value += '\n' + result[1];
</script>
