<?php
session_start();
if (!isset($_SESSION["login"])) {
  header('Location: ../../View/Login/login.php');
  exit();
}

if (isset($_SESSION['user'])) {
  $user = unserialize($_SESSION['user']);
  $userFull = $user->getName() . " " . $user->getSurname();
} else {
  $userFull = "Username";
}
?>