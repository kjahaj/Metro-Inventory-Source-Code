<?php 
  session_start();
  if(!isset($_SESSION["login"]))
    header('Location: ../../View/Login/login.php'); 
  ?>