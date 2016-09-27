<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
	<h1>PHP</h1>
	<h2>1</h2>
	<ul>
		<li>문자열타입의 값 '' : <?php echo var_dump(boolval('')); ?></li>
		<li>문자열타입의 값 '0' : <?php echo var_dump(boolval('0')); ?></li>
		<li>문자열타입의 값 '00' : <?php echo var_dump(boolval('00')); ?></li>
		<li>문자열타입의 값 'false' : <?php echo var_dump(boolval('false')); ?></li>
		<li>정수타입의 값 1 : <?php echo var_dump(boolval(1)); ?></li>
		<li>정수열타입의 값 0 : <?php echo var_dump(boolval(0)); ?></li>
		<li>어레이타입의 값 array() : <?php echo var_dump(boolval([])); ?></li>
		<li>어레이타입의 값 array(false) : <?php echo var_dump(boolval([false])); ?></li>
		<li>어레이타입의 값 array('false') : <?php echo var_dump(boolval(['false'])); ?></li>
	</ul>
	
	<h2>2</h2>
	<?php 
		$x = 5;
		
		echo '$x';
		echo '<br>';
		echo "$x";
	?>

	<h2>3</h2>
	
	<?php
		$a = array('애플', '삼성', 'LG');
		
		echo implode('과 ', $a);
	?>
	
	<h2>4</h2>
	
	<?php
		function a($input = 'I love ') {
			echo $input;
		}
		
		a();
		a('PHP.');
	?>
	
	<h2>5</h2>
	
	<?php
		$pi = 3.14149265;
		echo round($pi, 2);
	?>
	
	<h2>6</h2>
	<?php
		function is_suffix($a, $b) {
			$suffix_length = strlen($a);
			$check_string = substr($b, -$suffix_length);
			if ($a === $check_string) {
				return true;
			} else {
				return false;
			}
		}
		
		$a = 'od';
		echo 'A는 '.$a.'<br>';
		$b = 'food';
		echo 'B는 '.$b.'<br>';
		echo var_dump(is_suffix($a, $b));
	?>
	
	<h2>7</h2>
	<?php
		$c = array('name'=>'Calvin', 'age'=>34, 'sex'=>'male');
		
		$result = ksort($c);
		echo var_dump($result).'<br>';
		echo implode(', ', $c).'<br>';
		
		$result = asort($c);
		echo var_dump($result).'<br>';
		echo implode(', ', $c).'<br>';
	?>
	
	<h2>8</h2>
	<?php
		function factorial($number) {
			for($i = $number - 1; $i > 0; $i--) {
				$number *= $i;
			}
			return $number;
		}
		
		$a = 5;
		echo $a.'<br>';
		echo factorial($a);
	?>
	
	<h2>9</h2>
	<?php
		function average($number) {
			$number_count = count($number);
			$result = 0;
			for ($i = 0; $i < $number_count; $i++) {
				$result += $number[$i];
			}
			return $result / $number_count;
		}
		
		$a = array (1, 2, 3);
		print_r($a);
		echo '<br>';
		echo average($a);
	?>
	
	<h2>10</h2>
	<?php
		$number = array();
		for ($i = 0; $i < 101; $i++) {
			if ($i % 3 === 1){
				$number[] = $i;
			}
		}
		print_r($number);
		echo '<br>';
		
		$result = 0;		
		for ($j = 0; $j < count($number); $j++){
			$result += $number[$j];
		}
		
		echo $result;
	?>
	
	<h1>Java Script</h1>
	<h2>1</h2>
	<script>
		var aa = ['애플', '삼성', 'LG'];
		var bb = aa.join('과 ');
		var cc = bb.split('과 ')
		document.write(aa, '<br>');
		document.write(bb, '<br>');
		document.write(cc, '<br>');
	</script>
	
	<h2>2</h2>
	<span>document.getElementById('user_password')</span><br>
	<span>document.getElementByClassName('my_class')</span>

	<h2>3</h2>
	<script>
		var a = 1;
		var b = 2;
		function myFunc() {
			a = 5;
			var b = 5;
			var c = 5;
			d = 5;
		}
		
		myFunc();
		document.write(a, '<br>');
		document.write(b, '<br>');
		document.write(c, '<br>');
		document.write(d, '<br>');
	</script>
</html>