<?php 
include_once("scripts/conn.php");
/*mysql_connect('localhost', 'root', 'MuziekTrein1459');
mysql_select_db('ecards');
$sql = "SELECT kaartID,kaartNr FROM tbl_ecard_kaarten";

$sth = mysql_query($sql);
$rows = array();
while($r = mysql_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);

?>*/

$sql = "SELECT * FROM servers s,items i WHERE s.serverID = i.serverID "; 
$result = $conn->query($sql); 
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) { 
    $rows[] = $row;
	echo "".$row['name'];
		}
	
}
print json_encode($rows);
/*
$sql = "SELECT * FROM items,servers where items.serverID = servers.serverID"; 
	  $result = $conn->query($sql); 
	  if ($result->num_rows > 0) {
		  while($row = $result->fetch_assoc()) {
				echo "".$row['adres'];
			}
	  } 
	  else{
		echo 'BLEK';  
	  }
	 */ 



?>

