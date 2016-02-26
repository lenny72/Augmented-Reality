<?php
//Verbinding maken met database
$servername = "localhost";
$username = "root";
$password = "raspberry";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* Juiste database selecteren */
$conn->select_db("layar");
?>
