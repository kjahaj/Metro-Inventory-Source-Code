<?php
include "./connection.php";

if (!isset($_GET['group_id'])) {
    echo "Error: Group ID parameter not provided";
    exit;
}

$groupID = $_GET['group_id'];

$sql = "SELECT t.ticketID, t.tittle, t.message, t.`msg-status`, t.status, 
CONCAT(sender.name, ' ', sender.surname) AS 'sender', t.`date-time-created`, 
CONCAT(modifier.name,'', modifier.surname) AS 'modifier', t.`date-time-modified` 
FROM tickets t INNER JOIN `user-groups` ug ON ug.groupID = t.groupID 
INNER JOIN users sender ON sender.userID = t.senderID 
LEFT JOIN users modifier ON modifier.userID = `t`.`user-modifier-ID`
 WHERE ug.groupID = ? ORDER BY t.ticketID DESC;";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $groupID);
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
