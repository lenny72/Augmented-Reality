<?php
header("Content-type: text/xml");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$xmlprint ="<info>";

$host = "192.168.1.102";
$port = 2000;

$status=-1;
$pin=17;
$message="";
if(isset($_GET['status'])){
	$status=$_GET['status'];
	if ($status=='0') {
		$status='uit';
	}
	
	
}
$message.=$status;
if(isset($_GET['pin'])){
	$pin=$_GET['pin'];
}
$message.=":";
$message.=$pin;
if(isset($_GET['adr'])){
	$host=$_GET['adr'];
	
}

$socket1 = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");

socket_connect ($socket1 , $host,$port ) ;

socket_write($socket1, $message) or die("Could not write output\n");
$ok=False;
$buf="";
if (false === ($buf = socket_read($socket1, 1024))) {
	$ok=False;
} else {
	$ok=True;
}
if ($ok) {
$waarde = explode(":", $buf);
$xmlprint .="<waarde>";
$xmlprint .=$waarde[0];
$xmlprint .="</waarde>";
$xmlprint .="<status>";
$xmlprint .=$waarde[1];
$xmlprint .="</status>";

} else {
	$xmlprint .="<waarde>";
	$xmlprint .="error";
	$xmlprint .="</waarde>";
}

socket_close($socket1) ;

$xmlprint .="</info>";

echo $xmlprint;
?>
