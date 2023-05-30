<?php
include './connection.php';

$itemID = $_POST['itemID'];

print($itemID);

$sql = "DELETE FROM `stockitems` WHERE itemID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itemID);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // The row has been deleted successfully
    echo "Row deleted.";
} else {
    // No row was deleted
    echo "No row deleted.";
}

$stmt->close();
$conn->close();

?>