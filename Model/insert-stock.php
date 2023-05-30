<?php
include './connection.php';

$item = $_POST['item'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$warehouse = $_POST['warehouse'];

$wIDQuery = "SELECT warehouseID FROM `storageunits` WHERE warehouse = '$warehouse'";
$wIDResult = mysqli_query($conn, $wIDQuery);
$wIDRow = mysqli_fetch_assoc($wIDResult);
$wID = $wIDRow['warehouseID'];

// Prepare the SQL query
$sql = "INSERT INTO `stockitems` (item, category, quantity, warehouseID) VALUES (?, ?, ?, ?)";

// Bind the parameters
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssii", $item, $category, $quantity, $wID);

// Execute the query
if (mysqli_stmt_execute($stmt)) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
