<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="/jquery/jquery.js"></script>
<script type="text/javascript" src="/jquery/jquery-ui.js"></script>
<link rel="stylesheet" href="/jquery/themes/base/jquery-ui.css" />

<style>
#toy {
	width: 200px;
	height: 200px;
	border: 1px solid black;
	margin:auto; 
	margin-top:100px;
}

label {
	width: 80px;
	height: 20px;
	font-size: 20px;
	border: 2px solid black;
}
fieldset {
	margin-bottom: 20px;
}
</style>
<script>
$(document).ready(function() {
	$("input").checkboxradio();
	
	$('#execute').click(function() {
		var applyMethod = $('input[name=radio-1]:checked').val();
		var effectType = $('input[name=radio-2]:checked').val();
		//alert(applyMethod);
		//alert(effectType);
		$("#toy" )[applyMethod](effectType);
	});	
});

</script>
</head>
<body>

<div style="width:800px; margin: auto">
<div class="widget" >
<h1 style="margin:50px 0px;">JQuery UI Effect 몸소 체험하기</h1>
<fieldset>
	<legend>이펙트 적용방법을 고르세요: </legend>	
	<label for="radio-1">show</label>
	<input type="radio" name="radio-1" id="radio-1" value="show">
	<label for="radio-2">hide</label>
	<input type="radio" name="radio-1" id="radio-2" value="hide">
	<label for="radio-3">effect</label>
	<input type="radio" name="radio-1" id="radio-3" value="effect">
	<label for="radio-4">toggle</label>
	<input type="radio" name="radio-1" id="radio-4" value="toggle">
</fieldset>
<fieldset>
	<legend>이펙트 종류를 고르세요: </legend>
	<label for="radio-7">blind</label>
	<input type="radio" name="radio-2" id="radio-7" value="blind">
	<label for="radio-8">fold</label>
	<input type="radio" name="radio-2" id="radio-8" value="fold">
	<label for="radio-9">fade</label>
	<input type="radio" name="radio-2" id="radio-9" value="fade">
	<label for="radio-10">scale</label>
	<input type="radio" name="radio-2" id="radio-10" value="scale">
	<label for="radio-11">shake</label>
	<input type="radio" name="radio-2" id="radio-11" value="shake">
	<label for="radio-12">bounce</label>
	<input type="radio" name="radio-2" id="radio-12" value="bounce">
</fieldset>
</div>

<div style="margin:70px 0px;"></div>
<p id="execute" style="border: 2px solid; padding: 20px;text-align:center">
<span><strong >여기를 클릭하면 효과를 체험할 수 있습니당</strong></span>
</p>

<div id="toy"></div>
</div>

</body>
</html>

