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
echo "<BR><b>Daily Sales Report - All data view</b><BR><BR>";
echo "</span>";

$rowcounter=1;

try {
	
	echo "<br>";
	//Start connection
	//SELECT id FROM things  WHERE MONTH(happened_at) = 1 AND YEAR(happened_at) = 2009
	$sql1 = "SELECT * FROM dsr_src ORDER BY PostingDate ";

	$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
		
		echo "<span style='font-size: 15pt'>";
		echo "<table style='border:4px solid black; width: 100%'>";
		//#	CustomerCode	PostingDate	DeliveryDate	DocumentDate	SKUCode	Quantity	WareHouseCode

		echo "<tr><th>#</th><th>CustomerCode</th><th>PostingDate</th><th>DeliveryDate</th><th>DocumentDate</th><th>SKUCode</th><th>Quantity</th><th>WareHouseCode</th><th>Remarks</th><th>Source File</th></tr>";
		echo "</span>";
		
		while($row = $result1->fetch_assoc()) {
	
			echo "<tr>";
			echo "<td>".$rowcounter."</td>";
			echo "<td>".$row["CustomerCode"]."</td>";
			echo "<td>".$row["PostingDate"]."</td>";
			echo "<td>".$row["DeliveryDate"]."</td>";
			echo "<td>".$row["DocumentDate"]."</td>";
			echo "<td>".$row["SKUCode"]."</td>";
			echo "<td>".$row["Quantity"]."</td>";
			echo "<td>".$row["WareHouseCode"]."</td>";
			echo "<td>".$row["Remarks"]."</td>";
			echo "<td>".$row["sourceData"]."</td>";
			echo "</tr>";
			$rowcounter=$rowcounter+1;
			
		}
	
	echo "</table>";
	echo "</center>";
		
	} else {
		echo "<BR>No results<BR>";
	}

}

catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</body>
</html>
