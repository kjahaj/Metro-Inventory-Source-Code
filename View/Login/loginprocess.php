<?php
include('../../../config.php');
include("../../Model/connection.php");
require_once "../../Model/user.php";
session_start();

if (isset($_POST['sub'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please enter email and password.'); window.location.href='login.php?err=2';</script>";
        exit();
    }
    $stmt = mysqli_prepare(
        $conn,
        "SELECT u.userID, u.name, u.surname, u.groupID, u.password, g.ugroup 
        FROM `users` u 
        INNER JOIN `ugroups` g ON u.groupID = g.groupID
        WHERE `email` = ?;"
    );

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    if (mysqli_num_rows($res) > 0) {
        $hashedPassword = $row['password'];
        if ($password == $hashedPassword) {

            // Create a User instance
            $user = new User($row['userID'],$row['name'], $row['surname'], $email, $row['groupID'], $row['ugroup']);
            $_SESSION["login"] = "1";
            $_SESSION["user"] = serialize($user);

            // Redirect based on user's group
            switch ($row['ugroup']) {
                case "ADMIN":
                    header("Location: ../../View/Admin/index.php");
                    break;
                case "IT":
                    header("Location: ../../View/IT/index.php");
                    break;
                case "SERVICE":
                    header("Location: ../../View/Service/index.php");
                    break;
                case "FINANCE":
                    header("Location: ../../View/Finance/index.php");
                    break;
                default:
                    header("Location: ../../View/User/index.php");
            }
            exit();
        } else {
            header("Location: login.php?err=1");
            exit();
        }
    } else {
        header("Location: login.php?err=1");
        exit();
    }
}
