<?php 
  
/* 
parameters:
arg1 = Filteren op naam
arg2 = 0 -> Lokaal , 1 -> Geotags
afst = filteren tot een afstand 
lat = Latitude meegeven
long = longitude meegeven
pow = 0 = uit , 1 = aan
*/


$servername = "localhost";
$username = "root";
$password = "abc123!";
$dbname = "layar";
$schommeling = 0.05;
$error="error:";
$afstand=200;
if(isset($_GET['afst'])){
	$afstand=$_GET['afst'];
}

if(isset($_GET['arg1'])&&isset($_GET['arg2'])) {
	/*$argument1="eeeee";*/
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
    $argument1 = $_GET['arg1'];
	$argument2 = $_GET['arg2'];
	if(isset($_GET['pow'])){
		$power = $_GET['pow'];
		
		// Check connection
		if ($conn->connect_error) {
		   $error.="Connection failed: " . $conn->connect_error;
		} 
		// Check of het toestel aan of uit staat
		$sql = "SELECT * FROM items WHERE name='".$argument1."'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
		//TOESTEL AAN/UIT ZETTEN
		if($row['power'] != $power){
			$sql = "UPDATE items SET power='".$power."' WHERE name='".$argument1."'";
			mysqli_query($conn, $sql);	
		}
	}

// Check connectiony
if ($conn->connect_error) {
   $error.="Connection failed: " . $conn->connect_error;
} 
if ($argument2 == "0")
		$sql = "
		SELECT items.itemID, items.name, items.about, items.value, items.power,items.pin,servers.adres,servers.serveradres FROM items 
		LEFT JOIN servers
		ON items.serverID =servers.serverID
		WHERE name='".$argument1."'";
		else
		$sql = "
		SELECT a.itemID, a.name, a.about, a.value,a.power, b.lat,b.lon 
		FROM items a 
		INNER JOIN poi b ON b.id = a.locID 
		WHERE a.locID>0
	";
		
	
	
	$result = mysqli_query($conn, $sql);
	
	header("Content-type: text/xml"); 
	$xml_output = "<?xml version=\"1.0\"?>\n"; 
	$xml_output .= "<items>\n";
	if (mysqli_num_rows($result) > 0) {
		
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$vafstand="";
			$check=0;
			if (isset($_GET['lat'])&&isset($_GET['lon'])){
				
				$vafstand = haversineGreatCircleDistance(
					 $argument3=$_GET['lat'],
					 $argument4=$_GET['lon'],
					 $row["lat"],
					 $row["lon"]);
					 if ($vafstand < $afstand)
					 $check=1;
			}
			else
			$check=1;
			
			if ($check==1)
			{	
			
			
			$xml_output .= "<item>\n";
			$afwijking=($row["value"] * $schommeling);
			$value = rand($row["value"]-$afwijking, $row["value"]+$afwijking) ;
			printName("id",$row["itemID"]);
			printName("name",$row["name"]);
			printName("about",$row["about"]);
			if (is_null($row["adres"]) or is_null($row["pin"])){
				
				printName("value",$value);
				printName("power",$row["power"]);
			}else {
				$url="http://".$row["serveradres"]."/?adr=".$row["adres"]."&pin=".$row["pin"];
				if ($_GET['pow']=="1" or $_GET['pow']=="0"){
					$url.="&status=".$_GET['pow'];
				}
				
				if (($response_xml_data = file_get_contents($url))===false){
					printName("error","Error fetching XML");
				} else {
				   libxml_use_internal_errors(true);
				   $data = simplexml_load_string($response_xml_data);
				   if (!$data) {
					   $xmlerror="Error loading XML";
					   foreach(libxml_get_errors() as $error) {
						   $xmlerror.= "\t".$error->message;
					   }
					   printName("error",$xmlerror);
				   } else {
					  //print_r($data);
					  $value = (string) $data->waarde;
					  $status = (string) $data->status;
					  printName('value',$value);
					  printName('power',$status);
				   }
				}
			}
			
			if ($argument2 != "0"){
				$lat2=$row["lat"];$lon2=$row["lon"];
				printName("lon",$lon2);
				printName("lat",$lat2);
				
				if (isset($_GET['lat'])&&isset($_GET['lon'])){
					$lat1=$_GET['lat'];$lon1=$_GET['lon'];
					printName("distance",$vafstand);
					$bearing = (rad2deg(atan2(
					sin(deg2rad($lon2) - deg2rad($lon1)) * cos(deg2rad($lat2)), 
					cos(deg2rad($lat1)) * sin(deg2rad($lat2)) - sin(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(											 				deg2rad($lon2) - deg2rad($lon1))
					)) + 360) % 360;
					printName("bearing",$bearing);
				}
				}
			$xml_output .= "</item>\n";
			}
		}
	} else {
		$xml_output .=  "wrong value!";
	}
	$xml_output .= "</items>";
	
	mysqli_close($conn);
	
	
	
	
	echo $xml_output;
}
else {
	if (!isset($_GET['arg1']))
	$error.= "argument1 not given.";
	if (!isset($_GET['arg2']))
	$error.= "argument2 not given.";
	print $error;
}

function printName($fname,$fvalue){
    $GLOBALS['xml_output'] .= "<". $fname .">" . $fvalue. "</". $fname . ">";
}

function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}
?>
