<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<header>
<script>
	var array = ['a', 'b', 'c']; // 어레이 (특별한 객체)
	var person = { name: 'Calvin', age: 34 }; // 일반 객체
	
	var sentence = '';
	
	// 언제나 믿을만한 최고의 방법
	for (var i = 0; i < array.length; i++) {
		sentence = sentence + array[i] + ' ';
	}
	document.write('어레이 출력: ' + sentence, '<br>');
	sentence = '';
	
	// for...of 문으로 좀 더 간단히 어레이를 사용 가능하다
	for (var value of array) { 
		sentence = sentence + value + ' ';
	}
	document.write('어레이 출력: ' + sentence, '<br>');
	sentence = '';
	
	// for...in 문은 foreach ($key => $value) 에서 key만 사용하는 상황
	for (var property in person) { 
		sentence = sentence + property + ': ' + person[property] + ' ';
	}
	document.write('객체 출력: ' + sentence, '<br>');	
	sentence = '';
	
	// 어레이도 특별한 객체이므로, 내부에는 key (정수 인덱스) 가 있다
	for (var index in array) { 
		sentence = sentence + array[index] + ' ';
	}
	document.write(sentence, '<br>');
	sentence = '';
	
	// for...in 문과 for...of 문을 혼동하면 안된다
	for (var value in array) { 
		sentence = sentence + value + ' ';
	}
	document.write(sentence, '<br>');
</script>
</body>
</html>