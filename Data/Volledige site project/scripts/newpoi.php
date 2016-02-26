<?php
	include_once("conn.php");
	$toggle = false;
	if(isset($_POST['controleren'])){
	
		//Test of er al coordinaten zijn
		if(isset($_POST["straat"]) && isset($_POST["huisnummer"]) && isset($_POST["gemeente"]) && isset($_GET["voettekst"]) && $_POST['lng'] == "" &&  $_POST['lng'] == "" )
		{
			//ZOEK DE COORDINATEN
			$url = "http://maps.google.com/maps/api/geocode/json?address=".trim($_POST["straat"])."+".trim($_POST["huisnummer"])."+".trim($_POST["gemeente"]);
			$response = file_get_contents($url);
			$json = json_decode($response,TRUE);
			if ($json['results'])
			{
				$lat = $json['results'][0]['geometry']['location']['lat'];
				$lng = $json['results'][0]['geometry']['location']['lng'];
				$toggle=true;
			}
		}
		//ER ZIJN AL COORDINATEN VOORZIEN 
		else if(isset($_POST["straat"]) && $_POST["straat"] != "" && isset($_POST["huisnummer"]) && $_POST["huisnummer"] != "" && isset($_POST["gemeente"]) && $_POST["gemeente"] != "" && isset($_POST["voettekst"]) && $_POST["voettekst"] != "" && isset($_POST['lng']) && $_POST["lng"] != "" &&  isset($_POST['lng']) && $_POST["lng"] != ""){
			//TEST OF DE COORDINATEN JUIST ZIJN
			if(preg_match('/^(\-?\d+(\.\d+)?).\s*(\-?\d+(\.\d+)?)$/',$_POST["lat"]) && preg_match('/^(\-?\d+(\.\d+)?).\s*(\-?\d+(\.\d+)?)$/',$_POST["lng"])){
			$lat = $_POST["lat"];
			$lng = $_POST["lng"];
			$toggle = 1;
			//$return = "&#x2713";
			}
		else{
			//FOUT met de coördinaten
			//$return = "De ingegeven coördinaten zijn fout."	;
			}
			
			
		}
		else{
			//ERROR, DE JUISTE GEGEVENS ZIJN NIET INGEVULT
			
		}
		
		//Hier begint het SQL deel, dit begint zodra de toggle op true staat in een van de vorige if lussen
		if($toggle == 1){
			$straat = $_POST['straat'];
			$huisnummer = $_POST['huisnummer'];
			$gemeente = $_POST['gemeente'];
			$voettekst = $_POST['voettekst'];
			//Als er geen titel is wordt er een gemaakt 
			if(isset($_POST['title'])){
				$title = $_POST['title'];
			}
			else{
				$titel =$_POST["straat"]." ".$_POST["huisnummer"];
			}
			
			if($conn->query("INSERT INTO poi VALUES ('','$straat','$huisnummer','$gemeente','','$titel','$voettekst','$lat','$lng','','geo')"));
			
			
			
		}
		
	}
	header('Location: ../addpoi2.php');
?>

