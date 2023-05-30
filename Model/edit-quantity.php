<?php
include "./connection.php";

$item = $_POST['item'];
$quantity = $_POST['quantity'];

$iIDQuery = "SELECT itemID, quantity FROM `stock-items` WHERE item = '$item'";
$iIDResult = mysqli_query($conn, $iIDQuery);
$iIDRow = mysqli_fetch_assoc($iIDResult);
$iID = $iIDRow['itemID'];
$currentQuantity = $iIDRow['quantity'];

$newQuantity = $currentQuantity + $quantity;

// Check if the resulting quantity is smaller than 0
if ($newQuantity < 0) {
    echo "Error: The resulting quantity would be smaller than 0. Update aborted.";
    exit;
}

$sql = "UPDATE `stock-items` 
        SET quantity = $newQuantity
        WHERE itemID = $iID";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Database updated successfully.";
} else {
    echo "Error updating database: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
