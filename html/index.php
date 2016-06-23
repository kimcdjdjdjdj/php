<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<style type="text/css">

.wrap {margin:0 auto; width:70%; margin-top:50px;}
.list {float:right; margin-right:130px;}
table {width:100%; border:1px solid #FFFFFF;
	border-collapse:collapse;margin-top:50px;}
td, th {border-bottom:1px solid #000; padding:20px;
	text-align:center;}
.bo {margin:0 auto; width:70%;}
a {text-decoration:none;}
a:link {color:red;}
a:visited {color:red;}
a:hover {color:blue;}

</style>

<body class="bo">

<div class="wrap">

<?php
// phpinfo();
//date_default_timezone_set('Asia/Seoul');
echo date("l jS \of F Y h:i:s A")."<br>";
 ?>
 
<h1>네이버에 오신 걸 환영합니다.</h1>

<p>
여기가 하나의 문단
<b>강조하고싶다</b>
</p>
문단이 끝나고 나서는 여기<br><br>
<?php
echo 'PHP 뒷부분<br>';
?>
<div class="list">
<table>
<tr>
<th>과제명</th><th>단계</th><th>주제</th>
</tr>
<tr>
<td rowspan="3">게시판</td>
<td>1</td>
<td><a href="board/01_file/index.php">파일</a></td>
</tr>
<tr>
<td>2</td>
<td><a href="board/02_db/index_db.php">db</a></td>
</tr>
<tr>
<td>3</td>
<td><a href="board/02_db/fk/index_db_fk.php">db_fk</a></td>
</tr>
<tr>
<td rowspan="1">사전 검색</td>
<td>1</td>
<td><a href="dictionary/01_file/search.php">검색</a></td>
</tr>
<tr>
<td rowspan="1">보안</td>
<td>1</td>
<td><a href="security/security_01_session/index.php">검색</a></td>
</tr>
</div>
</table>
</div>
</body>
</html>
