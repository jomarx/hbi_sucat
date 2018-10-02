<html>
<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/submit.js"></script>
</head>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "3600";
include("config.php");
session_start();
error_reporting(0);

?>
<body>
<b><center><br><img src="hb.jpg"><br>
<p> Hanesbrands Philippines Inc<br><br><br>Daily Sales Report Database<br></p>
<BR><a href="csvLoad.php">CSV Loader</a><BR><BR>
<BR><a href="csvView.php">CSV ALL Viewer</a><BR><BR>
<BR><a href="dsr_month.php">DSR Monthly Generator</a><BR><BR>
<BR><a href="dsr_monthPerCat.php">DSR Monthly - Per Category Generator</a><BR><BR>
<BR><a href="dsr_Week.php">DSR Weekly / Custom Generator</a><BR><BR>

<br>
<br>

<script>
$('#myform').submit(function(){
 return false;
});
 
$('#submit').click(function(){


 $.post( 
 $('#myform').attr('action'),
 $('#myform :input').serializeArray(),
 function(result){
 $('#result1').html(result);
 $('#myform')[0].reset();
 }
 );

});

</script>
</form>
<font color="red">
<div id="result1"></div>
</font></center></b>
</body>
</html>
