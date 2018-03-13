<?php
include("config.php");
session_start();

$_SESSION["frmDate"]=$_POST["frmDate"];
$_SESSION["toDate"]=$_POST["toDate"];
	header("location:dsr_Week.php");
?>