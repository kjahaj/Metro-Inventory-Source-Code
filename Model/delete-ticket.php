<?php

include './connection.php';
include './user.php';
include './session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketID = $_POST['ticketID'];

    $groupID = $_POST['groupID'];
    $msgStatus = $_POST['msgStatus'];

    $query = "DELETE FROM `tickets` WHERE ticketID =?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $ticketID);

    if ($stmt->execute()) {
        http_response_code(200);
        echo "Ticket was succesfully deleted!";
    } else {
        http_response_code(500);
        echo "Failed to delete ticket";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Invalid request method";
}