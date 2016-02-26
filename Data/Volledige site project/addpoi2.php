<?php
session_start();
include_once("scripts/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Points Of Interest Toevoegen</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div>
<form action="scripts/newpoi.php" method="post">
<h1>Adres als POI toevoegen</h1>
    <table>
        <tr>
            <td><h3>Adres</h3></td>
            <td></td>
        </tr>
        <tr>
        	<td>Straat:</td>
        	<td><input type="text" name="straat" value="" ></td>
            <td></td> 
        </tr>
      	<tr>
        	<td>Huisnummer:</td>
            <td><input type="text" name="huisnummer" value=""></td>
            <td></td> 
      	</tr>
      	<tr>
        	<td>Gemeente:</td>
        	<td><input type="text" name="gemeente" value=""></td>
            <td></td> 
     	 </tr>
         <tr>
            <td><h3>Coördinaten</h3></td>
            <td></td>
    	</tr>
      	<tr>
            <td>Langitude:</td>
            <td><input type="text" name="lat" value=""></td>    
            <td></td>  
      	</tr>
      	<tr>
            <td>Longitude:</td>
            <td><input type="text" name="lng" value=""></td>
            <td></td>  
      	</tr>  
        <tr>
            <td><h3>POI Informatie</h3></td>
            <td></td>
    	</tr>
        <tr>
            <td>Titel:</td>
            <td><input type="text" name="titel" value="" required="required"></td>
            <td></td>
    	</tr>
        <tr>
            <td>Voettekst:</td>
            <td><input type="text" name="voettekst" value="Augmented Reality Project Groep 8" required="required"></td>
            <td></td>
    	</tr>
		<tr>
        	<td>Point Of Interest controleren en toevoegen:</td>
       	  	<td><input type="submit" name="controleren" value="CONTROLEREN EN TOEVOEGEN"></td>         
      	</tr>
	</table>
</form>
</div>

<div>
    <form action="scripts/additem.php" method="post">
        <h1>een item toevoegen</h1>
        <!-- name , about ingeven
             value random aanmaken
             locID laden en kiezen
         -->
        
        <table>
            <tr>
                <td><h3>Item</h3></td>
                <td></td>
            </tr>
            <tr>
                <td>Naam:</td>
                <td><input type="text" name="naam" value="" required="required"></td>
                <td></td> 
            </tr>
            <tr>
                <td>Beschrijving:</td>
                <td><input type="text" name="about" value="" required="required"></td>
                <td></td> 
            </tr>
            <tr>
                <td>Verbruik:</td>
                <td><input type="text" name="value" value="" required="required"></td>
                <td></td> 
            </tr>
            <tr>
            <td>Locatie: </td>
            <td>
              <?php $sql = "SELECT * FROM poi"; 
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
              //straat,huisnummer,gemeente,title,footnote,lat,lon,poiType
			  	echo '<select name="poiID" required="required">';
                  while($row = $result->fetch_assoc()) { 
  					  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                    }
              	echo '</select>';
              } ?>
            </td>
            </tr>
            <tr>
            <td>Server: </td>
            <td>
              <?php $sql = "SELECT * FROM servers"; 
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
              //id, ip adress
			  	echo '<select name="serverID" required="required">';
                  while($row = $result->fetch_assoc()) { 
  					  echo '<option value="'.$row['serverID'].'">'.$row['adres'].'</option>';
                    }
              	echo '</select>';
              } ?>
              
              <?php 
			  $sql = "SELECT * FROM items WHERE serverID=3"; 
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
			  	echo '<select name="pin" required="required">';
                 		 while($row = $result->fetch_assoc()) { 
						 	echo "".$row;
                   		 }
					}
              	echo '</select>';
             ?>
            </td>
            </tr>
            <tr>
                <td>items toevoegen:</td>
                <td><input type="submit" name="toevoegen" value="toevoegen"></td>         
            </tr>
        </table>
    </form>
</div>

</body>
</html>