<?php

include "../../Model/connection.php";

//This File will update your data base will current changes by droping it and creation a new one !
//User credencials e-mail: yourname@umt.edu.al (school email) pass: 1234;

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

try {
  $sqlFile = "metro-inventory-db.sql";

    $sql = file_get_contents($sqlFile);
    if ($conn->multi_query($sql) === TRUE) {
      $conn = null;
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      echo "Database Updated :)";
    } else {
      echo "Error executing SQL file: " . $conn->error;
      return;
    }
} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
  return;
}