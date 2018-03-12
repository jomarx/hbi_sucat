<!DOCTYPE html>

<?php
$page = $_SERVER['PHP_SELF'];
$sec = "1000";

/*
removed refresh code
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
*/
//https://stackoverflow.com/questions/535020/tracking-the-script-execution-time-in-php

//place this before any script you want to calculate time
$time_start = microtime(true); 

?>
<html>
    <head>
    
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
session_start();

echo "<center>";
echo "<span style='font-size: 25pt'>";
echo date("m/d/Y H:i:s");
echo "<BR><BR>";
echo "</span>";


if (isset($_SESSION["dbclr"])){
	echo "<p><font color='red'>Database cleared!</font></p>";
	echo "<BR>";
	unset($_SESSION["dbclr"]);
}

?>
<BR><a href="csvDbclear.php">Clear Database</a><BR><BR>
<a href="csvSessionClr.php">Clear Session</a><BR><BR>
<?php

$rowcounter=1;

//$whCode = array("GAACWH","GABGWH","GACAWH","GACMWH","GACOWH","GACTWH","GAGMWH","GAGTWH","GALIWH","GALPWH","GAMCWH","GAMEWH","GAMGWH","GAMIWH","GAMMWH","GAMNWH","GAPRWH","GARBWH","GASCWH","GASIWH","GASMWH","GATAWH","GATBWH");

//echo "Array length : ".count($whCode)."<br>";
//$whCodeLength = count($whCode)."<br>";

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


	$sql = "SELECT COUNT(WHSE_CODE) FROM `wh`";

	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		//
		while($row = $result->fetch_assoc()){ 
			//displays number of stores
			$whCodeLength=$row["COUNT(WHSE_CODE)"];
			echo "<b>Array length : </b>".$whCodeLength."<br>";
		}
	}
	
	?>
	<p><b>Select area to run :</b></p>
	<form action="csvLReport.php" method="post" id="myform">

	<select name="whcode" id="whcode">
	<option value="wala">Select</option>
	<?php
	$sql = "SELECT DISTINCT AREA FROM wh";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		?>
		<option value="<?php echo $row["AREA"] ?>"><?php echo $row["AREA"] ?></option>
		<?php
	}

	?>
	</select>
	<br><br>
	<button name="submit" id="submit" >SUBMIT</button>
	<br><br>
	<?php
	
	$wareCode=$_SESSION["whcode"];
	
	echo "<b>WH code selected: </b>".$wareCode."<br><br>";
	
	//selects WareHouseCode from db
	$sql = "SELECT WHSE_CODE FROM `wh` WHERE AREA = '$wareCode'";

	$result = $conn->query($sql);
	
	if (!$conn->query($sql)) {
		echo "<b>Query Error: </b>", $conn->error;
		echo "<BR><BR>";
	}

	if ($result->num_rows > 0) {
		//http://php.net/manual/en/mysqli-result.num-rows.php
		$row_cnt = $result->num_rows;

		echo "<b>Number of stores : </b>".$row_cnt."<br><br>";
		
		while($row = $result->fetch_assoc()){
			//loop going tru all of the stores
			$frmDbWhCd=$row["WHSE_CODE"];
			//for ($wLength = 1; $wLength < $row_cnt; $wLength++) {
				echo "Current whCode: ".$frmDbWhCd;
				echo "<br><br>";

				for ($type = 1; $type <= 4; $type++) {
					//4 category types
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
					//loop for 1 month
					for ($x = 1; $x <= 31; $x++) {
						
						$fileName = "D:/xampp/htdocs/sucat/data/".$frmDbWhCd."/".$catType."/".$x.".csv";
						//https://stackoverflow.com/questions/11432511/save-csv-files-into-mysql-database/11432767
						
						$query = "LOAD DATA INFILE '$fileName' INTO TABLE dsr_src FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 1 LINES (num1, CustomerCode, @PostingDate, @DeliveryDate, @DocumentDate, SKUCode, Quantity, WareHouseCode, Remarks, @sourceData) set PostingDate = str_to_date(@PostingDate, '%m/%d/%Y'),  DeliveryDate = str_to_date(@DeliveryDate, '%m/%d/%Y'), DocumentDate = str_to_date(@DocumentDate, '%m/%d/%Y'), sourceData = '$fileName'";
						
						//$conn->query($query);
						
						//https://jason.pureconcepts.net/2013/04/common-debugging-php-mysql/
						if (!$conn->query($query)) {
							echo "<b>Error: </b>", $conn->error;
							echo "<BR>";
						} else {
							echo $fileName." done!<BR>";
						}
					} 

				}

			
		}
		//https://stackoverflow.com/questions/7437713/how-to-create-a-pop-up-window-using-php-via-echo
		
		$time_end = microtime(true);

		//dividing with 60 will give the execution time in minutes other wise seconds
		$execution_time = ($time_end - $time_start)/60;

		//execution time of the script
		echo '<b>Total Execution Time:</b> '.number_format((float) $execution_time, 3).' Mins';
		// in you get wierd result, use number_format((float) $execution_time, 10) 
		$execution_time1=number_format((float) $execution_time, 3);
		echo "<script>alert('Success! Total Execution Time: $execution_time1 mins');</script>";
	}

echo "<BR><b>CSV uploader</b><BR><BR>";
//sets option to NA to prevent running again on refresh
$_SESSION["whcode"]="wala";

//session_destroy();
}

catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
?>

</body>
</html>
