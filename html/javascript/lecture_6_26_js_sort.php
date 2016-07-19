<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<body>
<script>
// 문자열 ->어레이: PHP의 explode 기능
var words = ['you', 'apple', 'php', 'PHP', 'javascript', 'Calvin'];
var copy = ['you', 'apple', 'php', 'PHP', 'javascript', 'Calvin'];
words.sort();
copy.sort(function(a, b) { if (a.toUpperCase() < b.toUpperCase()) {return -1} 
else if (a.toUpperCase() == b.toUpperCase()) {return 0} else {return 1} });

</script>

<button onclick="alert('normallySorted is: ' + words);">기본 정렬 결과 보기</button>
<button onclick="alert('sortedByLength is: ' + copy);">단어 길이 순으로 정렬 결과 보기</button>

<script>
// 대소문자를 무시하고, 알파벳 순서로 정렬하려면?
// String.toUpperCase() 를 사용하자
/*if (a.toUpperCase() < b.toUpperCase()) {return -1} 
else if (a.toUpperCase() == b.toUpperCase()) {return 0} else {return 1}*/



// 실제 사전에 단어가 나오는 순서대로 정렬해 보자
// 사전에서 'I' 는 'h'보다 늦게 나오고 'i' 보다 먼저 나와야 한다.





</script>
</body>
</html>