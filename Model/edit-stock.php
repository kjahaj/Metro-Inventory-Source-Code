<?php
include './connection.php';

// Retrieve the POST parameters
$rowId = $_POST['rowId'];
$item = $_POST['item'];
$category = $_POST['category'];
$warehouse = $_POST['warehouse'];

$wIDQuery = "SELECT warehouseID FROM `storageunits` WHERE warehouse = '$warehouse'";
$wIDResult = mysqli_query($conn, $wIDQuery);
$wIDRow = mysqli_fetch_assoc($wIDResult);
$wID = $wIDRow['warehouseID'];

$sql = "UPDATE `stockitems` 
        SET item = '$item', 
        category = '$category', 
        warehouseID = '$wID'
        WHERE itemID = '$rowId'";

if ($conn->query($sql) === TRUE) {
    echo "Database updated successfully";
} else {
    echo "Error updating database: " . $conn;
}

$conn->close();
?>
