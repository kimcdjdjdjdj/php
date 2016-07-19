<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<header>
<script>
	var some = function alertButtonClicked() {
		alert('alert 클릭됨. 그냥 보고 닫으세요.');
	}
	function confirmButtonClicked() {
		if (confirm('confirm 클릭됨. yes나 no를 선택하시오')) {
			document.getElementById('result').innerHTML = 'confirm 에서 yes가 클릭되었음';
		} else {
			document.getElementById('result').innerHTML = 'confirm 에서 no가 클릭되었음';
		}
	}
	function promptButtonClicked() {
		var input = prompt('prompt 클릭됨', '값을 입력해 주세요');
		document.getElementById('result').innerHTML = input;
	}
</script>
</header>
<body>
<span id="result">결과값은 여기에 나타남</span><br>
<button onclick="some();">Alert버튼</button>
<button onclick="confirmButtonClicked();">Comfirm버튼</button>
<button onclick="promptButtonClicked();">Prompt버튼</button>
<script>
document.getElementById('result').onmouseover = function() {this.style.color="red";};
document.getElementById('result').onmouseleave = function() {this.style.color="black";};
</script>
</body>
</html>