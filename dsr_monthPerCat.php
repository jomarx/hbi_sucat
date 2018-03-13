<!DOCTYPE html>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "100";
?>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
	<style>
	td {
		
		border:1px solid black;
		font-size: 15px	;
	}
		th {
		font-size: 15px	;
		border:1px solid black;
	}

	</style>
<body>

<?php
include("config.php");
error_reporting(0);
session_start();

if (isset($_SESSION["month"])) {
	//
	$dmonth=$_SESSION["month"];
	$dyear=$_SESSION["year"];
	
	$whcode1=$_SESSION["whcode1"];
	$whcode2=$_SESSION["whcode2"];
	$whcode3=$_SESSION["whcode3"];
	$whcode4=$_SESSION["whcode4"];
	$whcode5=$_SESSION["whcode5"];
	$whcode6=$_SESSION["whcode6"];
	$whcode7=$_SESSION["whcode7"];
	$whcode8=$_SESSION["whcode8"];
} else {
	//
	$dmonth=1;
	$dyear=2018;
}

echo "<center>";
echo "<span style='font-size: 25pt'>";
//echo date("m/d/Y H:i:s");
//echo "<BR><b>Mechanic Status</b><BR><BR>";
echo "</span>";

$rowcounter=1;

try {
	
	?>
	<p><b>Select Month / Year :</b></p>
	<form action="dsr_monthPerCatDate.php" method="post" id="myform">
	<select name="month" id="month">
		<option value="999">Month</option>
		<option value="1">Jan</option>
		<option value="2">Feb</option>
		<option value="3">Mar</option>
		<option value="4">Apr</option>
		<option value="5">May</option>
		<option value="6">Jun</option>
		<option value="7">Jul</option>
		<option value="8">Aug</option>
		<option value="9">Sept</option>
		<option value="10">Oct</option>
		<option value="11">Nov</option>
		<option value="12">Dec</option>
	</select>
		<select name="year" id="year">
		<option value="999">Year</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
	</select>
	<br>
	<p><b>Select territory :</b></p>
	
	<select name="whcode1" id="whcode1">
	<option value="999">North Luzon</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='NORTH LUZON' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>
	
	<select name="whcode2" id="whcode2">
	<option value="999">GMA1</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='GMA1' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>
	
	<select name="whcode3" id="whcode3">
	<option value="999">GMA2</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='GMA2' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>
	
	<select name="whcode4" id="whcode4">
	<option value="999">SOUTH LUZON</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='SOUTH LUZON' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>
	
	<select name="whcode5" id="whcode5">
	<option value="999">WESTERN VISAYAS</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='WESTERN VISAYAS' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>
	
	<select name="whcode6" id="whcode6">
	<option value="999">CENTRAL VISAYAS</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='CENTRAL VISAYAS' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>
	
	<select name="whcode7" id="whcode7">
	<option value="999">NORTH MINDANAO</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='NORTH MINDANAO' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>
	
	<select name="whcode8" id="whcode8">
	<option value="999">SOUTH MINDANAO</option>
	<?php
	$sql = "SELECT * FROM `wh` WHERE AREA='SOUTH MINDANAO' ORDER BY `WHSE_CODE` ASC";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
	?>
		<option value="<?php echo $row["WHSE_CODE"] ?>"><?php echo $row["WHSE_CODE"] ?></option>
	<?php
	}
	?>
	</select>

	<br><br>
	<button name="submit" id="submit" >SUBMIT</button>
	</form>
	<?php
	
	echo "<br>";
	echo "<b>Current Month:</b> $dmonth / <b>Current Year:</b> $dyear <br>";
	echo "<b>Current : </b>";
		
	if ($whcode1!='999') {
		echo $whcode1;
	}
	if ($whcode2!='999') {
		echo $whcode2;
	}
	if ($whcode3!='999') {
		echo $whcode3;
	}
	if ($whcode4!='999') {
		echo $whcode4;
	}
	if ($whcode5!='999') {
		echo $whcode5;
	}
	if ($whcode6!='999') {
		echo $whcode6;
	}
	if ($whcode7!='999') {
		echo $whcode7;
	}
	if ($whcode8!='999') {
		echo $whcode8;
	}

	echo "<br><br>";
	
	//Start connection
	//SELECT id FROM things  WHERE MONTH(happened_at) = 1 AND YEAR(happened_at) = 2009
	//$sql1 = "SELECT CustomerCode, PostingDate, SKUCode, SUM(Quantity), WareHouseCode FROM dsr_src WHERE MONTH(PostingDate) = $dmonth AND YEAR(PostingDate) = $dyear GROUP BY CustomerCode ";
	$sql1 = "SELECT CustomerCode, PostingDate, DeliveryDate, SKUCode, SUM(Quantity), WareHouseCode FROM dsr_src WHERE MONTH(DeliveryDate) = $dmonth AND YEAR(DeliveryDate) = $dyear GROUP BY SKUCode AND (WareHouseCode='$whcode1' OR WareHouseCode='$whcode2' OR WareHouseCode='$whcode3' OR WareHouseCode='$whcode4' OR WareHouseCode='$whcode5' OR WareHouseCode='$whcode6' OR WareHouseCode='$whcode7' OR WareHouseCode='$whcode8'), CustomerCode ";

	$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
		
		echo "<span style='font-size: 15pt'>";
		echo "<table style='border:4px solid black; width: 100%'>";
		//#	CustomerCode	PostingDate	DeliveryDate	DocumentDate	SKUCode	Quantity	WareHouseCode

		echo "<tr><th>#</th><th>CustomerCode</th><th>PostingDate</th><th>DeliveryDate</th><th>DocumentDate</th><th>SKUCode</th><th>Quantity</th><th>WareHouseCode</th><th>Remarks</th></tr>";
		echo "</span>";
		
		while($row = $result1->fetch_assoc()) {
	
			echo "<tr>";
			echo "<td>".$rowcounter."</td>";
			echo "<td>".$row["CustomerCode"]."</td>";
			echo "<td>".date("m/d/Y")."</td>";
			$time = strtotime($row["DeliveryDate"]);
			$newformat = date('m/d/Y',$time);
			echo "<td>".$newformat."</td>";
			echo "<td>".date("m/d/Y")."</td>";
			echo "<td>".$row["SKUCode"]."</td>";
			echo "<td>".$row["SUM(Quantity)"]."</td>";
			echo "<td>".$row["WareHouseCode"]."</td>";
			echo "<td>"."Sales for the date of ".$dmonth."/".$dyear."</td>";
			echo "</tr>";
			$rowcounter=$rowcounter+1;
			
		}
	
	echo "</table>";
	echo "</center>";
		
	} else {
		echo "<BR>No results<BR>";
}
echo "<BR><b>Daily Sales Report - Month Total Per Territory</b><BR><BR>";


}

catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</body>
</html>
