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
//error_reporting(0);
session_start();

if (isset($_SESSION["month"])) {
	//
	$dmonth=$_SESSION["month"];
	$dyear=$_SESSION["year"];
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
	<form action="dsr_monthDate.php" method="post" id="myform">
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
	<button name="submit" id="submit" >SUBMIT</button>
	</form>
	<?php
	
	echo "<br>";
	echo "<b>Current Month: $dmonth / Current Year: $dyear </b><br><br>";

	//Start connection
	//SELECT id FROM things  WHERE MONTH(happened_at) = 1 AND YEAR(happened_at) = 2009
	//$sql1 = "SELECT CustomerCode, PostingDate, SKUCode, SUM(Quantity), WareHouseCode FROM dsr_src WHERE MONTH(PostingDate) = $dmonth AND YEAR(PostingDate) = $dyear GROUP BY CustomerCode ";
	$sql1 = "SELECT CustomerCode, PostingDate, DeliveryDate, SKUCode, SUM(Quantity), WareHouseCode FROM dsr_src WHERE MONTH(DeliveryDate) = $dmonth AND YEAR(DeliveryDate) = $dyear GROUP BY SKUCode, CustomerCode ";

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
echo "<BR><b>Daily Sales Report - Month Total</b><BR><BR>";
}

catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</body>
</html>
