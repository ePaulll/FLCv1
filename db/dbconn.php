<?php


$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "fitlife_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
  $error_msg = "Failed to connect to MySQL: " . mysqli_connect_error();
  error_log($error_msg);
}
?>