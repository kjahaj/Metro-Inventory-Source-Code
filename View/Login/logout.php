<?php
session_start ();
session_destroy();
header('Location: ../../View/Admin/index.php')
?>