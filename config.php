<?php
// Use localhost:3307
$servername = "localhost:3307";  
$username = "root";
$password = "";
$database = 'pharmacy';
// Create connection
// $conn = new mysqli($servername, $username, $password);
$conn = mysqli_connect($servername, $username, $password,$database);
// Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
//  else{ 
    // echo "Connected successfully";
// }
?>