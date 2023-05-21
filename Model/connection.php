<?php

static $host = "localhost";
static $user = "root";
static $password = "";

$conn = new mysqli($host, $user, $password);

if (!$conn) {
  echo "Connection falied :(<br>" . $conn->error;
  return;
}

try {
  $dsn = "mysql:host=localhost;dbname=information_schema;";
  $pdo = new PDO($dsn, $user, $password);
  createSchemaIfNotExists($pdo, $conn);
  $pdo = null;
} catch (PDOException $e) {
  echo "Database connection failed: " . $e->getMessage();
  return;
}

function createSchemaIfNotExists(PDO $pdo, $conn)
{
  global $host, $user, $password;
  $schemaName = "metro-inventory";
  $sqlFile = "..\Asset\Database\metro-inventory-db.sql";
  
  $stmt = $pdo->prepare("SELECT EXISTS (SELECT 1 FROM information_schema.schemata WHERE schema_name = ?)");
  $stmt->execute([$schemaName]);
  $exists = $stmt->fetchColumn();

  if (!$exists) {
    $sql = file_get_contents($sqlFile);
    if ($conn->multi_query($sql) === TRUE) {
      $conn = null;
      $conn = new mysqli($host, $user, $password, $schemaName);
      echo "Connection established :)";
    } else {
      echo "Error executing SQL file: " . $conn->error;
      return;
    }
  } else {
    $conn = null;
    $conn = new mysqli($host, $user, $password, $schemaName);
    echo "Connection established :)";
  }
}
