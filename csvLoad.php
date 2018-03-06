<!DOCTYPE html>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "1000";
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
echo date("m/d/Y H:i:s");
echo "<BR><BR>";
echo "</span>";

$rowcounter=1;

try {

	//Start connection
	/*
	$sql1 = "SELECT * FROM `data_src`";

	$result1 = $conn->query($sql1);

	if ($result1->num_rows > 0) {
		
		echo "<span style='font-size: 15pt'>";
		echo "<table style='border:4px solid black; width: 100%'>";
		//echo "<font size='30'>";
		echo "<tr><th>#</th><th>Item No.</th><th>Item Description</th><th>Price List</th><th>Discount</th><th>Price after Discount</th><th>Auto</th><th>Item group</th></tr>";
		echo "</span>";
		
	
	echo "</table>";
	echo "</center>";
		
	} else {
		echo "No results";
}
*/

//$fileName = "D:/xampp/htdocs/sucat/1.csv";

//$query = "LOAD DATA INFILE '$fileName' INTO TABLE dummy_data (num,CustomerCode,PostingDate,DeliveryDate,DocumentDate,SKUCode,Quantity,WareHouseCode,Remarks), FIELDS TERMINATED BY ',', IGNORE 1 LINES LINES TERMINATED BY '\r\n'  ";
//$query = "LOAD DATA INFILE '$fileName' INTO TABLE dsr_src FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES (num1, CustomerCode, @PostingDate, @DeliveryDate, @DocumentDate, SKUCode, Quantity, WareHouseCode, Remarks) set PostingDate = str_to_date(@PostingDate, '%m/%d/%Y'),  DeliveryDate = str_to_date(@DeliveryDate, '%d/%m/%Y'), DocumentDate = str_to_date(@DocumentDate, '%d/%m/%Y')";

for ($type = 1; $type <= 4; $type++) {
	
	if ($type=='1') {
		$catType="HL";
	} else if ($type=='2') {
		$catType="HMU";
	} else if ($type=='3') {
		$catType="PTX";
	} else if ($type=='4') {
		$catType="WB";
	} else {
	//
	}

	for ($x = 1; $x <= 30; $x++) {
		
		$fileName = "D:/xampp/htdocs/sucat/".$catType."/".$x.".csv";
		
		$query = "LOAD DATA INFILE '$fileName' INTO TABLE dsr_src FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES (num1, CustomerCode, @PostingDate, @DeliveryDate, @DocumentDate, SKUCode, Quantity, WareHouseCode, Remarks) set PostingDate = str_to_date(@PostingDate, '%m/%d/%Y'),  DeliveryDate = str_to_date(@DeliveryDate, '%d/%m/%Y'), DocumentDate = str_to_date(@DocumentDate, '%d/%m/%Y')";
		
		$conn->query($query);
		echo $fileName." done!<BR>";
	} 

}



echo "<BR><b>CSV uploader</b><BR><BR>";
}

catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</body>
</html>
