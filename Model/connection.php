<?php
include "db.php";

// Create connection
$conn = new mysqli("webstud.umt.edu.al","kjahaj","Marswe23","web23_kjahaj");

if($conn){
  echo "connected succesfully";
}
else{
  echo "not connected";
}