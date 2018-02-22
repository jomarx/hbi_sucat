<!DOCTYPE html>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
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
echo "<center>";
echo "<span style='font-size: 25pt'>";
//echo date("m/d/Y H:i:s");
//echo "<BR><b>Mechanic Status</b><BR><BR>";
echo "</span>";

$rowcounter=1;
//$discountedCost=499.75;
$vat=1.12;

try {

	//Start connection
	
	$sql1 = "SELECT * FROM `data_src`";

	$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
		
		echo "<span style='font-size: 15pt'>";
		echo "<table style='border:4px solid black; width: 100%'>";
		//echo "<font size='30'>";
		echo "<tr><th>#</th><th>Item No.</th><th>Item Description</th><th>Price List</th><th>Discount</th><th>Price after Discount</th><th>Auto</th><th>Item group</th></tr>";
		echo "</span>";
		
		while($row1 = $result1->fetch_assoc()) {
			
			$discountedCost=$row1["promo_price"];
			$style1=$row1["style"];
	
			$sql = "SELECT ItemDescription,ItemCode,Category,RMLCost FROM itemasterfile WHERE SBTCode LIKE '%$style1%'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				
				// output data of each row
				while($row = $result->fetch_assoc()) {
					
					$rmlcosting=$row["RMLCost"];
					$consprice=$rmlcosting*$vat;
					$finprc=((($discountedCost/$consprice)-1)*-1);
					$finprc2=$rmlcosting-($rmlcosting*$finprc);
					
					echo "<tr>";
					echo "<td>".$rowcounter."</td>";
					echo "<td>".$row["ItemCode"]."</td>";
					echo "<td>".$row["ItemDescription"]."</td>";
					echo "<td>"."RML"."</td>";
					//echo "<td>".$row["RMLCost"]."</td>";
					$finprc3=$finprc*100;
					echo "<td>".(number_format($finprc3,2))."</td>";
					echo "<td>".(number_format($finprc2,4))."</td>";
					echo "<td>"."Y"."</td>";
					echo "<td>".$row["Category"]."</td>";
					echo "</tr>";
					$rowcounter=$rowcounter+1;
					
				}
			}
		}
	
	echo "</table>";
	echo "</center>";
		
	} else {
		echo "No results";
}
echo "<BR><b>Automated Promo Pricing</b><BR><BR>";
}

catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</body>
</html>
