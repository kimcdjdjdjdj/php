<html>
<head>
<script>
	var words = [];
	function bt_click() {
		var word = document.getElementById('word_input').value;
		words.push(word);
		words.sort();
		var newWords = words.join('<br>');
		document.getElementById('result').innerHTML = newWords
	}	
</script>
</head>
<body>
<span id="result">결과값은 여기에 나타남</span><br>	
	<input id="word_input" type="text" name="word">
	<button onclick="bt_click();">입력</button>
</body>	
</html>