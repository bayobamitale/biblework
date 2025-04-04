<?php 
$servername = "localhost";
  $username = "Bayo";
  $password = "Ade1234";
  $dbname = "bible";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>