<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<header>
<script>
	function buttonClicked() {
		var myObject = { name: 'Calvin', age: 32 };
		document.getElementById('result').innerHTML = 'My name is ' + myObject.name + '. I am ' + myObject.age + ' years old'
	}
	
	function Person(name, age) {
		this.name = name;
		this.age = age;		
		this.introduce = function() { return 'My name is ' + this.name + '. I am ' + this.age + ' years old'; };
	}
	
	function buttonClicked2() {
		var calvin = new Person('kim22', 29);
		document.getElementById('result2').innerHTML = calvin['introduce']();
	}
</script>
</header>
<body>
<span id="result">결과값은 여기에 나타남</span><br>
<span id="result2">결과값은 여기에 나타남</span><br>
<button onclick="buttonClicked();">map으로 생성된 객체의 내용 보기</button><br>
<button onclick="buttonClicked2();">함수 정의로 생성된 객체의 내용 보기</button>
</body>
</html>