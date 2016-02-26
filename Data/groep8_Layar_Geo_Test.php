<?php
//**BEGIN DATABASE CONNECTIE**//
$db = mysqli_connect("localhost","root","","layar_project");

if (mysqli_connect_errno())
{
  echo "Fout bij verbinden met database: " . mysqli_connect_error();
}

//Array van namen van de benodigde parameters voor de getPOI request
$parameternamen = array('layerName', 'lat', 'lon', 'radius', 'userId');

//Array voor de op te vragen parameters uit de getPOI request URL
$parameters = array();

//Paramaters array opvullen, met de waarden uit de getPOI request URL, via de getParameters functie
$parameters = getParameters($parameternamen);

//**PARAMETERS UIT URL LEZEN**//
function getParameters($parameternamen)
{
  $parametersArray = array();  
  try 
  {
    foreach($parameternamen as $parameternaam) 
	{
      if (isset($_GET[$parameternaam]))
	  {
        $parametersArray[$parameternaam] = $_GET[$parameternaam];
	  }
      else
	  {
        throw new Exception($parameternaam .' parameter is niet meegegeven met de getPOI request.');
	  }
    }
    return $parametersArray;
  }
  catch(Exception $e)
  {
    echo 'Fout: ' .$e->getMessage();
  }
}

//**POI'S EN VERBRUIK VAN DATABASE HALEN (wordt opgeroepen bij opbouw JSON response)**//
function getHotspots($db, $value) 
{
  $rawPois = mysqli_query($db,"SELECT id,verbruikID,imageURL,title,footnote,lat,lon,
                     (((acos(sin((".$value['lat']." * pi() / 180)) * sin((lat * pi() / 180)) + 
					 cos((".$value['lat']." * pi() / 180)) * 
					 cos((lat * pi() / 180)) * 
					 cos((".$value['lon']."  - lon) * pi() / 180))) * 
					 180 / pi())* 60 * 1.1515 * 1.609344 * 1000) as distance
              FROM POI WHERE poiType = 'geo' HAVING distance < ".$value['radius']." ORDER BY distance ASC LIMIT 0, 50 ");
		
  //**UITBREIDING TRACKING**//
  //GebruikID opvragen uit URL van getPOI request	  
  $gebruiker = mysqli_query($db,"SELECT * FROM gebruikers WHERE id=".$value['userId']."");
  //Controleren of gebruiker al in database staat
  if (!$gebruiker)
  {
	  //Als dit niet zo is, gebruiker toevoegen
	  mysqli_query($db,"INSERT INTO gebruikers (id,naam,lan,lon) VALUES ('".$value['userId']."','Anoniem','".$value['lat']."','".$value['lon']."')");
  }
//UPDATE
	  mysqli_query($db,"UPDATE gebruikers SET naam='TEST' WHERE id=".$value['userId']."");
  
  
  $rawGebruikers = mysqli_query($db,"SELECT id,naam,lat,lon FROM gebruikers");
  $i = 0; 
  
  if ($rawPois) 
  {	
  		foreach ($rawPois as $rawPoi) 
		{
		  $poi = array(); 
		  $poi['id'] = $rawPoi['id'];
		  $poi['imageURL'] = $rawPoi['imageURL'];
		  $poi['anchor']['geolocation']['lat'] = floatval($rawPoi['lat']);
		  $poi['anchor']['geolocation']['lon'] = floatval($rawPoi['lon']);
		  $poi['text']['title'] = $rawPoi['title'];
			
		  $rawVerbruik = mysqli_query($db,"SELECT verbruik FROM verbruik WHERE verbruikID=".$rawPoi['verbruikID']);
		  $verbruik = $rawVerbruik->fetch_assoc();
	
		  $poi['text']['description'] = "Verbruik: ".$verbruik['verbruik']."kWh\r\n 1) Dit is een nieuwe regel.\r\n 2) Dit is een nieuwe regel.";
		  $poi['text']['footnote'] = $rawPoi['footnote'];
		  
		  $hotspots[$i] = $poi;//Point Of Interest in de hotspots array stoppen
		  $i++;
  		}
  }
  
  if($rawGebruikers)
  {
	  foreach ($rawGebruikers as $rawGebruiker)
	  {
		  $Gebruikerpoi = array(); 
		  $Gebruikerpoi['id'] = $rawGebruiker['id'];
		  $Gebruikerpoi['imageURL'] = "";
		  $Gebruikerpoi['anchor']['geolocation']['lat'] = floatval($rawGebruiker['lat']);
		  $Gebruikerpoi['anchor']['geolocation']['lon'] = floatval($rawGebruiker['lon']);
		  $Gebruikerpoi['text']['title'] = $rawGebruiker['naam'];
		  $Gebruikerpoi['text']['description'] = "Dit is een persoon.";
		  $Gebruikerpoi['text']['footnote'] = "Project Aumented Reality Groep 8";
		  
		  $hotspots[$i] = $Gebruikerpoi;//Point Of Interest in de hotspots array stoppen
		  $i++;
	  }
  }
  return $hotspots;
}

//**ANTWOORD OPBOUWEN MET ARRAY**//
$response = array();
$response['layer'] = $parameters['layerName'];
$response['refreshInterval'] = 10; //Laat Layar app elke 10 seconden nieuwe request versturen
$response['hotspots'] = getHotspots($db, $parameters);//Hotspots = POI's

if (!$response['hotspots']) //Wanneer er geen POI's in de buurt zijn, geven we dit mee in het antwoord
{
	$response['errorCode'] = 20;
	$response['errorString'] = "Geen locaties gevonden";
}
else 
{
	$response['errorCode'] = 0;
	$response['errorString'] = "Locaties gevonden"; //Deze string wordt niet weergegeven in de Layar app
}
	
//**OMZETTEN VAN DATA NAAR JSON**//
$jsonresponse = json_encode($response);
header("Content-type: application/json; charset=utf-8");

//**ANTWOORD PRINTEN**//
echo $jsonresponse;
mysqli_close($db);
?>