<?php
include("config.php");
session_start();

if ($_POST["month"]=='999') {
	
} else {
	//retain session contents
	$_SESSION["month"]=$_POST["month"];
}

if ($_POST["year"]=='999') {
	
} else {
	//retain session contents
	$_SESSION["year"]=$_POST["year"];
}

$_SESSION["whcode1"]=$_POST["whcode1"];
$_SESSION["whcode2"]=$_POST["whcode2"];
$_SESSION["whcode3"]=$_POST["whcode3"];
$_SESSION["whcode4"]=$_POST["whcode4"];
$_SESSION["whcode5"]=$_POST["whcode5"];
$_SESSION["whcode6"]=$_POST["whcode6"];
$_SESSION["whcode7"]=$_POST["whcode7"];
$_SESSION["whcode8"]=$_POST["whcode8"];

	header("location:dsr_monthPerCat.php");
?>