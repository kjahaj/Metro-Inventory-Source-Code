<?php

$servername = "localhost";
$username = "kjahaj";
$password = "Marswe23";
$dbname = "web23_kjahaj";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>