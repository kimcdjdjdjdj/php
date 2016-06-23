<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<style type="text/css">

.wrap {margin:0 auto; width:50%; margin-top:50px;}
table {width:100%; border:1px solid #AFEEEE;
	border-collapse:collapse;}
th {background:#AFEEEE; width:20%;}
td {background:#E0FFFF;}
td, th {border:1px solid #000000; padding:10px;}
input, textarea {border:1px solid #000000;}
input {padding:7px;}
.submit_btn {float:right; margin-top:15px; background:#AFEEEE;
	color:#000;}
.bo {margin:0 auto; width:70%;}

</style>

<body class="bo">

<div class="wrap">

<table>
<h1>나의 게시판</h1>
	
	<form action = "write_processes_db.php" method = "post">		
		
			<tr>
			<th>제목</th>
			<td><input type="text" name="title"></td>
			</tr>
			<tr>
			<th>글쓴이</th>
			<td><input type="text" name="writer"></td>
			</tr>
			<tr>
			<th>내용</th>
			<td><textarea type="text" name="comment" rows="10" cols="100%"></textarea></td>
			</tr>	
			</table>
		<input class="submit_btn" type="submit" value="제출">		
	</form>
	
</div>	
</body>	
</html>