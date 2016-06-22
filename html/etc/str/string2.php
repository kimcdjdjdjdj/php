<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<?php
	$file_name = 'dictionary.txt';
	
	echo $file_name;
	echo '<br>';
	$file_handle = fopen($file_name, 'r');
	if (!$file_handle) {
		die('file could not be opened!');
	}
	while (true) {
		// fgets는 파일의 다음 한 줄을 읽어서 그 문자열을 리턴한다.
		// 만약 더 이상 읽을 라인이 없다면, false 을 리턴한다.
		$line = fgets($file_handle);
		if ($line === false) {
			break;
		}
		$wordAndRank = explode("\t", $line);
		if (count($wordAndRank) === 2) {
			$word = $wordAndRank[0];
			$rank = intval($wordAndRank[1]);
		} else { // error
			die('count was'.count($wordAndRank).' Error occured!');
		}
		echo '단어: '.$word.' 순위: '.$rank,'<br>';
		
	}
	echo 'END';
	fclose($file_handle);
?>
</body>
</html>