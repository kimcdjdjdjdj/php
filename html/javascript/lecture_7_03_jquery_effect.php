<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(){
        //alert('button clicked');
    });
	
    $("#button1").click(function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
    });
	
	$("#button2").click(function(){
        $("#div1").fadeOut();
        $("#div2").fadeOut("slow");
        $("#div3").fadeOut(3000);
    });
	
	$("#button3").click(function(){
        $("#div1").fadeToggle();
        $("#div2").fadeToggle("slow");
        $("#div3").fadeToggle(3000);
    });
	
	$("#reset").click(function(){
        $("#div1").css('display', 'none');
        $("#div2").css('display', 'none');
        $("#div3").css('display', 'none');
    });
});
</script>
</head>
<body>

<p>fadeIn </p>

<button id="button1">Click to fade in boxes</button><br><br>
<button id="button2">Click to fade out boxes</button><br><br>
<button id="button3">Click to fade toggle boxes</button><br><br>
<button id="reset">Reset boxes</button><br><br>

<div id="div0" style="width:80px;height:80px;display:none;background-color:black;"></div><br>
<div id="div1" style="width:80px;height:80px;display:none;background-color:red;"></div><br>
<div id="div2" style="width:80px;height:80px;display:none;background-color:green;"></div><br>
<div id="div3" style="width:80px;height:80px;display:none;background-color:blue;"></div>

</body>
</html>

