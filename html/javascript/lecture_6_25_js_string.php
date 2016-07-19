<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<script>
// 문자열 -> 어레이: PHP의 explode 기능
var word = 'apple';
var charArray = word.split(''); // 인자에는 구분자를 넣는다

// 어레이 -> 문자열: PHP의 implode 기능
var newWord = ['y', 'o', 'u'].join(''); // 인자에는 접착제를 넣는다
</script>

<button onclick="alert('charArray is: ' + charArray);">문자열 -> 어레이 결과</button>
<button onclick="alert('newWord is: ' + newWord);">어레이 -> 문자열 결과</button>
</body>
</html>