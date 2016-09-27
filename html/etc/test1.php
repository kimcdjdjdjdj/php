<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
table {width:50%; border:1px solid #000000;
	border-collapse:collapse;}
th, td {border:1px solid #000000; padding:10px; text-align:center;}
.p {font-weight:bold;}
</style>
<?php 

?>
</head>
<h1>타입 전환 테이블</h1>
<table>
<tr>
<th></th><th>정수타입</th><th>float타입</th><th>문자열타입</th><th>논리타입</th><th>어레이</th><th>?</th>
</tr>
<tr>
<td>예시값</td><td>0, 1</td><td>0.0, 1.9</td><td>'', '0', '0.0', '1.9'</td><td>true, false</td><td>[], ['a']</td><td>null</td>
</tr>
<tr>
<td>TO.정수타입</td><td class="p">N/A</td><td><?php var_dump(intval(0.0));?><br><?php var_dump(intval(1.9));?></td><td><?php var_dump(intval(''));?><br><?php var_dump(intval('0'));?><br><?php var_dump(intval('0'));?><br><?php var_dump(intval('1.9'));?></td><td><?php var_dump(intval(true));?><br><?php var_dump(intval(false));?></td><td><?php var_dump(intval([]));?><br><?php var_dump(intval(['a']));?></td><td><?php var_dump(intval(null));?></td>
</tr>
<tr>
<td>TO.float타입</td><td><?php var_dump(floatval(0));?><br><?php var_dump(floatval(1));?></td><td class="p">N/A</td><td><?php var_dump(floatval(''));?><br><?php var_dump(floatval('0'));?><br><?php var_dump(floatval('0.0'));?><br><?php var_dump(floatval('1.9'));?></td><td><?php var_dump(floatval(true));?><br><?php var_dump(floatval(false));?></td><td><?php var_dump(floatval([]));?><br><?php var_dump(floatval(['a']));?></td><td><?php var_dump(floatval(null));?></td>
</tr>
<tr>
<td>TO.문자열타입</td><td><?php var_dump(strval(0));?><br><?php var_dump(strval(1));?></td><td><?php var_dump(strval(0.0));?><br><?php var_dump(strval(1.9));?></td><td class="p">N/A</td><td><?php var_dump(strval(true));?><br><?php var_dump(strval(false));?></td><td>X</td><td><?php var_dump(strval(null));?></td>
</tr>
<tr>
<td>TO.논리타입</td><td><?php var_dump(boolval(0));?><br><?php var_dump(boolval(1));?></td><td><?php var_dump(boolval(0.0));?><br><?php var_dump(boolval(1.9));?></td><td><?php var_dump(boolval(''));?><br><?php var_dump(boolval('0'));?><br><?php var_dump(boolval('0.0'));?><br><?php var_dump(boolval('1.9'));?></td><td class="p">N/A</td><td><?php var_dump(boolval([]));?><br><?php var_dump(boolval(['a']));?></td><td><?php var_dump(boolval(null));?></td>
</tr>
</table>
<h2>반복 테이블 </h2>
<?php
$types = array('intval', 'floatval', 'strval', 'boolval');
$values = array(0, 1, 0.0, 1.9, '', '0', '0.0', '1.9', true, false, [], ['a'], null);
$strvalues = array('0', '1', '0.0', '1.9', '\'\'', '0', '0.0', '1.9', 'true', 'false', '[]', '[\'a\']', 'null');
	echo '<table>';
	echo '<tr><th></th><th colspan="2">정수타입</th><th colspan="2">float타입</th><th colspan="4">문자열타입</th><th colspan="2">논리타입</th><th colspan="2">어레이</th><th>?</th></tr>';
	echo '<tr><td>예시값</td>';
	for ($s=0; $s<count($strvalues); $s++){
		echo '<td>';
		echo strval($strvalues[$s]);
		echo '</td>';
	}
	echo '</tr>';
	for($i=0; $i<count($types); $i++){
		echo '<tr>';
		for($j=0; $j<count($values); $j++){
			if ($j === 0){
				echo '<td>';
				echo $types[$i];
				echo '</td>';
			}
			echo '<td>';
			var_dump(call_user_func($types[$i], $values[$j]));
			echo '</td>';
		}
		echo '</tr>';
	}
	echo '</table>';
?>
</html>