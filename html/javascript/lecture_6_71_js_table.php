<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
td {
	padding: 5px;
}
</style>
<script>
function insertRow() {
	var table = document.getElementById('mytable');
	var newRow = table.insertRow(1);
	newRow.style.color = 'red';
	newRow.innerHTML = '<td>0</td><td>말씀</td><td>내가 태초다 (알파)</td>';
}
function appendRow() {
	var table = document.getElementById('mytable');
	var newRow = table.insertRow(table.rows.length);
	newRow.style.color = 'orange';
	newRow.innerHTML = '<td>0</td><td>말씀</td><td>내가 말세다 (오메가)</td>';
}
function deleteFirst() {
	var table = document.getElementById('mytable');
	table.deleteRow(1);
}
function deleteLast() {
	var table = document.getElementById('mytable');
	if (table.rows.length === 1) { // th 밖에 없는 상태
		return;
	}
	table.deleteRow(table.rows.length - 1);
}
</script>
</head>
<body>
<div style="width:800px; margin:0 auto; margin-top:100px;">
<button onclick="insertRow();">테이블 맨앞에 줄 추가하기</button><br>
<button onclick="appendRow();">테이블 맨뒤에 줄 추가하기</button><br>
<button onclick="deleteFirst();">테이블에서 첫번째 줄 제거하기</button><br>
<button onclick="deleteLast();">테이블에서 마지막 줄 제거하기</button><br>

<table id="mytable">
	<tr><th>댓글번호</th><th>글쓴이</th><th>내용</th></tr>
	<tr><td>1</td><td>남기웅</td><td>주저리, 주저리</td></tr>
	<tr><td>2</td><td>아놀드</td><td>아임 백</td></tr>
	<tr><td>3</td><td>리암니슨</td><td>I will find you, and I will kill you.</td></tr>
</table>
</div>
</body>
</html>

