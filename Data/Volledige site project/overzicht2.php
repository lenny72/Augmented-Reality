<?php 

include_once("scripts/conn.php");

?>

<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Augmentergy</title>
	
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
	<!-- Eigen css --> 

	<link rel="stylesheet" type="text/css" href="css/style.css">
    

  </head>
  <body>
  
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Augmentergy</a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Add more</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Login</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  
  
    
    <div class="container-fluid background">
    	<button type="button" id="refresh" class="btn btn-customblack" type="button">Refresh</button>
        	
            	<?php 
					 $count = 0;
                     $sql = "SELECT * FROM items,servers where items.serverID = servers.serverID"; 
                      $result = $conn->query($sql); 
                      if ($result->num_rows > 0) {
                      //itemID , name , about, value , locID , power , serverID
                          while($row = $result->fetch_assoc()) {
                          	
                          	if($count%3==0){
                            	echo '<div class="row heighteq">';
                            }
                          	echo '<div class="col-md-4 item">';
                            echo '<div class="itemins">';
                            echo '<h3> '.$row['itemID']."  ".$row['name'].' </h3>';
                            echo '<p> '.$row['about'].' </p>';
                            echo '<button type="button" class="status btn btn-customblack" data-status="" data-pin="'.$row['pin'].'" data-ip="'.$row['adres'].'" type="button">ERR</button>';
                            echo '<p class="power"> </p>';
                            echo '</div>';
                            echo '</div>';
                            if((($count-2)%3)==0){
                            	echo '</div>';
                            }
                            $count++;
                            }
                            if($count%3!=0){
                            	echo '</div>';
                            }
                      } 
                      
                       
                    
                ?>
                
            </div>
        
        </div>
    
    </div>    
    


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
	$(function(){
		loadall();
		 $('.status').click(function(e) {
				var ipadr = $(this).attr("data-ip");
				var pin =  $(this).attr("data-pin");
				var status =  $(this).attr("data-status");
				var index = $(this).attr("data-index");
				changecol(this,status);
				getajax(status,ipadr,pin,index);
				$(this).next('.pow').text("Vermogen: " + status);
				
		});
			//192.168.137.2/?status=1&adr=192.168.137.3&pin=17
		$('#refresh').click(function(e) {
			loadall();
		});
	});

	function loadall(){
		$( ".status" ).each(function( index ) {
			var onloadip = $(this).attr("data-ip");
			var onloadpin = $(this).attr("data-pin");
			getajax("-1",onloadip,onloadpin,index);
		});
		
		$('.heighteq').each(function(){  
	
			var highestBox = 0;
			$('.item', this).each(function(){
	
				if($(this).height() > highestBox) 
				   highestBox = $(this).height(); 
			});  
	
			$('.item',this).height(highestBox);
			$('.itemins').height('96%');
	
		});  
	}
	function changecol(object,status) {
		if(status==1){
					$(object).removeClass('btn-customred').addClass('btn-custom');
				}
				else{
					$(object).removeClass('btn-custom').addClass('btn-customred');
				}
	}
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
				url: 'http://94.226.91.203/?'+pre+ip+'&pin='+pin,
				cache: false, 
				dataType: "xml",
				success: function(xml) {
					$(xml).find('info').each(function(){
						var waarde = $(this).find("waarde").text();
						var stand = $(this).find("status").text();
						if(stand == 1){
							
							$('.power').eq(index).text("Gebruikt vermogen: " + waarde+ "W").prev().text("AAN").removeClass('btn-customblack  btn-custom btn-customred').addClass('btn-custom').attr("data-status","0").attr("data-index",index).show();		
						}
						else
						{
							$('.power').eq(index).text("Apparaat uit.").prev().text("UIT").removeClass('btn-customblack btn-custom btn-customred').addClass('btn-customred').attr("data-status","1").attr("data-index",index).show();
						}
						
					});
				}
			});	
			//return stand+"";
			}
	   
</script>
    
  </body>
</html>