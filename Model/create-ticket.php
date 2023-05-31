<?php
include './connection.php';
include './user.php';
include './session.php';

if (isset($_POST['createTicket'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $dateTimeCreated = date('Y-m-d H:i:s');
    $dateTimeModified = date('Y-m-d H:i:s');
    $group = $_POST['group'];
    $senderID = $user->getUserID();

    $sql =
        "INSERT INTO `tickets`
        (`title`, `message`, `datetimeCreated`, `datetimeModified`, `groupID`, `senderID`)
        VALUES (?, ?, ?, ?, (SELECT `groupID` FROM `ugroups` WHERE `ugroup` = ?), ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $title, $message, $dateTimeCreated, $dateTimeModified, $group, $senderID);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../View/Admin/view-tickets.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
