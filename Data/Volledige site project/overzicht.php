<?php include_once("scripts/conn.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Points Of Interest Toevoegen</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
$(function(){
	 $('.status').click(function(e) {
			var ipadr = $(this).attr("data-ip");
			var pin =  $(this).attr("data-pin");
			var status =  $(this).attr("data-status");
			var index = $(this).attr("data-index");
			getajax(status,ipadr,pin,index);
			$(this).next('.pow').text("Vermogen: " + status);
			
    });
		//192.168.137.2/?status=1&adr=192.168.137.3&pin=17
});

$(function() {
	$( ".status" ).each(function( index ) {
  	   	var onloadip = $(this).attr("data-ip");
		var onloadpin = $(this).attr("data-pin");
		getajax("-1",onloadip,onloadpin,index);
		//$(this).next('.pow').text("Vermogen: " + status);
 	});
});
function getajax(status,ip,pin,index) {
	var stand;
		if(status=="-1"){
			var pre='adr=';
		}
		else if(status == "0"){
			var pre='status=0&adr=';
		}
		else if(status =="1"){
			var pre='status=1&adr=';
		}
        $.ajax({
            type: "GET",
            url: 'http://192.168.1.102/?'+pre+ip+'&pin='+pin,
            cache: false, 
            dataType: "xml",
            success: function(xml) {
                $(xml).find('info').each(function(){
                    var waarde = $(this).find("waarde").text();
					var stand = $(this).find("status").text();
					if(stand == 1){
						
						$('.power').eq(index).text("Gebruikt vermogen: " + waarde).prev().text("AAN").attr("data-status","0").attr("data-index",index);		
					}
					else
					{
						$('.power').eq(index).text("Apparaat uit.").prev().text("UIT").attr("data-status","1").attr("data-index",index);	
					}
					
                });
            }
        });	
		//return stand+"";
		}
   
</script>


</head>

<body>
<?php 

	 $sql = "SELECT * FROM items,servers where items.serverID = servers.serverID"; 
	  $result = $conn->query($sql); 
	  if ($result->num_rows > 0) {
	  //itemID , name , about, value , locID , power , serverID
		  while($row = $result->fetch_assoc()) {
		  	echo '<h3> '.$row['itemID']."  ".$row['name'].' </h3>';
			echo '<p> '.$row['about'].' </p>';
		  	echo '<button class="status" data-status="" data-pin="'.$row['pin'].'" data-ip="'.$row['adres'].'" type="button">'.$row['adres'].' aan'.'</button>';
			echo '<p class="power"> </p>';
			}
		echo '</select>';
	  } 
	  
	   
	
?>

<div id="test">
	<p id="dump"></p>
</div>

</body>