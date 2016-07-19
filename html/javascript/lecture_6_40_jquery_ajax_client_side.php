<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<header>
<script language="javascript" 
src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>

function buttonClicked() {	 
	$.ajax({ 
		url: 'lecture_6_41_jquery_ajax_server_side.php',
		async: false,
		success: function(result) {
			document.getElementById('result').innerHTML = result;
		},
		error: function(xhr) {
			alert('Error');
		},
		timeout : 3000
	});	
}

</script>
</header>
<body>
<span id="result">결과값은 여기에 나타남</span><br>
<button onclick="buttonClicked();">AJAX로 서버에서 현재시각 가져오기</button>
</body>
</html>