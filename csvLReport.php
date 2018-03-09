<?php


//error_reporting(0);
include("config.php");

$whcode=$_POST["whcode"];
session_start();

$_SESSION["whcode"]=$whcode;
?>
<script>
	window.location.replace("csvLoad.php");
</script>
