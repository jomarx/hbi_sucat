<!DOCTYPE html>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "3600";
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

if (isset($_SESSION["frmDate"])) {
	//
	$frmDate=$_SESSION["frmDate"];
	$toDate=$_SESSION["toDate"];
	$dmonth=1;
	$dyear=2018;
} else {
	//
	$frmDate=date("m/d/Y");
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
	<form action="dsr_WeekDate.php" method="post" id="myform">
		<b>From: </b><input type="date" id="frmDate" name="frmDate"> &nbsp; &nbsp;
		<b>To: </b><input type="date" id="toDate" name="toDate">
	<button name="submit" id="submit" >SUBMIT</button>
	</form>
	<?php
	
	echo "<br>";
	echo "<b>From :</b> $frmDate <b> &nbsp;&nbsp; To :</b> $toDate </b><br><br>";

	//Start connection
	//SELECT id FROM things  WHERE MONTH(happened_at) = 1 AND YEAR(happened_at) = 2009
	//$sql1 = "SELECT CustomerCode, PostingDate, SKUCode, SUM(Quantity), WareHouseCode FROM dsr_src WHERE MONTH(PostingDate) = $dmonth AND YEAR(PostingDate) = $dyear GROUP BY CustomerCode ";
	$sql1 = "SELECT CustomerCode, PostingDate, DeliveryDate, DocumentDate, SKUCode, SUM(Quantity), WareHouseCode FROM dsr_src WHERE  CAST(`PostingDate` AS DATE) BETWEEN '$frmDate' AND '$toDate' GROUP BY SKUCode, CustomerCode ";

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
			
			$time = strtotime($row["PostingDate"]);
			$newformat = date('m/d/Y',$time);
			echo "<td>".$newformat."</td>";
			
			$time1 = strtotime($row["DeliveryDate"]);
			$newformat = date('m/d/Y',$time1);
			echo "<td>".$newformat."</td>";
			
			$time2 = strtotime($row["DocumentDate"]);
			$newformat = date('m/d/Y',$time2);
			echo "<td>".$newformat."</td>";
			
			echo "<td>".$row["SKUCode"]."</td>";
			echo "<td>".$row["SUM(Quantity)"]."</td>";
			echo "<td>".$row["WareHouseCode"]."</td>";
			echo "<td>"."From $frmDate to $toDate"."</td>";
			echo "</tr>";
			$rowcounter=$rowcounter+1;
			
		}
	
	echo "</table>";
	echo "</center>";
		
	} else {
		echo "<BR>No results<BR>";
}
echo "<BR><b>Daily Sales Report - Custom Total</b><BR><BR>";
}

catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</body>
</html>
