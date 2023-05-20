<?php
$servername = "webstud.umt.edu.al/phpmyadmin";
$username = "kjahaj";
$password = "Marswe23";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>