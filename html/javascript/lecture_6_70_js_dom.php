<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
li {
	margin:10px;
}
</style>
<script>
var count = 0; //전역 변수

function createAndAppend() {
	var newNode = document.createElement('li'); // <li> </li>
	newNode.innerHTML = '새롭게 만들어진 아이템 ' + count.toString();
	count++;
	var parentNode = document.getElementById('list');
	parentNode.appendChild(newNode);
}
function move() {
	var parentNode = document.getElementById('list');
	var childrenArray = parentNode.children;
	var lastNode = childrenArray[childrenArray.length - 1];
	var siblingNode = document.getElementById('item3');	
	parentNode.insertBefore(lastNode, siblingNode);
}
function clone() {
	var parentNode = document.getElementById('list');
	var node = document.getElementById('item1');
	var clonedNode = node.cloneNode(true); // deep copy <=> false
	clonedNode.style.color = "blue";
	insertAfter(clonedNode, node);
}

function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
</script>
</head>
<body>
<div style="width:800px; margin:0 auto; margin-top:100px;">
<button onclick="createAndAppend();">새로운 요소 생성해서 맨뒤에 붙이기</button><br>
<button onclick="move();">맨뒤의 요소를 세번째 아이템 앞으로 이동하기</button><br>
<button onclick="clone();">요소 복제하기</button><br>
<ul id="list">
	<li id="item1">첫번째 아이템
		<ol>
			<li id="detail-a">세부항목 A</li>
			<li id="detail-b">세부항목 B</li>		
		</ol>
	</li>
	<li id="item2" style="color:red;">두번째 아이템</li>
	<li id="item3" style="color:orange;">세번째 아이템</li>
</ul>
</div>
</body>
</html>

