<?php

include "../../View/Login/config.php";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

//This File will update your data base will current changes by droping it and creation a new one !
//User credencials e-mail: yourname@umt.edu.al (school email) pass: 1234;

if (!$conn) {
  echo "Connection falied :(<br>" . $conn->error;
  return;
}

try {
  $sqlFile = "metro-inventory-db.sql";

    $sql = file_get_contents($sqlFile);
    if ($conn->multi_query($sql) === TRUE) {
      $conn = null;
      $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
      echo "Database Updated :)";
    } else {
      echo "Error executing SQL file: " . $conn->error;
      return;
    }
} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
  return;
}