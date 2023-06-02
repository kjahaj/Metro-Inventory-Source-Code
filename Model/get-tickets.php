<?php
include './connection.php';

$sql = "SELECT t.ticketID, t.title, t.message, t.`msgStatus`, t.status, 
CONCAT(sender.name, ' ', sender.surname) AS 'sender', t.`datetimeCreated`, 
CONCAT(modifier.name,' ', modifier.surname) AS 'modifier', t.`datetimeModified`,
ug.ugroup FROM tickets t INNER JOIN `ugroups` ug ON ug.groupID = t.groupID 
INNER JOIN users sender ON sender.userID = t.senderID 
LEFT JOIN users modifier ON modifier.userID = `t`.`umodifierID`
ORDER BY t.ticketID DESC;";

// var_dump($sql);
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);

mysqli_stmt_close($stmt);
mysqli_close($conn);
