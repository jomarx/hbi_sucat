<?php


//error_reporting(0);
include("config.php");
session_start();
//TRUNCATE `dsr_src`
	
$clearDb = "TRUNCATE TABLE `dsr_src`";
$conn->query($clearDb);

if (!$conn->query($clearDb)) {
	echo "<b>Error: </b>", $conn->error;
	echo "<BR><BR>";
} else {
	//echo " Database clear done!<BR><BR>";
}
$_SESSION["whcode"]="NA";
$_SESSION["dbclr"]='1';

?>
<script>
	window.location.replace("csvLoad.php");
</script>
