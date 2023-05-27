<?php
include "./connection.php";

$sql = "SELECT `stock-items`.itemID, `stock-items`.item, `stock-items`.category, `stock-items`.quantity, `storage-units`.warehouse
        FROM `stock-items` 
        JOIN `storage-units` ON `stock-items`.warehouseID = `storage-units`.warehouseID";

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

?>
