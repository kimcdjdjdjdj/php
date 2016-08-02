<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>

<script language="javascript" src="/jquery/jquery-1.11.2.js"></script>
<script language="javascript" src="/jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="/jquery/jquery-ui.css" />

<script>
$(document).ready(function(){
    $("#autocomplete-input").autocomplete({
        source: getAutocompleteSource($("#autocomplete-input").val()),
		minLength: 1,
		search: function(){
			$("#autocomplete-input").val();
			$("#autocomplete-input").autocomplete('option', 'source',
			getAutocompleteSource($("#autocomplete-input").val()));
		},
		delay: 5
	});

	function getAutocompleteSource(userInput) {
		var source = '';
		$.ajax({
			url: 'autocomplete.php',
			async: false,
			data: {input: userInput},
			dataType: 'json',
			success: function(result){
				//alert(result);
				source = result;
			},

			error: function(xhr){
				alert('Error');
			}
		});
		return source;
	}
});
</script>
</head>
<body>

<div style="margin-left:500px;">
<p>자동완성이 되는 입력 창입니다 </p>
<input type="text" id="autocomplete-input">
</div>

</body>
</html>