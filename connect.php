<?php
$sname = "localhost";
$user = "root";
$pass = "";
$db = "hackathon";

// Create connection
$conn = mysqli_connect($sname, $user, $pass,$db);

// Check connection
if (!$conn) {
  die("Error: " . mysqli_connect_error());
}
?>