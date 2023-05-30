<?php
include './connection.php';

$sql = "SELECT itemID, item, category, quantity, warehouse
        FROM `stock-items` si
        JOIN `storage-units` su ON si.warehouseID = su.warehouseID";

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
