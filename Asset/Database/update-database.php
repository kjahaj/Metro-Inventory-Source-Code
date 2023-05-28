<?php

static $host = "localhost";
static $user = "root";
static $password = "";

$conn = new mysqli($host, $user, $password);

//This File will update your data base will current changes by droping it and creation a new one !
//User credencials e-mail: yourname@umt.edu.al (school email) pass: 1234;

if (!$conn) {
  echo "Connection falied :(<br>" . $conn->error;
  return;
}

try {
  $dsn = "mysql:host=localhost;dbname=metro-inventory;";
  $pdo = new PDO($dsn, $user, $password);
  createSchema($pdo, $conn);
  $pdo = null;
} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
  return;
}

function createSchema(PDO $pdo, $conn)
{
  global $host, $user, $password;
  $schemaName = "metro-inventory";
  $sqlFile = "metro-inventory-db.sql";
  
    $sql = file_get_contents($sqlFile);
    if ($conn->multi_query($sql) === TRUE) {
      $conn = null;
      $conn = new mysqli($host, $user, $password, $schemaName);
      echo "Database Updated :)";
    } else {
      echo "Error executing SQL file: " . $conn->error;
      return;
    }
}