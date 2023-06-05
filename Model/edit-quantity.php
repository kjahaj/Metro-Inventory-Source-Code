<?php
include "./connection.php";
include "./user.php";
include "./session.php";

$item = $_POST['item'];
$quantity = $_POST['quantity'];

if (empty($quantity)) {
    echo "Error: Quantity field is empty. Please enter a valid quantity.";
    exit;
}

$iIDQuery = "SELECT itemID, quantity FROM `stockItems` WHERE item = '$item'";
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

$sql = "UPDATE `stockItems` 
        SET quantity = $newQuantity
        WHERE itemID = $iID";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "Database updated successfully.";
} else {
    echo "Error updating database: " . mysqli_error($conn);
}


$file = "../LOGS/logs.log";
$user = unserialize($_SESSION['user']);
$userFull = "[" . date('Y-m-d H:i:s') . "] USER: " . $user->getName() . " " . $user->getSurname() . " UPDATED ITEM " . $item . " UPDATED QUANTITY FROM: " . $currentQuantity." TO ". $newQuantity ."\n";

$data = file_get_contents($file); // Read the existing content of the file

$handle = fopen($file, 'w'); // Open the file in write mode

if ($handle !== false) {
    fwrite($handle, $userFull . $data); // Write the content with current time followed by the existing content

    fclose($handle); // Close the file
} else {
    echo "Error opening the file.";
}


// Close the database connection
mysqli_close($conn);
?>
