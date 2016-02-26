<?php 
include_once("conn.php");
if(	isset($_POST["naam"]) && $_POST["naam"] != "" && 
	isset($_POST["about"]) && $_POST["about"] != "" &&
	isset($_POST["serverID"]) && $_POST["serverID"] != "" &&
	isset($_POST["poiID"]) && $_POST["poiID"] != "" &&
	isset($_POST["pin"]) && $_POST["pin"] != "")
{
	$naam = $_POST['naam'];
	$about = $_POST['about']; 
	$serverID = $_POST['serverID'];
	$poiID = $_POST['poiID'];
	$pin = $_POST['pin'];
	echo 'werkt: '.$pin;
	mysqli_query($conn,"INSERT INTO items VALUES ('','$naam','$about','','$poiID','','$serverID','$pin')");
	}
	else{
	echo 'werkt niet'.' / '.$_POST["naam"].' / '.$_POST["about"].' / '.$_POST["serverID"].' / '.$_POST["poiID"].' / '.$_POST["pin"];
}
	header('Location: ../addpoi3.php');

?>