<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
#timer {
	display: block; 
	width: 800px; 
	margin:0 auto; 
	margin-top: 100px; 
	font-size:100px	;
	text-align: center;
}
</style>
<script>
	setTimeout(function(){ document.getElementById('timer').innerHTML = 'Time Out!'; }, 3000);

</script>
</head>
<body>
	<span id="timer">Waiting...</span>
</body>
</html>