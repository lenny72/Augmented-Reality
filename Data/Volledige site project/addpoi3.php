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
            <li><a href="#">Add</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Login</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  
  
    
    <div class="container-fluid background">
    
    <div class="col-md-6">
<form class="form-horizontal" role="form" action="scripts/newpoi.php" method="post">
  <h1>Adres als POI toevoegen</h1>
  <div class="form-group">
    <label class="control-label col-sm-2" for="straat">Straat:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="straat" placeholder="Voer een straat in">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="huisnummer">Huisnummer:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="huisnummer" placeholder="Voer een huisnummer in">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="gemeente">Gemeente:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="gemeente" placeholder="Voer een gemeente in">
    </div>
  </div>
  <h3>Coördinaten</h3>
  <div class="form-group">
    <label class="control-label col-sm-2" for="lat">latitude:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="lat" placeholder="Voer een latitude in">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="lng">longitude:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="lng" placeholder="Voer een longitude in">
    </div>
  </div>
  <h3>POI Informatie</h3>
  <div class="form-group">
    <label class="control-label col-sm-2" for="titel">Titel:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="titel" placeholder="Voer een titel in">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="voettekst">Voettekst:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="voettekst" placeholder="Voer een voettekst in">
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="toevoegen" class="btn btn-default">Voeg toe!</button>
    </div>
  </div>
</form>
</div>

<div class="col-md-6">
	<form class="form-horizontal" role="form" action="scripts/newpoi.php" method="post">
  <h1>Een item toevoegen</h1>
  <div class="form-group">
    <label class="control-label col-sm-2" for="naam">Naam:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="naam" placeholder="Voer een naam in">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="about">Beschrijving:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="about" placeholder="Voer een beschrijving in">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="value">Verbruik:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" id="value" placeholder="Voer het verbruik in">
    </div>
  </div>
  
  
              
 <div class="form-group">
  <label class="control-label col-sm-2" for="poiID">Locatie:</label>
  <div class="col-sm-10"> 
  <select name="poiID" class="form-control" id="poiID">
      <?php $sql = "SELECT id,title FROM poi"; 
              $result = $conn->query($sql); 
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) { 
  					  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                    }
              } ?>
  </select>
  </div>
  </div>
  
  
  <div class="form-group">
  <label class="control-label col-sm-2" for="serverID">Server:</label>
  <div class="col-sm-10"> 
  <select name="serverID" class="form-control" id="serverID">
     <?php $sql = "SELECT * FROM servers"; 
                  $result = $conn->query($sql); 
                  if ($result->num_rows > 0) {
                  //id, ip adress
                      while($row = $result->fetch_assoc()) { 
                          echo '<option value="'.$row['serverID'].'">'.$row['adres'].'</option>';
                        }
                  } 
	?>
  </select>
  </div>
  </div>
  <div class="form-group">
  <label class="control-label col-sm-2" for="pin">Pin:</label>
  <div class="col-sm-10"> 
  <select name="pin" class="form-control" id="pin" data-pin="<?php 
      $sql = "SELECT * FROM items WHERE serverID =3"; 
      $result = $conn->query($sql); 
      if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) { 
                    echo "/".$row['pin'];
                 }
            }
    ?>">
  </select>
  </div>
</div>
  
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="toevoegen" class="btn btn-default">Voeg toe!</button>
    </div>
  </div>
  
  </form>
</div>

    
    
    </div> 
    


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script>
	$(function(){
		$("#pin").click(function(e) {
           	var test_str = $(this).attr('data-pin');
			var flag = true;
			var waardes=[];
			var pos = 0;
			while(flag){
			var start_pos = test_str.indexOf('/',pos) + 1;
			var end_pos = test_str.indexOf('/',start_pos);
			if(end_pos!=-1){
			var text_to_get = test_str.substring(start_pos,end_pos)
			waardes.push(text_to_get);
			pos = end_pos;
			}
			else{
				flag = false;
			}
			
			}
			alert(waardes[0]);
			alert(waardes[1]);
			alert(waardes[2]);
			alert(waardes[3]);
			for(var i=5;i<29;i++){
				if(jQuery.inArray(i, waardes) !== -1){
					console.log(""+i);
				}
				else{
					console.log("BLEH "+i);
				}
				
			}
        });
		
		});		   
</script>
    
  </body>
</html>