<?php

include './connection.php';
include './user.php';
include './session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticketID = $_POST['ticketID'];

    if (isset($_POST['msgStatus'])) {
        $groupID = $_POST['groupID'];
        $msgStatus = $_POST['msgStatus'];

        $query = "UPDATE tickets SET msgStatus = ? WHERE ticketID = ? AND groupID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $msgStatus, $ticketID, $groupID);

        if ($stmt->execute()) {
            http_response_code(200);
            echo "msgStatus updated to READ";
        } else {
            http_response_code(500);
            echo "Failed to update msgStatus";
        }

        $stmt->close();
        $conn->close();
    } elseif (isset($_POST['status'])) {
        $umodifierID = $user->getUserID();
        $dateTimeModified = date('Y-m-d H:i:s');

        $query = "UPDATE tickets SET status = 'CLOSED', umodifierID = ?, datetimeModified = ? WHERE ticketID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $umodifierID, $dateTimeModified, $ticketID);

        if ($stmt->execute()) {
            echo "Ticket status updated to CLOSED";
        } else {
            echo "Failed to update ticket status";
        }

        $stmt->close();
        $conn->close();
    } else {
        http_response_code(400);
        echo "Bad Request";
    }
} else {
    http_response_code(405);
    echo "Invalid request method";
}
