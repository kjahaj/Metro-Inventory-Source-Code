<?php
session_start();
include("config.php");
if (!isset($_SESSION["login"]))
    header('Location: ../../View/Login/login.php');

if (isset($_POST['sub'])) {
    $a = $_POST['email'];
    $b = $_POST['password'];

    // Validate input
    if (empty($a) || empty($b)) {
        header("Location: login.php?err=2");
        exit();
    }

    // Prepare and execute the query using prepared statements
    $stmt = mysqli_prepare(
        $mysqli,
        "SELECT u.userID, u.name, u.surname, g.group FROM `users` u 
    INNER JOIN `user-groups` g ON u.groupID = g.groupID
    WHERE `e-mail`= ? AND password= ?;"
    );

    mysqli_stmt_bind_param($stmt, "ss", $a, $b);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    $group = $row['group'];

    // Check if a matching user is found
    if (mysqli_num_rows($res) > 0) {
        $_SESSION["login"] = "1";
        if ($group == "ADMIN") {
            header("Location: ../../View/Admin/index.php");
        } elseif ($group = "IT") {
            header("Location: ../../View/IT/index.php");
        } elseif ($group = "SERVICE") {
            header("Location: ../../View/Service/index.php");
        } elseif ($group = "FINANCE") {
            header("Location: ../../View/Finance/index.php");
        } else {
            header("Location: ../../View/User/index.php");
        }
        exit();
    } else {
        header("Location: login.php?err=1");
        exit();
    }
}
