<?php
include "../../../../config.php";
include "../../Model/connection.php";

try {
  $sqlFile = "metro-inventory-db.sql";

    $sql = file_get_contents($sqlFile);
    if ($conn->multi_query($sql) === TRUE) {
      $conn = null;
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      echo "Database Updated :)";
    } else {
      echo "Error executing SQL file: " . $conn;
      return;
    }
} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
  return;
}
