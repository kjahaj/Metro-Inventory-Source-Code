<?php

include "./connection.php";
$json = file_get_contents('php://input');
$object = json_decode($json);

// Access object properties
$message = $object->message;
$msgStatus = $object->{'msg-status'};
$status = $object->status;
$dateTimeCreated = $object->{'date-time-created'};
$dateTimeModified = $object->{'date-time-modified'};
$groupID = $object->groupID;
$senderID = $object->senderID;
$userModifierID = $object->{'user-modifier-ID'};

// Prepare the SQL query
$sql = "INSERT INTO tickets (message, `msg-status`, `status`, `date-time-created`, `date-time-modified`, groupID, senderID, `user-modifier-ID`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Bind the parameters
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssss", $message, $msgStatus, $status, $dateTimeCreated, $dateTimeModified, $groupID, $senderID, $userModifierID);

// Execute the query
if (mysqli_stmt_execute($stmt)) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
