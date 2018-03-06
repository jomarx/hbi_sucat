<?php
include("config.php");
session_start();

$_SESSION["month"]=$_POST["month"];
$_SESSION["year"]=$_POST["year"];
	header("location:dsr_month.php");
?>