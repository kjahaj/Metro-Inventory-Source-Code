<?php
include './connection.php';

$sql = "SELECT title, `status`
        FROM `tickets`
        WHERE `status` = 'OPEN'
        ORDER BY ticketID DESC
        LIMIT 3";

$result = mysqli_query($conn, $sql);

if (!$result) {
    exit;
}

$data = array(); 

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);

mysqli_close($conn);
